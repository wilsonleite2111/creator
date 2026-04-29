<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divindade extends Model
{
    use HasFactory;

    protected $table = 'divindades';

    protected $fillable = [
        'nome',
        'titulo',
        'versao',
        'tendencia',
        'dominios',
        'arma_preferida',
        'descricao'
    ];
}
