<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Novo Filme</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 bg-white shadow rounded p-6">
            <form action="{{ route('admin.filmes.store') }}" method="POST" enctype="multipart/form-data">
                @include('admin.filmes._form')
            </form>
        </div>
    </div>
</x-app-layout>
