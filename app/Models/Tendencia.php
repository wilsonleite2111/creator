<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tendencia extends Model
{
    use HasFactory;

    protected $table = 'tendencias';

    protected $fillable = [
        'nome',
        'apelido',
        'iniciais',
        'descricao'
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
}
