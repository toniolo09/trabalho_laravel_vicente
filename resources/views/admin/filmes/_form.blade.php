@csrf
@if(isset($filme))
    @method('PUT')
@endif

<div class="mb-4">
    <label class="block font-medium mb-1">Nome</label>
    <input type="text" name="nome" value="{{ old('nome', $filme->nome ?? '') }}" class="w-full border-gray-300 rounded">
    @error('nome') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block font-medium mb-1">Sinopse</label>
    <textarea name="sinopse" rows="4" class="w-full border-gray-300 rounded">{{ old('sinopse', $filme->sinopse ?? '') }}</textarea>
    @error('sinopse') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4 grid grid-cols-2 gap-4">
    <div>
        <label class="block font-medium mb-1">Ano</label>
        <input type="number" name="ano" value="{{ old('ano', $filme->ano ?? '') }}" class="w-full border-gray-300 rounded">
        @error('ano') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block font-medium mb-1">Categoria</label>
        <select name="categoria_id" class="w-full border-gray-300 rounded">
            <option value="">Selecione</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" @selected(old('categoria_id', $filme->categoria_id ?? '') == $categoria->id)>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>
        @error('categoria_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mb-4">
    <label class="block font-medium mb-1">Link do trailer (YouTube)</label>
    <input type="url" name="trailer_link" value="{{ old('trailer_link', $filme->trailer_link ?? '') }}" class="w-full border-gray-300 rounded">
    @error('trailer_link') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block font-medium mb-1">Imagem da capa</label>
    <input type="file" name="imagem_capa" class="w-full">
    @if(isset($filme) && $filme->imagem_capa)
        <img src="{{ Storage::url($filme->imagem_capa) }}" class="mt-2 w-24 rounded">
    @endif
    @error('imagem_capa') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Salvar</button>
