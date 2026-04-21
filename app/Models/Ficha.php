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
        'tendencia_id',
        'divindade',
        'tamanho',
        'idade',
        'sexo',
        'altura',
        'peso',
        'olhos',
        'cabelos',
        'pele'
    ];

    public function raca()
    {
        return $this->hasOne(Raca::class);
    }

    public function classe()
    {
        return $this->hasMany(Classe::class);
    }

    public function tendencia()
    {
        return $this->hasOne(Tendencia::class);
    }
}
