<script setup>
import { ref, shallowRef, onMounted, onBeforeUnmount } from 'vue'
import * as THREE from 'three'
import { RoomEnvironment } from 'three/examples/jsm/environments/RoomEnvironment.js'
import RAPIER from '@dimforge/rapier3d-compat'

const props = defineProps({
    maxDice: { type: Number, default: 4 },
    color: { type: String, default: '#e8dcc0' },
    pipColor: { type: String, default: '#1a0a0a' },
    borderColor: { type: String, default: '#7a1418' },
    // Vazio por padrão para evitar 404s. Passe URLs válidas para ativar áudio.
    sounds: { type: Array, default: () => [] },
})

const canvas = ref(null)
const rolling = ref(false)
const ctx = shallowRef(null)

const DIE_SIZE = 0.9
const TIMESTEP = 1 / 60
const MAX_STEPS = 600
const BOWL_HALF = 5.5

// Numeração d6: opostos somam 7. Ordem casa com os 6 vetores em FACE_NORMALS.
const FACE_NORMALS = [
    new THREE.Vector3( 1,  0,  0),
    new THREE.Vector3(-1,  0,  0),
    new THREE.Vector3( 0,  1,  0),
    new THREE.Vector3( 0, -1,  0),
    new THREE.Vector3( 0,  0,  1),
    new THREE.Vector3( 0,  0, -1),
]
const FACE_VALUES = [3, 4, 1, 6, 2, 5]

function mulberry32(seed) {
    let a = seed >>> 0
    return () => {
        a = (a + 0x6d2b79f5) >>> 0
        let t = Math.imul(a ^ (a >>> 15), 1 | a)
        t = (t + Math.imul(t ^ (t >>> 7), 61 | t)) ^ t
        return ((t ^ (t >>> 14)) >>> 0) / 4294967296
    }
}

function readTopFace(quaternion) {
    const up = new THREE.Vector3(0, 1, 0)
    const v = new THREE.Vector3()
    let best = -Infinity
    let index = 0
    FACE_NORMALS.forEach((n, i) => {
        const dot = v.copy(n).applyQuaternion(quaternion).dot(up)
        if (dot > best) { best = dot; index = i }
    })
    return FACE_VALUES[index]
}

// Cada dado spawna em um setor distinto do bowl (0°..360° dividido por N) e
// recebe velocidade RADIAL PRA FORA. Isto separa os dados espacialmente sem
// precisar sincronizar seus mundos físicos — cada dado tende a seu próprio setor.
function initialFor(index, total, rand) {
    if (total <= 1) {
        return {
            pos: { x: (rand() - 0.5) * 0.4, y: 5.2 + rand() * 1.0, z: (rand() - 0.5) * 0.4 },
            lin: { x: (rand() - 0.5) * 4, y: 1 + rand(), z: (rand() - 0.5) * 4 },
        }
    }
    const angle = (index / total) * Math.PI * 2 + Math.PI / 4
    const spawnR = 2.6
    const cx = Math.cos(angle), sx = Math.sin(angle)
    const speedOut = 1.5 + rand() * 2   // pra fora
    const speedTan = (rand() - 0.5) * 1.2 // pequena tangencial
    return {
        pos: {
            x: cx * spawnR + (rand() - 0.5) * 0.3,
            y: 4.8 + (index % 2) * 0.7 + rand() * 0.4,
            z: sx * spawnR + (rand() - 0.5) * 0.3,
        },
        lin: {
            x: cx * speedOut - sx * speedTan,
            y: 1 + rand() * 0.6,
            z: sx * speedOut + cx * speedTan,
        },
    }
}

