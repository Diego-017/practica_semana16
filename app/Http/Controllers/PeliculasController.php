<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peliculas;

class PeliculasController extends Controller
{
    public function index()
    {
        $peliculas = Peliculas::all();
        return response()->json($peliculas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'duracion' => 'required|integer',
            'categoria' => 'required|string',
            'fecha_estreno' => 'required|date'
        ]);

        $pelicula = Peliculas::create([
            'nombre' => $request->nombre,
            'duracion' => $request->duracion,
            'categoria' => $request->categoria,
            'fecha_estreno' => $request->fecha_estreno
        ]);

        return response()->json($pelicula, 201);
    }
}
