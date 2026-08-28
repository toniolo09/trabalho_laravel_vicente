<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'sinopse' => ['required', 'string'],
            'ano' => ['required', 'integer', 'min:1888', 'max:' . (date('Y') + 1)],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'trailer_link' => ['nullable', 'url'],
            'imagem_capa' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
