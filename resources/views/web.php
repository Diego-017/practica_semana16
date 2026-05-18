<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculasController;

Route::get('/peliculas', [PeliculasController::class, 'index']);