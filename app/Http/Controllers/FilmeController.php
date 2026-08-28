<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Filme;
use Illuminate\Http\Request;

class FilmeController extends Controller
{
    public function index(Request $request)
    {
        $filmes = Filme::with('categoria')
            ->when($request->filled('ano'), fn ($query) => $query->where('ano', $request->ano))
            ->when($request->filled('categoria_id'), fn ($query) => $query->where('categoria_id', $request->categoria_id))
            ->latest()
            ->get();

        $categorias = Categoria::orderBy('nome')->get();
        $anos = Filme::select('ano')->distinct()->orderByDesc('ano')->pluck('ano');

        return view('filmes.index', compact('filmes', 'categorias', 'anos'));
    }

    public function show(Filme $filme)
    {
        $filme->load(['categoria', 'usuario']);

        return view('filmes.show', compact('filme'));
    }
}
