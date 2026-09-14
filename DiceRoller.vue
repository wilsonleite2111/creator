<script setup>
import { ref, shallowRef, onMounted, onBeforeUnmount } from 'vue'
import * as THREE from 'three'
import { RoomEnvironment } from 'three/examples/jsm/environments/RoomEnvironment.js'
import RAPIER from '@dimforge/rapier3d-compat'

const props = defineProps({
  // Resultado vindo do servidor. Se null, o dado cai onde a física mandar.
  target: { type: Number, default: null },
  sounds: {
    type: Array,
    default: () => [
      '/audio/dice-1.mp3',
      '/audio/dice-2.mp3',
      '/audio/dice-3.mp3',
      '/audio/dice-4.mp3',
    ],
  },
})

const emit = defineEmits(['settled'])

const canvas = ref(null)
const rolling = ref(false)
const value = ref(null)

// Objetos de Three.js e Rapier NUNCA em ref() — o Proxy do Vue quebra as
// matrizes internas e mata a performance. shallowRef ou escopo de módulo.
const ctx = shallowRef(null)

const DIE_RADIUS = 1
const TIMESTEP = 1 / 60
const MAX_STEPS = 600
const BOWL_HALF = 6

// A ordem tem que bater com a numeração da textura que você aplicar na malha.
// Com material liso, isso aqui é só um rótulo por triângulo.
const FACE_VALUES = [
  20, 8, 14, 2, 5, 11, 17, 3, 19, 9,
  16, 6, 12, 1, 18, 4, 10, 15, 7, 13,
]

function mulberry32(seed) {
  let a = seed >>> 0
  return () => {
    a = (a + 0x6d2b79f5) >>> 0
    let t = Math.imul(a ^ (a >>> 15), 1 | a)
    t = (t + Math.imul(t ^ (t >>> 7), 61 | t)) ^ t
    return ((t ^ (t >>> 14)) >>> 0) / 4294967296
  }
}

/** Normais locais de cada triângulo do icosaedro, na ordem dos vértices. */
function faceNormals(geometry) {
  const pos = geometry.attributes.position
  const normals = []
  const a = new THREE.Vector3()
  const b = new THREE.Vector3()
  const c = new THREE.Vector3()
  for (let i = 0; i < pos.count; i += 3) {
    a.fromBufferAttribute(pos, i)
    b.fromBufferAttribute(pos, i + 1)
    c.fromBufferAttribute(pos, i + 2)
    normals.push(
      new THREE.Vector3()
        .addVectors(a, b)
        .add(c)
        .divideScalar(3)
        .normalize()
    )
  }
  return normals
}

function readFace(normals, quaternion) {
  const up = new THREE.Vector3(0, 1, 0)
  const v = new THREE.Vector3()
  let best = -Infinity
  let index = 0
  normals.forEach((n, i) => {
    const dot = v.copy(n).applyQuaternion(quaternion).dot(up)
    if (dot > best) {
      best = dot
      index = i
    }
  })
  return FACE_VALUES[index]
}

/**
 * Roda a simulação inteira sem renderizar nada e devolve o filme pronto:
 * transformações por frame, impactos com a força de cada um, e o resultado.
 * Toda a aleatoriedade sai do seed, então a mesma semente dá sempre o mesmo
 * arremesso — é isso que permite casar a animação com o número do servidor.
 */
