<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Catálogo de Filmes')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="font-bold text-lg">🎬 Catálogo de Filmes</a>
        <div>
            @auth
                <a href="{{ route('admin.filmes.index') }}" class="text-indigo-600 mr-4">Painel Admin</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit">Sair</button>
                </form>
                
            @else
                <a href="{{ route('login') }}" class="text-indigo-600 mr-4">Entrar</a>
                <a href="{{ route('register') }}" class="text-indigo-600 mr-4">
                    Cadastrar
                </a>
            @endauth
        </div>
    </nav>

    <main class="max-w-6xl mx-auto p-6">
        @yield('content')
    </main>
</body>
</html>
