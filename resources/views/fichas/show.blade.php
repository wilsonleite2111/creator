@extends('layouts.app')

@section('title', 'Ficha de Personagem: ' . $ficha->nome_personagem)

@section('content')
<div class="max-w-6xl mx-auto py-4">
    <div class="mb-4 flex justify-between items-center bg-parchment-100 p-4 border-2 border-parchment-400 rounded-lg shadow-md no-print">
        <h1 class="text-3xl font-cinzel font-bold text-parchment-900">{{ $ficha->nome_personagem }} <span class="text-sm font-normal opacity-60">({{ $ficha->versao }})</span></h1>
        <div class="flex space-x-3">
            <button onclick="window.print()" class="bg-parchment-800 text-white px-5 py-2 rounded font-cinzel hover:bg-parchment-900 transition flex items-center">
                <i class="fa-solid fa-print mr-2"></i> IMPRIMIR
            </button>
            <a href="{{ route('fichas.edit', $ficha) }}" class="bg-blood-700 text-white px-5 py-2 rounded font-cinzel hover:bg-blood-800 transition flex items-center">
                <i class="fa-solid fa-pen-to-square mr-2"></i> EDITAR
            </a>
            <a href="{{ route('fichas.index') }}" class="bg-magic-600 text-white px-5 py-2 rounded font-cinzel hover:bg-magic-700 transition flex items-center">
                <i class="fa-solid fa-reply mr-2"></i> VOLTAR
            </a>
        </div>
    </div>

    @php
        $strTotal = $ficha->forca_base + ($ficha->raca->mod_forca ?? 0);
        $dexTotal = $ficha->destreza_base + ($ficha->raca->mod_destreza ?? 0);
        $conTotal = $ficha->constituicao_base + ($ficha->raca->mod_constituicao ?? 0);
        $intTotal = $ficha->inteligencia_base + ($ficha->raca->mod_inteligencia ?? 0);
        $sabTotal = $ficha->sabedoria_base + ($ficha->raca->mod_sabedoria ?? 0);
        $carTotal = $ficha->carisma_base + ($ficha->raca->mod_carisma ?? 0);

        $strMod = floor(($strTotal - 10) / 2);
        $dexMod = floor(($dexTotal - 10) / 2);
        $conMod = floor(($conTotal - 10) / 2);
        $intMod = floor(($intTotal - 10) / 2);
        $sabMod = floor(($sabTotal - 10) / 2);
        $carMod = floor(($carTotal - 10) / 2);

        $armorBonus = $ficha->armaduras->where('tipo', '!=', 'Escudo')->where('pivot.esta_equipado', true)->sum('bonus_ca');
        $shieldBonus = $ficha->armaduras->where('tipo', 'Escudo')->where('pivot.esta_equipado', true)->sum('bonus_ca');
        $sizeMod = 0; // Por enquanto padrão Médio
    @endphp

    <div class="bg-[#fefbe9] p-8 border-[6px] border-[#3d2b14] shadow-2xl relative text-[#3d2b14] font-serif leading-tight sheet-parchment overflow-hidden">
        
        <!-- TOP SECTION: HEADER -->
        <div class="grid grid-cols-12 gap-2 mb-8 border-b-2 border-[#3d2b14] pb-4">
            <div class="col-span-4 border-b border-[#3d2b14] pb-1">
                <label class="block text-[8px] font-bold uppercase tracking-tighter">Nome do Personagem</label>
                <div class="text-xl font-bold">{{ $ficha->nome_personagem }}</div>
            </div>
            <div class="col-span-3 border-b border-[#3d2b14] pb-1">
                <label class="block text-[8px] font-bold uppercase tracking-tighter">Jogador</label>
                <div class="text-sm">{{ $ficha->nome_jogador }}</div>
            </div>
            <div class="col-span-5 border-b border-[#3d2b14] pb-1">
                <label class="block text-[8px] font-bold uppercase tracking-tighter">Classe e Nível</label>
                <div class="text-sm">{{ $ficha->classe->nome }} {{ $ficha->nivel }}</div>
            </div>

            <div class="col-span-2 border-b border-[#3d2b14] mt-2 pb-1">
                <label class="block text-[8px] font-bold uppercase tracking-tighter">Raça</label>
                <div class="text-sm">{{ $ficha->raca->nome }}</div>
            </div>
            <div class="col-span-2 border-b border-[#3d2b14] mt-2 pb-1">
                <label class="block text-[8px] font-bold uppercase tracking-tighter">Tendência</label>
                <div class="text-sm">{{ $ficha->tendencia->nome }}</div>
            </div>
            <div class="col-span-2 border-b border-[#3d2b14] mt-2 pb-1">
                <label class="block text-[8px] font-bold uppercase tracking-tighter">Divindade</label>
                <div class="text-sm">{{ $ficha->divindade ?: 'Nenhuma' }}</div>
            </div>
            <div class="col-span-2 border-b border-[#3d2b14] mt-2 pb-1">
                <label class="block text-[8px] font-bold uppercase tracking-tighter">Tamanho</label>
                <div class="text-sm">{{ $ficha->tamanho ?: 'Médio' }}</div>
            </div>
            <div class="col-span-2 border-b border-[#3d2b14] mt-2 pb-1">
                <label class="block text-[8px] font-bold uppercase tracking-tighter">Sexo</label>
                <div class="text-sm">{{ $ficha->sexo ?: '—' }}</div>
            </div>
            <div class="col-span-2 border-b border-[#3d2b14] mt-2 pb-1 text-right">
                <label class="block text-[8px] font-bold uppercase tracking-tighter">XP Atual</label>
                <div class="text-sm font-bold">{{ number_format($ficha->xp_atual, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-8">
            <!-- LEFT COLUMN: ABILITIES, HP, AC -->
            <div class="col-span-12 lg:col-span-5 space-y-6">
                
                <!-- Ability Scores -->
                <div class="space-y-1">
                    <div class="grid grid-cols-4 gap-1 text-center font-bold text-[8px] uppercase">
                        <div class="col-span-1">Atributo</div>
                        <div>Valor</div>
                        <div>Mod</div>
                        <div>Temp</div>
                    </div>
                    @php
                        $abilities = [
                            ['FOR', $strTotal, $strMod],
                            ['DES', $dexTotal, $dexMod],
                            ['CON', $conTotal, $conMod],
                            ['INT', $intTotal, $intMod],
                            ['SAB', $sabTotal, $sabMod],
                            ['CAR', $carTotal, $carMod],
                        ];
                    @endphp
                    @foreach($abilities as $ab)
                    <div class="grid grid-cols-4 gap-1 items-center">
                        <div class="bg-[#3d2b14] text-white p-1 text-center font-bold text-xs rounded-l">{{ $ab[0] }}</div>
                        <div class="border-2 border-[#3d2b14] p-1 text-center font-bold text-lg">{{ $ab[1] }}</div>
                        <div class="border-2 border-[#3d2b14] p-1 text-center font-bold text-lg bg-[#e8d5a5]">{{ $ab[2] >= 0 ? '+' : '' }}{{ $ab[2] }}</div>
                        <div class="border-2 border-[#3d2b14] p-1 text-center italic text-xs">__</div>
                    </div>
                    @endforeach
                </div>

                <!-- HP and Initiative -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="border-4 border-[#3d2b14] p-2 relative">
                        <label class="absolute -top-2 left-2 bg-[#fefbe9] px-1 text-[8px] font-bold uppercase">PV Totais</label>
                        <div class="text-3xl font-bold text-center">{{ $ficha->pv_max }}</div>
                        <div class="border-t border-[#3d2b14] mt-1 pt-1 text-[8px] text-center uppercase font-bold">Dano Atual</div>
                        <div class="h-8"></div>
                    </div>
                    <div class="border-4 border-[#3d2b14] p-2 flex flex-col justify-center items-center">
                        <label class="text-[8px] font-bold uppercase mb-1">Iniciativa</label>
                        <div class="flex items-center space-x-1">
                            <div class="text-2xl font-bold bg-[#e8d5a5] px-2 border-2 border-[#3d2b14]">{{ $dexMod + $ficha->iniciativa_misc >= 0 ? '+' : '' }}{{ $dexMod + $ficha->iniciativa_misc }}</div>
                            <div class="text-[10px] font-bold">= {{ $dexMod >= 0 ? '+' : '' }}{{ $dexMod }} <span class="opacity-50 text-[8px]">DES</span> + {{ $ficha->iniciativa_misc }} <span class="opacity-50 text-[8px]">MISC</span></div>
                        </div>
                    </div>
                </div>

                <!-- AC Section -->
                <div class="border-4 border-[#3d2b14] p-4 bg-[#fdf6e3]">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <label class="block text-[10px] font-bold uppercase">Classe de Armadura</label>
                            @php $totalAC = 10 + $armorBonus + $shieldBonus + $dexMod + $sizeMod + $ficha->ca_natural + $ficha->ca_deflexao + $ficha->ca_misc; @endphp
                            <div class="text-5xl font-black">{{ $totalAC }}</div>
                        </div>
                        <div class="text-[10px] font-bold space-y-1">
                            <div class="flex items-center">
                                <span class="w-12">TOQUE</span>
                                <span class="bg-[#3d2b14] text-white px-2 py-1 rounded text-base">{{ 10 + $dexMod + $sizeMod + $ficha->ca_deflexao + $ficha->ca_misc }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-12">SURPRESA</span>
                                <span class="bg-[#3d2b14] text-white px-2 py-1 rounded text-base">{{ 10 + $armorBonus + $shieldBonus + $sizeMod + $ficha->ca_natural + $ficha->ca_deflexao + $ficha->ca_misc }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-9 gap-1 text-center">
                        <div class="text-[8px] col-span-1">10</div>
                        <div class="text-[8px] col-span-1">+</div>
                        <div class="text-[8px] col-span-1">Arm.</div>
                        <div class="text-[8px] col-span-1">Esc.</div>
                        <div class="text-[8px] col-span-1">Des.</div>
                        <div class="text-[8px] col-span-1">Tam.</div>
                        <div class="text-[8px] col-span-1">Nat.</div>
                        <div class="text-[8px] col-span-1">Def.</div>
                        <div class="text-[8px] col-span-1">Misc</div>
                        
                        <div class="bg-gray-100 p-1 text-xs border border-[#3d2b14]">10</div>
                        <div class="p-1">+</div>
                        <div class="bg-[#e8d5a5] p-1 text-xs border border-[#3d2b14]">{{ $armorBonus }}</div>
                        <div class="bg-[#e8d5a5] p-1 text-xs border border-[#3d2b14]">{{ $shieldBonus }}</div>
                        <div class="bg-[#e8d5a5] p-1 text-xs border border-[#3d2b14]">{{ $dexMod }}</div>
                        <div class="bg-[#e8d5a5] p-1 text-xs border border-[#3d2b14]">{{ $sizeMod }}</div>
                        <div class="bg-[#e8d5a5] p-1 text-xs border border-[#3d2b14]">{{ $ficha->ca_natural }}</div>
                        <div class="bg-[#e8d5a5] p-1 text-xs border border-[#3d2b14]">{{ $ficha->ca_deflexao }}</div>
                        <div class="bg-[#e8d5a5] p-1 text-xs border border-[#3d2b14]">{{ $ficha->ca_misc }}</div>
                    </div>
                </div>

                <!-- Saves -->
                <div class="space-y-2">
                    <div class="grid grid-cols-12 gap-1 font-bold text-[8px] uppercase text-center">
                        <div class="col-span-3 text-left">Resistência</div>
                        <div class="col-span-2">Total</div>
                        <div class="col-span-2">Base</div>
                        <div class="col-span-2">Atr.</div>
                        <div class="col-span-2">Mág.</div>
                        <div class="col-span-1">Misc</div>
                    </div>
                    @php
                        $saves = [
                            ['FORTITUDE (CON)', $ficha->fortitude_base, $conMod, 0, $ficha->fortitude_misc],
                            ['REFLEXOS (DES)', $ficha->reflexos_base, $dexMod, 0, $ficha->reflexos_misc],
                            ['VONTADE (SAB)', $ficha->vontade_base, $sabMod, 0, $ficha->vontade_misc],
                        ];
                    @endphp
                    @foreach($saves as $s)
                    <div class="grid grid-cols-12 gap-1 items-center">
                        <div class="col-span-3 text-[10px] font-bold leading-none">{{ $s[0] }}</div>
                        <div class="col-span-2 bg-[#3d2b14] text-white p-1 text-center font-bold text-lg">{{ $s[1]+$s[2]+$s[3]+$s[4] >= 0 ? '+' : '' }}{{ $s[1]+$s[2]+$s[3]+$s[4] }}</div>
                        <div class="col-span-2 border border-[#3d2b14] p-1 text-center text-xs">+{{ $s[1] }}</div>
                        <div class="col-span-2 border border-[#3d2b14] p-1 text-center text-xs">+{{ $s[2] }}</div>
                        <div class="col-span-2 border border-[#3d2b14] p-1 text-center text-xs">+{{ $s[3] }}</div>
                        <div class="col-span-1 border border-[#3d2b14] p-1 text-center text-xs">+{{ $s[4] }}</div>
                    </div>
                    @endforeach
                </div>

                <!-- BAB and Grapple -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="border-2 border-[#3d2b14] p-2 text-center">
                        <label class="block text-[8px] font-bold uppercase">Bônus Base de Ataque</label>
                        <div class="text-xl font-black">+{{ $ficha->bab }}</div>
                    </div>
                    <div class="border-2 border-[#3d2b14] p-2 text-center bg-[#fdf6e3]">
                        <label class="block text-[8px] font-bold uppercase">Agarre (Grapple)</label>
                        @php $grapple = $ficha->bab + $strMod + $sizeMod + $ficha->agarre_misc; @endphp
                        <div class="text-xl font-black">{{ $grapple >= 0 ? '+' : '' }}{{ $grapple }}</div>
                    </div>
                </div>
            </div>

            <!-- MIDDLE COLUMN: SKILLS AND ATTACKS -->
            <div class="col-span-12 lg:col-span-7 space-y-6">
                
                <!-- Attacks -->
                <div class="space-y-4">
                    <h3 class="font-cinzel font-bold text-lg border-b-2 border-[#3d2b14] mb-2">Ataques</h3>
                    @foreach($ficha->armas as $arma)
                    <div class="border-2 border-[#3d2b14] p-3 bg-white/50 relative">
                        <div class="flex justify-between items-start mb-2">
                            <span class="font-black text-sm uppercase">{{ $arma->nome }}</span>
                            <span class="text-xs bg-[#3d2b14] text-white px-2 py-0.5">{{ $arma->tipo }}</span>
                        </div>
                        <div class="grid grid-cols-4 gap-4 text-center">
                            <div>
                                <label class="block text-[8px] font-bold uppercase opacity-60">Bônus de Ataque</label>
                                @php 
                                    $atkMod = ($arma->uso === 'Distância' ? $dexMod : $strMod);
                                    $totalAtk = $ficha->bab + $atkMod + $sizeMod; 
                                @endphp
                                <div class="font-bold text-lg border-b border-[#3d2b14]">{{ $totalAtk >= 0 ? '+' : '' }}{{ $totalAtk }}</div>
                            </div>
                            <div>
                                <label class="block text-[8px] font-bold uppercase opacity-60">Dano</label>
                                <div class="font-bold text-lg border-b border-[#3d2b14]">{{ $arma->dano_m }} {{ $strMod >= 0 && $arma->uso !== 'Distância' ? '+'.$strMod : ($arma->uso !== 'Distância' ? $strMod : '') }}</div>
                            </div>
                            <div>
                                <label class="block text-[8px] font-bold uppercase opacity-60">Crítico</label>
                                <div class="font-bold text-xs border-b border-[#3d2b14] py-1">{{ $arma->critico }}</div>
                            </div>
                            <div>
                                <label class="block text-[8px] font-bold uppercase opacity-60">Alcance</label>
                                <div class="font-bold text-xs border-b border-[#3d2b14] py-1">{{ $arma->alcance }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Skills -->
                <div class="space-y-2">
                    <div class="flex justify-between items-end border-b-2 border-[#3d2b14] mb-2">
                        <h3 class="font-cinzel font-bold text-lg">Perícias</h3>
                        <div class="text-[8px] font-bold uppercase text-[#5a4624]">D&D 3.5 System</div>
                    </div>
                    <div class="grid grid-cols-2 gap-x-6 gap-y-1">
                        <div class="grid grid-cols-12 gap-1 font-bold text-[7px] uppercase text-center opacity-70">
                            <div class="col-span-6 text-left">Nome</div>
                            <div class="col-span-2">Total</div>
                            <div class="col-span-2">Mod</div>
                            <div class="col-span-2">Grad</div>
                        </div>
                        <div class="hidden md:grid grid-cols-12 gap-1 font-bold text-[7px] uppercase text-center opacity-70">
                            <div class="col-span-6 text-left">Nome</div>
                            <div class="col-span-2">Total</div>
                            <div class="col-span-2">Mod</div>
                            <div class="col-span-2">Grad</div>
                        </div>
                        
                        @foreach($ficha->pericias as $pericia)
                            @php
                                $attrKeyMap = ['FOR' => 'forca', 'DES' => 'destreza', 'CON' => 'constituicao', 'INT' => 'inteligencia', 'SAB' => 'sabedoria', 'CAR' => 'carisma'];
                                $mVal = floor((($ficha->{$attrKeyMap[$pericia->habilidade_chave] . '_base'} + ($ficha->raca->{'mod_'.$attrKeyMap[$pericia->habilidade_chave]} ?? 0)) - 10) / 2);
                                $totalS = $pericia->pivot->graduacoes + $mVal;
                            @endphp
                            <div class="grid grid-cols-12 gap-1 items-center border-b border-[#d1b882] py-0.5">
                                <div class="col-span-6 text-[9px] font-bold truncate">{{ $pericia->nome }} <span class="opacity-50 text-[7px]">({{ $pericia->habilidade_chave }})</span></div>
                                <div class="col-span-2 bg-[#3d2b14] text-white text-[10px] font-bold text-center rounded-sm">{{ $totalS >= 0 ? '+' : '' }}{{ $totalS }}</div>
                                <div class="col-span-2 text-[9px] text-center opacity-60">{{ $mVal >= 0 ? '+' : '' }}{{ $mVal }}</div>
                                <div class="col-span-2 text-[9px] text-center font-bold">{{ $pericia->pivot->graduacoes }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- BOTTOM SECTION: FEATS, EQUIPMENT, NOTES -->
        <div class="grid grid-cols-12 gap-8 mt-10 pt-8 border-t-2 border-[#3d2b14]">
            
            <!-- Feats and Special Abilities -->
            <div class="col-span-12 lg:col-span-6 space-y-6">
                <div class="border-2 border-[#3d2b14] p-4 h-full">
                    <h3 class="font-cinzel font-bold text-sm mb-4 uppercase border-b border-[#3d2b14]">Talentos e Habilidades Especiais</h3>
                    <div class="text-xs space-y-4 font-lora">
                        @if($ficha->talentos_descricao)
                            <div>
                                <p class="font-bold text-blood-800">[Talentos]</p>
                                <p class="italic">{{ $ficha->talentos_descricao }}</p>
                            </div>
                        @endif
                        @if($ficha->habilidades_especiais)
                            <div>
                                <p class="font-bold text-blood-800">[Especiais]</p>
                                <p class="italic">{{ $ficha->habilidades_especiais }}</p>
                            </div>
                        @endif
                        @if(!$ficha->talentos_descricao && !$ficha->habilidades_especiais)
                            <p class="text-center opacity-30 py-10 italic">Nenhum talento ou habilidade registrado.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Inventory and Gear -->
            <div class="col-span-12 lg:col-span-6">
                <div class="border-2 border-[#3d2b14] p-4">
                    <div class="flex justify-between items-center border-b border-[#3d2b14] mb-4">
                        <h3 class="font-cinzel font-bold text-sm uppercase">Equipamento e Mochila</h3>
                        <div class="text-xs font-bold bg-[#3d2b14] text-white px-3 py-1 rounded">
                            <i class="fa-solid fa-sack-dollar mr-2 text-[#d1b882]"></i>{{ number_format($ficha->ouro, 2, ',', '.') }} PO
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-xs">
                        @foreach($ficha->armaduras as $armadura)
                            <div class="col-span-2 flex justify-between border-b border-dashed border-[#5a4624] py-1">
                                <span class="font-bold">{{ $armadura->nome }} (Equipado)</span>
                                <span>{{ $armadura->peso }} kg</span>
                            </div>
                        @endforeach
                        @foreach($ficha->equipamentos as $item)
                            <div class="flex justify-between border-b border-dotted border-[#d1b882] py-1">
                                <span>{{ $item->nome }} <span class="opacity-60">x{{ $item->pivot->quantidade }}</span></span>
                                <span>{{ $item->peso * $item->pivot->quantidade }} kg</span>
                            </div>
                        @endforeach
                    </div>
                    @php 
                        $totalWeight = $ficha->armaduras->where('pivot.esta_equipado', true)->sum('peso') + 
                                      $ficha->armas->sum('peso') + 
                                      $ficha->equipamentos->sum(fn($i) => $i->peso * $i->pivot->quantidade);
                    @endphp
                    <div class="mt-4 pt-2 border-t-2 border-[#3d2b14] flex justify-between items-center font-bold">
                        <span>PESO TOTAL:</span>
                        <span class="text-lg">{{ $totalWeight }} kg</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footnote -->
        <div class="mt-12 pt-4 border-t border-[#3d2b14] flex justify-between items-end opacity-40 italic text-[8px]">
            <div>CreatorCloud: Forja de Heróis v1.0 - D&D 3.5 OGL License</div>
            <div class="flex items-center">
                <i class="fa-solid fa-dragon mr-2 text-sm"></i>
                <span class="font-cinzel">Lendas nunca morrem</span>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body { background: white !important; margin: 0; padding: 0; }
    .no-print { display: none !important; }
    .sheet-parchment { 
        border-width: 2px !important; 
        box-shadow: none !important; 
        background-image: none !important; 
        background-color: white !important; 
        padding: 0 !important;
    }
    .sheet-parchment * { color: black !important; }
}

.sheet-parchment::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background-image: url('https://www.transparenttextures.com/patterns/aged-paper.png');
    pointer-events: none;
    opacity: 0.5;
    z-index: 0;
}

.sheet-parchment > * {
    position: relative;
    z-index: 1;
}
</style>
@endsection
