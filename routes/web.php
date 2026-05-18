<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculasController;

Route::get('/', function () {
    return view('index');
});

Route::get('/peliculas', [PeliculasController::class, 'index']);
Route::post('/peliculas', [PeliculasController::class, 'store']);