function simulate(seed, hullPoints, normals) {
  const rand = mulberry32(seed)
  const world = new RAPIER.World({ x: 0, y: -9.81, z: 0 })
  world.timestep = TIMESTEP

  const floor = world.createRigidBody(RAPIER.RigidBodyDesc.fixed())
  world.createCollider(
    RAPIER.ColliderDesc.cuboid(BOWL_HALF, 0.5, BOWL_HALF)
      .setTranslation(0, -0.5, 0)
      .setRestitution(0.25)
      .setFriction(0.6),
    floor
  )
  // Paredes, para o dado não sair de quadro.
  const walls = [
    [BOWL_HALF, 0, 0], [-BOWL_HALF, 0, 0],
    [0, 0, BOWL_HALF], [0, 0, -BOWL_HALF],
  ]
  for (const [x, , z] of walls) {
    const hx = x === 0 ? BOWL_HALF : 0.5
    const hz = z === 0 ? BOWL_HALF : 0.5
    world.createCollider(
      RAPIER.ColliderDesc.cuboid(hx, 3, hz).setTranslation(x, 3, z).setRestitution(0.4),
      floor
    )
  }

  const body = world.createRigidBody(
    RAPIER.RigidBodyDesc.dynamic()
      .setTranslation(-4 + rand() * 2, 5 + rand(), -4 + rand() * 2)
      .setLinvel(4 + rand() * 5, 1, 4 + rand() * 5)
      .setAngvel({ x: rand() * 25 - 12, y: rand() * 25 - 12, z: rand() * 25 - 12 })
      .setLinearDamping(0.12)
      .setAngularDamping(0.12)
      .setCcdEnabled(true)
  )
  world.createCollider(
    RAPIER.ColliderDesc.convexHull(hullPoints)
      .setRestitution(0.3)
      .setFriction(0.45)
      .setDensity(1.2)
      .setActiveEvents(RAPIER.ActiveEvents.CONTACT_FORCE_EVENTS)
      .setContactForceEventThreshold(2),
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
  const result = readFace(normals, new THREE.Quaternion(r.x, r.y, r.z, r.w))
  world.free()

  return { frames, impacts, result }
}

/** Sorteia sementes até a física cair no número pedido. */
function simulateFor(target, hullPoints, normals) {
  for (let i = 0; i < 400; i++) {
    const run = simulate((Math.random() * 1e9) | 0, hullPoints, normals)
    if (target === null || run.result === target) return run
  }
  return simulate((Math.random() * 1e9) | 0, hullPoints, normals)
}

/* ---------------------------------------------------------------- áudio */

function createAudio(urls) {
  const context = new (window.AudioContext || window.webkitAudioContext)()
  const buffers = []
  Promise.all(
    urls.map((url) =>
      fetch(url)
        .then((r) => r.arrayBuffer())
        .then((b) => context.decodeAudioData(b))
    )
  ).then((decoded) => buffers.push(...decoded))

  return {
    context,
    play(force) {
      if (!buffers.length) return
      const source = context.createBufferSource()
      source.buffer = buffers[(Math.random() * buffers.length) | 0]
      // Sem variação de pitch, repetições viram metralhadora.
      source.detune.value = (Math.random() - 0.5) * 350
      const gain = context.createGain()
      gain.gain.value = Math.min(force / 90, 1) * 0.8
      source.connect(gain).connect(context.destination)
      source.start()
    },
  }
}

/* ---------------------------------------------------------------- cena */

onMounted(async () => {
  await RAPIER.init()

  const el = canvas.value
  const renderer = new THREE.WebGLRenderer({ canvas: el, antialias: true, alpha: true })
  renderer.setPixelRatio(Math.min(devicePixelRatio, 2))
  renderer.shadowMap.enabled = true
  renderer.shadowMap.type = THREE.PCFSoftShadowMap

  const scene = new THREE.Scene()
  const camera = new THREE.PerspectiveCamera(45, 1, 0.1, 100)
  camera.position.set(0, 11, 9)
  camera.lookAt(0, 0, 0)

  // Reflexo de resina sem precisar carregar um HDR.
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
    new THREE.MeshStandardMaterial({ color: 0x1f3a2e, roughness: 0.95 })
  )
  table.rotation.x = -Math.PI / 2
  table.receiveShadow = true
  scene.add(table)

  const geometry = new THREE.IcosahedronGeometry(DIE_RADIUS, 0)
  const normals = faceNormals(geometry)
  const hullPoints = new Float32Array(geometry.attributes.position.array)

  const die = new THREE.Mesh(
    geometry,
    new THREE.MeshStandardMaterial({
      color: 0xb32d3a,
      roughness: 0.28,
      metalness: 0.05,
      flatShading: true,
    })
  )
  die.castShadow = true
  die.visible = false
  scene.add(die)

  const audio = createAudio(props.sounds)

  const resize = () => {
    const { clientWidth: w, clientHeight: h } = el.parentElement
    renderer.setSize(w, h, false)
    camera.aspect = w / h
    camera.updateProjectionMatrix()
  }
  const observer = new ResizeObserver(resize)
  observer.observe(el.parentElement)
  resize()

  let raf = 0
  const render = () => renderer.render(scene, camera)

  ctx.value = {
    renderer, scene, geometry, normals, hullPoints, die, audio, observer,
    stop: () => cancelAnimationFrame(raf),
    play(run) {
      // Política de autoplay: o contexto só liga depois de um gesto do usuário.
      if (audio.context.state === 'suspended') audio.context.resume()

      const start = performance.now()
      let nextImpact = 0
      die.visible = true

      const tick = (now) => {
        const frame = Math.min(
          Math.floor((now - start) / 1000 / TIMESTEP),
          run.frames.length - 1
        )
        const [x, y, z, qx, qy, qz, qw] = run.frames[frame]
        die.position.set(x, y, z)
        die.quaternion.set(qx, qy, qz, qw)

        while (nextImpact < run.impacts.length && run.impacts[nextImpact].frame <= frame) {
          audio.play(run.impacts[nextImpact].force)
          nextImpact++
        }

        render()

        if (frame < run.frames.length - 1) {
          raf = requestAnimationFrame(tick)
        } else {
          rolling.value = false
          value.value = run.result
          emit('settled', run.result)
        }
      }
      raf = requestAnimationFrame(tick)
    },
  }

  render()
})

onBeforeUnmount(() => {
  const c = ctx.value
  if (!c) return
  c.stop()
  c.observer.disconnect()
  c.audio.context.close()
  c.geometry.dispose()
  c.die.material.dispose()
  c.renderer.dispose()
  ctx.value = null
})

function roll() {
  const c = ctx.value
  if (!c || rolling.value) return
  rolling.value = true
  value.value = null
  // Alguns milissegundos de busca por semente; em produção, mande para um Worker.
  c.play(simulateFor(props.target, c.hullPoints, c.normals))
}

defineExpose({ roll })
</script>

<template>
  <div class="dice">
    <canvas ref="canvas" />
    <button :disabled="rolling" @click="roll">
      {{ rolling ? 'Rolando' : 'Rolar d20' }}
    </button>
    <p v-if="value" class="result">{{ value }}</p>
  </div>
</template>

<style scoped>
.dice {
  position: relative;
  width: 100%;
  aspect-ratio: 4 / 3;
}
canvas {
  display: block;
  width: 100%;
  height: 100%;
}
button {
  position: absolute;
  left: 1rem;
  bottom: 1rem;
  padding: 0.6rem 1.2rem;
  border: 1px solid rgba(255, 255, 255, 0.35);
  border-radius: 2px;
  background: rgba(0, 0, 0, 0.5);
  color: #fff;
  font: inherit;
  cursor: pointer;
}
button:disabled {
  opacity: 0.5;
  cursor: default;
}
.result {
  position: absolute;
  right: 1rem;
  bottom: 0.5rem;
  margin: 0;
  color: #fff;
  font-size: 2.5rem;
  font-variant-numeric: tabular-nums;
}
</style>
