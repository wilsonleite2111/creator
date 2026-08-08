<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Magia;

class Classe extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'nome',
        'versao',
        'descricao',
        'dado_vida',
        'bba_progressao',
        'resistencia_fortitude',
        'resistencia_reflexos',
        'resistencia_vontade',
        'pontos_pericia'
    ];

    public function ficha()
    {
        return $this->hasMany(Ficha::class);
    }

    public function magias()
    {
        return $this->belongsToMany(Magia::class, 'classe_magia')
                    ->withPivot('nivel')
                    ->withTimestamps();
    }
}
