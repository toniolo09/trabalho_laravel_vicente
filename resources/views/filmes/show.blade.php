@extends('layouts.public')

@section('title', $filme->nome)

@section('content')
    <a href="{{ route('home') }}" class="text-indigo-600 mb-4 inline-block">&larr; Voltar</a>

    <div class="bg-white rounded shadow p-6 grid md:grid-cols-3 gap-6">
        <div>
            @if ($filme->imagem_capa)
                <img src="{{ Storage::url($filme->imagem_capa) }}" class="w-full rounded">
            @endif
        </div>
        <div class="md:col-span-2">
            <h1 class="text-2xl font-bold">{{ $filme->nome }} ({{ $filme->ano }})</h1>
            <p class="text-gray-500 mb-4">{{ $filme->categoria->nome }} · Adicionado por {{ $filme->usuario->name }}</p>
            <p class="mb-6">{{ $filme->sinopse }}</p>

            @if ($filme->trailer_link)
                @php
                    parse_str(parse_url($filme->trailer_link, PHP_URL_QUERY) ?? '', $query);
                    $videoId = $query['v'] ?? basename(parse_url($filme->trailer_link, PHP_URL_PATH));
                @endphp
                @if ($videoId)
                    <iframe class="w-full aspect-video rounded" src="https://www.youtube.com/embed/{{ $videoId }}" allowfullscreen></iframe>
                @else
                    <a href="{{ $filme->trailer_link }}" target="_blank" class="text-indigo-600 underline">Assistir trailer</a>
                @endif
            @endif
        </div>
    </div>
@endsection
