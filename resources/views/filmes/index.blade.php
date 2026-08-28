@extends('layouts.public')

@section('title', 'Catálogo de Filmes')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Catálogo de Filmes</h1>

    @guest
        <div class="mb-6 p-4 bg-indigo-50 border border-indigo-200 rounded flex justify-between items-center">
            <p class="text-indigo-800">Quer cadastrar filmes? Crie sua conta.</p>
            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Cadastrar
            </a>
        </div>
    @endguest

    <form method="GET" class="mb-6 flex gap-4">
        <select name="ano" class="border-gray-300 rounded" onchange="this.form.submit()">
            <option value="">Todos os anos</option>
            @foreach ($anos as $ano)
                <option value="{{ $ano }}" @selected(request('ano') == $ano)>{{ $ano }}</option>
            @endforeach
        </select>

        <select name="categoria_id" class="border-gray-300 rounded" onchange="this.form.submit()">
            <option value="">Todas as categorias</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" @selected(request('categoria_id') == $categoria->id)>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>
    </form>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
        @forelse ($filmes as $filme)
            <a href="{{ route('filmes.show', $filme) }}" class="block bg-white rounded shadow hover:shadow-lg transition">
                @if ($filme->imagem_capa)
                    <img src="{{ Storage::url($filme->imagem_capa) }}" class="w-full h-64 object-cover rounded-t">
                @else
                    <div class="w-full h-64 bg-gray-200 rounded-t flex items-center justify-center text-gray-400">Sem capa</div>
                @endif
                <div class="p-3">
                    <p class="font-semibold">{{ $filme->nome }}</p>
                    <p class="text-sm text-gray-500">{{ $filme->ano }} · {{ $filme->categoria->nome }}</p>
                </div>
            </a>
        @empty
            <p class="col-span-full text-gray-500">Nenhum filme encontrado.</p>
        @endforelse
    </div>
@endsection
