<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pericia extends Model
{
    use HasFactory;

    protected $table = 'pericias';

    protected $fillable = [
        'nome',
        'versao',
        'descricao',
        'habilidade_chave',
    ];
}
