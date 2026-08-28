<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilmeRequest;
use App\Models\Categoria;
use App\Models\Filme;
use Illuminate\Support\Facades\Storage;

class FilmeController extends Controller
{
    public function index()
    {
        $filmes = Filme::with(['categoria', 'usuario'])->latest()->paginate(10);

        return view('admin.filmes.index', compact('filmes'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();

        return view('admin.filmes.create', compact('categorias'));
    }

    public function store(FilmeRequest $request)
    {
        $dados = $request->validated();

        if ($request->hasFile('imagem_capa')) {
            $dados['imagem_capa'] = $request->file('imagem_capa')->store('capas', 'public');
        }

        $dados['user_id'] = auth()->id();

        Filme::create($dados);

        return redirect()->route('admin.filmes.index')->with('sucesso', 'Filme cadastrado com sucesso.');
    }

    public function edit(Filme $filme)
    {
        $categorias = Categoria::orderBy('nome')->get();

        return view('admin.filmes.edit', compact('filme', 'categorias'));
    }

    public function update(FilmeRequest $request, Filme $filme)
    {
        $dados = $request->validated();

        if ($request->hasFile('imagem_capa')) {
            if ($filme->imagem_capa) {
                Storage::disk('public')->delete($filme->imagem_capa);
            }
            $dados['imagem_capa'] = $request->file('imagem_capa')->store('capas', 'public');
        }

        $filme->update($dados);

        return redirect()->route('admin.filmes.index')->with('sucesso', 'Filme atualizado com sucesso.');
    }

    public function destroy(Filme $filme)
    {
        if ($filme->imagem_capa) {
            Storage::disk('public')->delete($filme->imagem_capa);
        }

        $filme->delete();

        return redirect()->route('admin.filmes.index')->with('sucesso', 'Filme excluído com sucesso.');
    }
}
