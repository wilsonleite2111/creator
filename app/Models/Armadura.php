<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armadura extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'preco', 'bonus_ca', 'destreza_max', 'penalidade_armadura', 'falha_arcana', 'deslocamento_9m', 'deslocamento_6m', 'peso', 'tipo'
    ];
}
