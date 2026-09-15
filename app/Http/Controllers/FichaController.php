<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use App\Models\Raca;
use App\Models\Classe;
use App\Models\Tendencia;
use App\Models\Divindade;
use App\Models\Pericia;
use App\Models\Arma;
use App\Models\Armadura;
use App\Models\Equipamento;
use App\Models\Talento;
use App\Services\FichaPdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class FichaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fichas = Ficha::with(['raca', 'classe'])->get();
        return inertia('Fichas/Index', [
            'fichas' => $fichas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $racas = Raca::where('versao', '3.5')->orderBy('nome')->get();
        $classes = Classe::where('versao', '3.5')->orderBy('nome')->get();
        $tendencias = Tendencia::all();
        $divindades = Divindade::where('versao', '3.5')->get();
        $pericias = Pericia::where('versao', '3.5')->orderBy('nome')->get();
        $talentos = Talento::where('versao', '3.5')->orderBy('tipo')->orderBy('nome')->get();
        $armas = Arma::all();
        $armaduras = Armadura::all();
        $equipamentos = Equipamento::all();
        $magias = \App\Models\Magia::with(['classes' => fn ($q) => $q->select('classes.id')])
            ->where('versao', '3.5')
            ->orderBy('nome')
            ->get();

        return inertia('Fichas/Create', [
            'racas' => $racas,
            'classes' => $classes,
            'tendencias' => $tendencias,
            'divindades' => $divindades,
            'pericias' => $pericias,
            'talentos' => $talentos,
            'armas' => $armas,
            'armaduras' => $armaduras,
            'equipamentos' => $equipamentos,
            'magias' => $magias,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'versao' => 'required|string',
            'nome_personagem' => 'required|string|max:100',
            'nome_jogador' => 'required|string|max:100',
            'raca_id' => 'required|exists:racas,id',
            'classe_id' => 'required|exists:classes,id',
            'tendencia_id' => 'required|exists:tendencias,id',
            'divindade' => 'nullable|string',
            'tamanho' => 'nullable|string',
            'idade' => 'nullable|integer',
            'sexo' => 'nullable|string',
            'altura' => 'nullable|numeric',
            'peso' => 'nullable|numeric',
            'olhos' => 'nullable|string',
            'cabelos' => 'nullable|string',
            'pele' => 'nullable|string',
            'nivel' => 'required|integer|min:1',
            'ouro' => 'required|numeric',
            'forca_base' => 'required|integer',
            'destreza_base' => 'required|integer',
            'constituicao_base' => 'required|integer',
            'inteligencia_base' => 'required|integer',
            'sabedoria_base' => 'required|integer',
            'carisma_base' => 'required|integer',
            'pv_max' => 'required|integer',
            'bab' => 'required|integer',
            'fortitude_base' => 'required|integer',
            'reflexos_base' => 'required|integer',
            'vontade_base' => 'required|integer',
            'xp_atual' => 'required|integer',
            'deslocamento' => 'required|string',
            'iniciativa_misc' => 'required|integer',
            'ca_natural' => 'required|integer',
            'ca_armadura' => 'required|integer',
            'ca_escudo' => 'required|integer',
            'ca_tamanho' => 'required|integer',
            'ca_deflexao' => 'required|integer',
            'ca_misc' => 'required|integer',
            'fortitude_misc' => 'required|integer',
            'fortitude_magia' => 'required|integer',
            'reflexos_misc' => 'required|integer',
            'reflexos_magia' => 'required|integer',
            'vontade_misc' => 'required|integer',
            'vontade_magia' => 'required|integer',
            'agarre_misc' => 'required|integer',
            'agarre_tamanho' => 'required|integer',
            'talentos_descricao' => 'nullable|string',
            'habilidades_especiais' => 'nullable|string',
            'idiomas' => 'nullable|string',
            'notas_combate' => 'nullable|string',
            'dinheiro_pc' => 'required|integer',
            'dinheiro_pp' => 'required|integer',
            'dinheiro_pl' => 'required|integer',
            'xp_proximo' => 'required|integer',
            'talentos' => 'nullable|array',
            'talentos.*' => 'integer|exists:talentos,id',
            'magias' => 'nullable|array',
            'magias.*' => 'integer|exists:magias,id',
        ]);

        $validated['pv_atual'] = $validated['pv_max'];

        $ficha = Ficha::create($validated);

        if ($request->has('pericias')) {
            foreach ($request->pericias as $pericia_id => $graduacoes) {
                if ($graduacoes > 0) {
                    $ficha->pericias()->attach($pericia_id, ['graduacoes' => $graduacoes]);
                }
            }
        }

        if ($request->filled('talentos')) {
            $ficha->talentos()->sync($request->input('talentos', []));
        }

        if ($request->has('magias')) {
            $sync = [];
            foreach ($request->magias as $magia_id) {
                $sync[$magia_id] = ['preparada' => false];
            }
            $ficha->magias()->sync($sync);
        }

        // Armas: aceita mapa { id: quantidade } (novo formato) ou array de IDs (compatibilidade).
        if ($request->has('armas')) {
            $armasInput = $request->armas;
            if (is_array($armasInput)) {
                $primeirasChaves = array_keys($armasInput);
                $ehMapa = !empty($primeirasChaves) && !is_int($primeirasChaves[0] ?? null);
                // Se todas as chaves forem numéricas mas os valores forem inteiros positivos, tratamos como mapa id=>qtd.
                if (!$ehMapa) {
                    // Detecção heurística: se cada valor for um inteiro (quantidade), assume mapa.
                    $todosInteiros = collect($armasInput)->every(fn ($v) => is_int($v) || (is_string($v) && ctype_digit($v)));
                    $ehMapa = $todosInteiros;
                }
                if ($ehMapa) {
                    foreach ($armasInput as $arma_id => $qty) {
                        $q = (int) $qty;
                        if ($q > 0) {
                            $ficha->armas()->attach($arma_id, ['quantidade' => $q, 'esta_equipado' => true]);
                        }
                    }
                } else {
                    foreach ($armasInput as $arma_id) {
                        $ficha->armas()->attach($arma_id, ['quantidade' => 1, 'esta_equipado' => true]);
                    }
                }
            }
        }

        // Armaduras: aceita mapa { id: quantidade } (novo) ou array de IDs (compatibilidade).
        if ($request->has('armaduras')) {
            $armadurasInput = $request->armaduras;
            if (is_array($armadurasInput)) {
                $primeirasChaves = array_keys($armadurasInput);
                $ehMapa = !empty($primeirasChaves) && !is_int($primeirasChaves[0] ?? null);
                if (!$ehMapa) {
                    $todosInteiros = collect($armadurasInput)->every(fn ($v) => is_int($v) || (is_string($v) && ctype_digit($v)));
                    $ehMapa = $todosInteiros;
                }
                if ($ehMapa) {
                    foreach ($armadurasInput as $armadura_id => $qty) {
                        $q = (int) $qty;
                        if ($q > 0) {
                            $ficha->armaduras()->attach($armadura_id, ['quantidade' => $q, 'esta_equipado' => true]);
                        }
                    }
                } else {
                    foreach ($armadurasInput as $armadura_id) {
                        $ficha->armaduras()->attach($armadura_id, ['quantidade' => 1, 'esta_equipado' => true]);
                    }
                }
            }
        }

        // Equipamentos: mesmo padrão de armas.
        if ($request->has('equipamentos')) {
            $equipInput = $request->equipamentos;
            if (is_array($equipInput)) {
                $primeirasChaves = array_keys($equipInput);
                $ehMapa = !empty($primeirasChaves) && !is_int($primeirasChaves[0] ?? null);
                if (!$ehMapa) {
                    $todosInteiros = collect($equipInput)->every(fn ($v) => is_int($v) || (is_string($v) && ctype_digit($v)));
                    $ehMapa = $todosInteiros;
                }
                if ($ehMapa) {
                    foreach ($equipInput as $equip_id => $qty) {
                        $q = (int) $qty;
                        if ($q > 0) {
                            $ficha->equipamentos()->attach($equip_id, ['quantidade' => $q]);
                        }
                    }
                } else {
                    foreach ($equipInput as $equip_id) {
                        $ficha->equipamentos()->attach($equip_id, ['quantidade' => 1]);
                    }
                }
            }
        }

        return redirect()->route('fichas.index')->with('success', 'Ficha de Personagem forjada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ficha $ficha)
    {
        $ficha->load([
            'raca',
            'classe',
            'tendencia',
            'pericias',
            'armas',
            'armaduras',
            'equipamentos',
            'talentos',
            'magias.classes',
        ]);

        return inertia('Fichas/Show', [
            'ficha' => $ficha,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ficha $ficha)
    {
        $racas = Raca::where('versao', '3.5')->orderBy('nome')->get();
        $classes = Classe::where('versao', '3.5')->orderBy('nome')->get();
        $tendencias = Tendencia::all();
        $divindades = Divindade::where('versao', '3.5')->orderBy('nome')->get();
        $pericias = Pericia::where('versao', '3.5')->orderBy('nome')->get();
        $talentos = Talento::where('versao', '3.5')->orderBy('tipo')->orderBy('nome')->get();
        $armas = Arma::orderBy('nome')->get();
        $armaduras = Armadura::orderBy('nome')->get();
        $equipamentos = Equipamento::orderBy('nome')->get();
        $magias = \App\Models\Magia::with(['classes' => fn ($q) => $q->select('classes.id')])
            ->where('versao', '3.5')
            ->orderBy('nome')
            ->get();

        $ficha->load([
            'pericias',
            'armas',
            'armaduras',
            'equipamentos',
            'talentos',
            'magias',
        ]);

        return Inertia::render('Fichas/Edit', [
            'ficha' => $ficha,
            'racas' => $racas,
            'classes' => $classes,
            'tendencias' => $tendencias,
            'divindades' => $divindades,
            'pericias' => $pericias,
            'talentos' => $talentos,
            'armas' => $armas,
            'armaduras' => $armaduras,
            'equipamentos' => $equipamentos,
            'magias' => $magias,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ficha $ficha)
    {
        $validated = $request->validate([
            'versao' => 'required|string',
            'nome_personagem' => 'required|string|max:100',
            'nome_jogador' => 'required|string|max:100',
            'raca_id' => 'required|exists:racas,id',
            'classe_id' => 'required|exists:classes,id',
            'tendencia_id' => 'required|exists:tendencias,id',
            'divindade' => 'nullable|string',
            'tamanho' => 'nullable|string',
            'idade' => 'nullable|integer',
            'sexo' => 'nullable|string',
            'altura' => 'nullable|numeric',
            'peso' => 'nullable|numeric',
            'olhos' => 'nullable|string',
            'cabelos' => 'nullable|string',
            'pele' => 'nullable|string',
            'nivel' => 'required|integer|min:1',
            'ouro' => 'required|numeric',
            'forca_base' => 'required|integer',
            'destreza_base' => 'required|integer',
            'constituicao_base' => 'required|integer',
            'inteligencia_base' => 'required|integer',
            'sabedoria_base' => 'required|integer',
            'carisma_base' => 'required|integer',
            'pv_max' => 'required|integer',
            'bab' => 'required|integer',
            'fortitude_base' => 'required|integer',
            'reflexos_base' => 'required|integer',
            'vontade_base' => 'required|integer',
            'xp_atual' => 'required|integer',
            'deslocamento' => 'required|string',
            'iniciativa_misc' => 'required|integer',
            'ca_natural' => 'required|integer',
            'ca_armadura' => 'required|integer',
            'ca_escudo' => 'required|integer',
            'ca_tamanho' => 'required|integer',
            'ca_deflexao' => 'required|integer',
            'ca_misc' => 'required|integer',
            'fortitude_misc' => 'required|integer',
            'fortitude_magia' => 'required|integer',
            'reflexos_misc' => 'required|integer',
            'reflexos_magia' => 'required|integer',
            'vontade_misc' => 'required|integer',
            'vontade_magia' => 'required|integer',
            'agarre_misc' => 'required|integer',
            'agarre_tamanho' => 'required|integer',
            'talentos_descricao' => 'nullable|string',
            'habilidades_especiais' => 'nullable|string',
            'idiomas' => 'nullable|string',
            'notas_combate' => 'nullable|string',
            'dinheiro_pc' => 'required|integer',
            'dinheiro_pp' => 'required|integer',
            'dinheiro_pl' => 'required|integer',
            'xp_proximo' => 'required|integer',
            'talentos' => 'nullable|array',
            'talentos.*' => 'integer|exists:talentos,id',
            'magias' => 'nullable|array',
            'magias.*' => 'integer|exists:magias,id',
        ]);

        $ficha->update($validated);

        $periciasData = [];
        if ($request->has('pericias')) {
            foreach ($request->pericias as $periciaId => $graduacoes) {
                if ((float) $graduacoes > 0) {
                    $periciasData[$periciaId] = ['graduacoes' => (float) $graduacoes];
                }
            }
        }
        $ficha->pericias()->sync($periciasData);

        $ficha->talentos()->sync($request->input('talentos', []));

        $magiasSync = [];
        foreach ((array) $request->input('magias', []) as $magiaId) {
            $magiasSync[(int) $magiaId] = ['preparada' => false];
        }
        $ficha->magias()->sync($magiasSync);

        $ficha->armas()->sync($this->buildInventorySync($request->input('armas'), ['esta_equipado' => true]));
        $ficha->armaduras()->sync($this->buildInventorySync($request->input('armaduras'), ['esta_equipado' => true]));
        $ficha->equipamentos()->sync($this->buildInventorySync($request->input('equipamentos'), []));

        return redirect()->route('fichas.show', $ficha)->with('success', 'Ficha atualizada com sucesso!');
    }

    private function buildInventorySync($input, array $extraPivot): array
    {
        if (!is_array($input) || empty($input)) {
            return [];
        }

        $primeirasChaves = array_keys($input);
        $ehMapa = !is_int($primeirasChaves[0] ?? null);
        if (!$ehMapa) {
            $ehMapa = collect($input)->every(fn ($v) => is_int($v) || (is_string($v) && ctype_digit($v)));
        }

        $sync = [];
        if ($ehMapa) {
            foreach ($input as $id => $qty) {
                $q = (int) $qty;
                if ($q > 0) {
                    $sync[(int) $id] = array_merge(['quantidade' => $q], $extraPivot);
                }
            }
        } else {
            foreach ($input as $id) {
                $sync[(int) $id] = array_merge(['quantidade' => 1], $extraPivot);
            }
        }

        return $sync;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ficha $ficha)
    {
        $ficha->delete();
        return redirect()->route('fichas.index')->with('success', 'Ficha removida do registro.');
    }

    public function pdf(Ficha $ficha, FichaPdfService $service)
    {
        return $service->generate($ficha);
    }

    public function retrato(Ficha $ficha)
    {
        $racas = [
            'Humano' => 'human', 'Anão' => 'dwarf', 'Elfo' => 'elf',
            'Gnomo' => 'gnome', 'Halfling' => 'halfling', 'Meio-Elfo' => 'half-elf',
            'Meio-Orc' => 'half-orc', 'Draconato' => 'dragonborn',
        ];
        $classes = [
            'Bárbaro' => 'barbarian', 'Bardo' => 'bard', 'Clérigo' => 'cleric',
            'Druida' => 'druid', 'Guerreiro' => 'fighter', 'Monge' => 'monk',
            'Paladino' => 'paladin', 'Ranger' => 'ranger', 'Ladino' => 'rogue',
            'Feiticeiro' => 'sorcerer', 'Mago' => 'wizard',
        ];
        $sexos = ['Masculino' => 'male', 'Feminino' => 'female', 'Outro' => 'non-binary'];

        $ficha->load('raca', 'classe', 'armas');

        $raca   = $racas[$ficha->raca?->nome ?? ''] ?? 'human';
        $classe = $classes[$ficha->classe?->nome ?? ''] ?? 'adventurer';
        $sexo   = $sexos[$ficha->sexo ?? ''] ?? 'person';
        $altura = $ficha->altura ? "{$ficha->altura}m tall" : '';
        $peso   = $ficha->peso ? "{$ficha->peso}kg" : '';
        $olhos  = $ficha->olhos ? "{$ficha->olhos} eyes" : '';
        $cabelos = $ficha->cabelos ? "{$ficha->cabelos} hair" : '';
        $pele   = $ficha->pele ? "{$ficha->pele} skin" : '';

        $armaName = $ficha->armas->firstWhere('pivot.esta_equipado', true)?->nome ?? null;

        $parts = array_filter([
            "Full body fantasy portrait of a {$raca} {$classe}, {$sexo}",
            $altura, $peso, $olhos, $cabelos, $pele,
            $armaName ? "wielding a {$armaName}" : null,
            'standing pose, neutral background, original character design, painterly style, medieval fantasy art',
        ]);

        $prompt = implode(', ', $parts);
        $url = 'https://image.pollinations.ai/prompt/' . rawurlencode($prompt)
            . '?width=768&height=1152&model=flux&nologo=true';

        // SSL cert unavailable on local Windows dev — verify only in production
        $response = Http::withoutVerifying()->timeout(60)->get($url);

        if (! $response->successful()) {
            return redirect()->back()->with('error', 'Falha ao gerar o retrato. Tente novamente.');
        }

        $path = "retratos/{$ficha->id}.png";
        Storage::disk('public')->put($path, $response->body());

        $ficha->update([
            'retrato_path'   => $path,
            'retrato_prompt' => $prompt,
        ]);

        return redirect()->back()->with('success', 'Retrato forjado com sucesso!');
    }
}
