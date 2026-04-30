<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magia extends Model
{
    use HasFactory;

    protected $table = 'magias';

    protected $fillable = [
        'nome',
        'escola',
        'componentes',
        'tempo_execucao',
        'alcance',
        'alvo_area_efeito',
        'duracao',
        'teste_resistencia',
        'resistencia_magia',
        'descricao',
        'versao'
    ];

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'classe_magia')
                    ->withPivot('nivel')
                    ->withTimestamps();
    }
}
