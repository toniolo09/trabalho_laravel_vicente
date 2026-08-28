<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gerenciar Filmes</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('sucesso'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('sucesso') }}</div>
            @endif

            <div class="mb-4 flex justify-end">
                <a href="{{ route('admin.filmes.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    + Novo Filme
                </a>
            </div>

            <div class="bg-white shadow rounded overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3">Capa</th>
                            <th class="p-3">Nome</th>
                            <th class="p-3">Ano</th>
                            <th class="p-3">Categoria</th>
                            <th class="p-3">Inserido por</th>
                            <th class="p-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filmes as $filme)
                            <tr class="border-t">
                                <td class="p-3">
                                    @if ($filme->imagem_capa)
                                        <img src="{{ Storage::url($filme->imagem_capa) }}" class="w-12 h-16 object-cover rounded">
                                    @else
                                        <div class="w-12 h-16 bg-gray-200 rounded"></div>
                                    @endif
                                </td>
                                <td class="p-3">{{ $filme->nome }}</td>
                                <td class="p-3">{{ $filme->ano }}</td>
                                <td class="p-3">{{ $filme->categoria->nome }}</td>
                                <td class="p-3">{{ $filme->usuario->name }}</td>
                                <td class="p-3 space-x-2">
                                    <a href="{{ route('admin.filmes.edit', $filme) }}" class="text-indigo-600 hover:underline">Editar</a>
                                    <form action="{{ route('admin.filmes.destroy', $filme) }}" method="POST" class="inline" onsubmit="return confirm('Excluir este filme?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $filmes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
