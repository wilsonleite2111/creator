<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    use HasFactory;

    protected $table = 'fichas';

    protected $fillable = [
        'nome_personagem',
        'nome_jogador',
        'raca_id',
        'classe_id',
        'tendencia_id',
        'versao',
        'nivel',
        'ouro',
        'divindade',
        'tamanho',
        'idade',
        'sexo',
        'altura',
        'peso',
        'olhos',
        'cabelos',
        'pele',
        'forca_base',
        'destreza_base',
        'constituicao_base',
        'inteligencia_base',
        'sabedoria_base',
        'carisma_base',
        'pv_max',
        'pv_atual',
        'bab',
        'fortitude_base',
        'reflexos_base',
        'vontade_base',
        'deslocamento',
        'iniciativa_misc',
        'ca_natural',
        'ca_deflexao',
        'ca_misc',
        'fortitude_misc',
        'reflexos_misc',
        'vontade_misc',
        'agarre_misc',
        'xp_atual',
        'notas_combate',
        'idiomas',
        'talentos_descricao',
        'habilidades_especiais'
    ];

    public function raca()
    {
        return $this->belongsTo(Raca::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function tendencia()
    {
        return $this->belongsTo(Tendencia::class);
    }

    public function pericias()
    {
        return $this->belongsToMany(Pericia::class, 'ficha_pericia')
                    ->withPivot('graduacoes')
                    ->withTimestamps();
    }

    public function armas()
    {
        return $this->belongsToMany(Arma::class, 'ficha_arma')
                    ->withPivot(['quantidade', 'esta_equipado'])
                    ->withTimestamps();
    }

    public function armaduras()
    {
        return $this->belongsToMany(Armadura::class, 'ficha_armadura')
                    ->withPivot(['esta_equipado'])
                    ->withTimestamps();
    }

    public function equipamentos()
    {
        return $this->belongsToMany(Equipamento::class, 'ficha_equipamento')
                    ->withPivot(['quantidade'])
                    ->withTimestamps();
    }
}