function simulateDie(seed, index, total) {
    const rand = mulberry32(seed)
    const world = new RAPIER.World({ x: 0, y: -9.81, z: 0 })
    world.timestep = TIMESTEP

    const floor = world.createRigidBody(RAPIER.RigidBodyDesc.fixed())
    world.createCollider(
        RAPIER.ColliderDesc.cuboid(BOWL_HALF, 0.5, BOWL_HALF)
            .setTranslation(0, -0.5, 0)
            .setRestitution(0.25).setFriction(0.6),
        floor
    )
    const walls = [[BOWL_HALF, 0, 0], [-BOWL_HALF, 0, 0], [0, 0, BOWL_HALF], [0, 0, -BOWL_HALF]]
    for (const [x, , z] of walls) {
        const hx = x === 0 ? BOWL_HALF : 0.5
        const hz = z === 0 ? BOWL_HALF : 0.5
        world.createCollider(
            RAPIER.ColliderDesc.cuboid(hx, 3, hz).setTranslation(x, 3, z).setRestitution(0.4),
            floor
        )
    }

    const init = initialFor(index, total, rand)
    const body = world.createRigidBody(
        RAPIER.RigidBodyDesc.dynamic()
            .setTranslation(init.pos.x, init.pos.y, init.pos.z)
            .setLinvel(init.lin.x, init.lin.y, init.lin.z)
            .setAngvel({ x: rand() * 22 - 11, y: rand() * 22 - 11, z: rand() * 22 - 11 })
            .setLinearDamping(0.16).setAngularDamping(0.16).setCcdEnabled(true)
    )
    world.createCollider(
        RAPIER.ColliderDesc.cuboid(DIE_SIZE / 2, DIE_SIZE / 2, DIE_SIZE / 2)
            .setRestitution(0.35).setFriction(0.5).setDensity(1.2)
            .setActiveEvents(RAPIER.ActiveEvents.CONTACT_FORCE_EVENTS)
            .setContactForceEventThreshold(10),
        body
    )

    const queue = new RAPIER.EventQueue(true)
    const frames = []
    const impacts = []
    for (let i = 0; i < MAX_STEPS; i++) {
        world.step(queue)
        const t = body.translation()
        const r = body.rotation()
        frames.push([t.x, t.y, t.z, r.x, r.y, r.z, r.w])
        queue.drainContactForceEvents((e) => {
            impacts.push({ frame: i, force: e.totalForceMagnitude() })
        })
        if (body.isSleeping() && i > 30) break
    }
    const r = body.rotation()
    const result = readTopFace(new THREE.Quaternion(r.x, r.y, r.z, r.w))
    world.free()
    return { frames, impacts, result }
}

function simulateForTarget(target, index, total) {
    for (let i = 0; i < 800; i++) {
        try {
            const run = simulateDie((Math.random() * 1e9) | 0, index, total)
            if (!run.frames.length) continue
            if (target == null || run.result === target) return run
        } catch (e) {
            console.warn('Simulate failed, retrying:', e)
        }
    }
    try { return simulateDie((Math.random() * 1e9) | 0, index, total) } catch { return { frames: [], impacts: [], result: target ?? 1 } }
}

// Desenha os pontos de uma face de d6 em canvas e devolve textura Three.js.
// Padrão clássico: 1 no centro, 2 na diagonal, 3 na diagonal, 4 nos cantos, 5 cantos+centro, 6 em duas colunas.
function makePipTexture(value, opts) {
    const size = 128
    const el = document.createElement('canvas')
    el.width = el.height = size
    const g = el.getContext('2d')
    g.fillStyle = opts.face
    g.fillRect(0, 0, size, size)
    g.strokeStyle = opts.border
    g.lineWidth = 3
    const inset = 6
    g.strokeRect(inset, inset, size - inset * 2, size - inset * 2)

    const q1 = size * 0.28, q2 = size * 0.5, q3 = size * 0.72
    const layouts = {
        1: [[q2, q2]],
        2: [[q1, q1], [q3, q3]],
        3: [[q1, q1], [q2, q2], [q3, q3]],
        4: [[q1, q1], [q3, q1], [q1, q3], [q3, q3]],
        5: [[q1, q1], [q3, q1], [q2, q2], [q1, q3], [q3, q3]],
        6: [[q1, q1], [q3, q1], [q1, q2], [q3, q2], [q1, q3], [q3, q3]],
    }
    g.fillStyle = opts.pip
    const r = size / 13
    for (const [x, y] of (layouts[value] || [])) {
        g.beginPath()
        g.arc(x, y, r, 0, Math.PI * 2)
        g.fill()
    }
    const tex = new THREE.CanvasTexture(el)
    tex.anisotropy = 4
    tex.needsUpdate = true
    return tex
}

