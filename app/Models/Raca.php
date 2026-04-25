<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raca extends Model
{
    use HasFactory;

    protected $table = 'racas';

    protected $fillable = [
        'nome',
        'versao',
        'descricao',
        'mod_forca',
        'mod_destreza',
        'mod_constituicao',
        'mod_inteligencia',
        'mod_sabedoria',
        'mod_carisma',
        'tamanho',
        'deslocamento'
    ];
}
