<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('classes', App\Http\Controllers\ClasseController::class);
Route::resource('racas', App\Http\Controllers\RacaController::class);
Route::resource('pericias', App\Http\Controllers\PericiaController::class);
Route::resource('talentos', App\Http\Controllers\TalentoController::class);
Route::resource('divindades', App\Http\Controllers\DivindadeController::class);
Route::resource('tendencias', App\Http\Controllers\TendenciaController::class);