// Um único áudio real, tocado no máximo a cada MIN_GAP_MS e com comportamento
// mono: qualquer instância anterior é cortada antes de começar a próxima.
// Sem síntese/fallback — se o MP3 não carregar, fica em silêncio (sem "vários
// sons ao mesmo tempo" durante a janela de download).
function createAudio(urls) {
    let context = null
    let currentSource = null
    let lastPlayAt = 0
    const MIN_GAP_MS = 220
    const MIN_FORCE = 12
    const buffers = []
    const ensure = () => {
        if (!context) {
            const AC = window.AudioContext || window.webkitAudioContext
            if (!AC) return null
            context = new AC()
            if (Array.isArray(urls) && urls.length) {
                Promise.all(urls.map(u =>
                    fetch(u)
                        .then(r => r.ok ? r.arrayBuffer() : null)
                        .then(b => b ? context.decodeAudioData(b) : null)
                        .catch(() => null)
                )).then(decoded => {
                    for (const b of decoded) if (b) buffers.push(b)
                })
            }
        }
        return context
    }
    return {
        get context() { return context },
        prime() { ensure() },
        play(force) {
            const c = ensure()
            if (!c || !buffers.length) return
            if (force < MIN_FORCE) return
            const now = performance.now()
            if (now - lastPlayAt < MIN_GAP_MS) return
            lastPlayAt = now
            if (c.state === 'suspended') c.resume()
            if (currentSource) { try { currentSource.stop() } catch {} }
            const source = c.createBufferSource()
            source.buffer = buffers[(Math.random() * buffers.length) | 0]
            source.detune.value = (Math.random() - 0.5) * 150
            const gain = c.createGain()
            gain.gain.value = Math.min(force / 90, 1) * 0.7
            source.connect(gain).connect(c.destination)
            source.start()
            currentSource = source
            source.onended = () => { if (currentSource === source) currentSource = null }
        },
        close() {
            if (currentSource) { try { currentSource.stop() } catch {} }
            currentSource = null
            context?.close()
            context = null
        },
    }
}

