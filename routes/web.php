<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MagiaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('magias', MagiaController::class);

Route::resource('classes', App\Http\Controllers\ClasseController::class);
Route::resource('racas', App\Http\Controllers\RacaController::class);
Route::resource('pericias', App\Http\Controllers\PericiaController::class);
Route::resource('talentos', App\Http\Controllers\TalentoController::class);
Route::resource('divindades', App\Http\Controllers\DivindadeController::class);
Route::resource('tendencias', App\Http\Controllers\TendenciaController::class);
Route::resource('armas', App\Http\Controllers\ArmaController::class);
Route::resource('armaduras', App\Http\Controllers\ArmaduraController::class);
Route::resource('equipamentos', App\Http\Controllers\EquipamentoController::class);
Route::resource('fichas', App\Http\Controllers\FichaController::class);
