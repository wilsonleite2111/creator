<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arma extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'preco', 'dano_p', 'dano_m', 'critico', 'alcance', 'peso', 'tipo', 'categoria', 'uso'
    ];
}