onMounted(async () => {
    await RAPIER.init()

    const el = canvas.value
    if (!el) return

    const renderer = new THREE.WebGLRenderer({ canvas: el, antialias: true, alpha: true })
    renderer.setPixelRatio(Math.min(devicePixelRatio, 2))
    renderer.shadowMap.enabled = true
    renderer.shadowMap.type = THREE.PCFShadowMap

    const scene = new THREE.Scene()
    const camera = new THREE.PerspectiveCamera(45, 1, 0.1, 100)
    camera.position.set(0, 10, 9)
    camera.lookAt(0, 0.5, 0)

    const pmrem = new THREE.PMREMGenerator(renderer)
    scene.environment = pmrem.fromScene(new RoomEnvironment(), 0.04).texture

    const key = new THREE.DirectionalLight(0xffffff, 2.2)
    key.position.set(6, 12, 5)
    key.castShadow = true
    key.shadow.mapSize.set(1024, 1024)
    key.shadow.camera.left = -8
    key.shadow.camera.right = 8
    key.shadow.camera.top = 8
    key.shadow.camera.bottom = -8
    scene.add(key, new THREE.AmbientLight(0xffffff, 0.4))

    const table = new THREE.Mesh(
        new THREE.PlaneGeometry(BOWL_HALF * 2, BOWL_HALF * 2),
        new THREE.MeshStandardMaterial({ color: 0x2a1810, roughness: 0.95 })
    )
    table.rotation.x = -Math.PI / 2
    table.receiveShadow = true
    scene.add(table)

    const geometry = new THREE.BoxGeometry(DIE_SIZE, DIE_SIZE, DIE_SIZE)

    // BoxGeometry face order: +X, -X, +Y, -Y, +Z, -Z. Casa 1:1 com FACE_VALUES.
    const texOpts = { face: props.color, pip: props.pipColor, border: props.borderColor }
    const materials = FACE_VALUES.map(v => new THREE.MeshStandardMaterial({
        map: makePipTexture(v, texOpts),
        roughness: 0.4,
        metalness: 0.05,
    }))

    const dice = []
    for (let i = 0; i < props.maxDice; i++) {
        const mesh = new THREE.Mesh(geometry, materials)
        mesh.castShadow = true
        mesh.visible = false
        scene.add(mesh)
        dice.push(mesh)
    }

    const audio = createAudio(props.sounds)

    const resize = () => {
        const parent = el.parentElement
        if (!parent) return
        const w = parent.clientWidth
        const h = parent.clientHeight
        if (w === 0 || h === 0) return
        renderer.setSize(w, h, false)
        camera.aspect = w / h
        camera.updateProjectionMatrix()
    }
    const observer = new ResizeObserver(resize)
    observer.observe(el.parentElement)
    resize()

    let raf = 0
    const render = () => renderer.render(scene, camera)

    const play = (runs, onSettled) => {
        audio.prime()
        const valid = runs.filter(r => r && Array.isArray(r.frames) && r.frames.length > 0)
        if (!valid.length) {
            for (const m of dice) m.visible = false
            render()
            onSettled(runs.map(r => (r && r.result) ?? 0))
            return
        }

        const start = performance.now()
        const nextImpact = new Array(runs.length).fill(0)
        const maxLen = Math.max(...valid.map(r => r.frames.length))
        runs.forEach((r, i) => { dice[i].visible = !!(r && r.frames && r.frames.length) })
        for (let i = runs.length; i < dice.length; i++) dice[i].visible = false

        const tick = (now) => {
            try {
                const frame = Math.max(0, Math.min(Math.floor((now - start) / 1000 / TIMESTEP), maxLen - 1))
                let allDone = true
                runs.forEach((run, i) => {
                    if (!run || !run.frames || !run.frames.length) return
                    const idx = Math.max(0, Math.min(frame, run.frames.length - 1))
                    const f = run.frames[idx]
                    if (!f) return
                    dice[i].position.set(f[0], f[1], f[2])
                    dice[i].quaternion.set(f[3], f[4], f[5], f[6])
                    while (nextImpact[i] < run.impacts.length && run.impacts[nextImpact[i]].frame <= frame) {
                        audio.play(run.impacts[nextImpact[i]].force)
                        nextImpact[i]++
                    }
                    if (frame < run.frames.length - 1) allDone = false
                })
                render()
                if (!allDone) raf = requestAnimationFrame(tick)
                else onSettled(runs.map(r => (r && r.result) ?? 0))
            } catch (err) {
                console.error('DiceBowl tick falhou, encerrando animação:', err)
                onSettled(runs.map(r => (r && r.result) ?? 0))
            }
        }
        raf = requestAnimationFrame(tick)
    }

    ctx.value = {
        renderer, scene, geometry, materials, dice, audio, observer,
        play,
        stop: () => cancelAnimationFrame(raf),
    }

    render()
})

onBeforeUnmount(() => {
    const c = ctx.value
    if (!c) return
    c.stop()
    c.observer.disconnect()
    c.audio.close()
    c.geometry.dispose()
    for (const m of c.materials) {
        m.map?.dispose()
        m.dispose()
    }
    c.renderer.dispose()
    ctx.value = null
})

function roll(targets) {
    return new Promise((resolve) => {
        const c = ctx.value
        if (!c || rolling.value) { resolve([]); return }
        if (!Array.isArray(targets) || !targets.length) { resolve([]); return }
        rolling.value = true
        try {
            const runs = targets.map((t, i) => simulateForTarget(t, i, targets.length))
            c.play(runs, (results) => {
                rolling.value = false
                resolve(results)
            })
        } catch (err) {
            console.error('DiceBowl roll falhou:', err)
            rolling.value = false
            resolve(targets)
        }
    })
}

defineExpose({ roll, rolling })
</script>

<template>
    <div class="bowl">
        <canvas ref="canvas" />
    </div>
</template>

<style scoped>
.bowl {
    position: relative;
    width: 100%;
    aspect-ratio: 5 / 3;
    border-radius: 12px;
    overflow: hidden;
    background: radial-gradient(ellipse at center, #1a1008 0%, #0a0503 90%);
    box-shadow: inset 0 0 40px rgba(0, 0, 0, 0.6);
}
canvas {
    display: block;
    width: 100%;
    height: 100%;
}
</style>
