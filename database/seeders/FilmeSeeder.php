<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Filme;
use App\Models\User;
use Illuminate\Database\Seeder;

class FilmeSeeder extends Seeder
{
    public function run(): void
    {
        $usuario = User::first() ?? User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@teste.com',
        ]);

        $filmes = [
            ['nome' => 'Matrix', 'sinopse' => 'Um hacker descobre a verdade sobre sua realidade.', 'ano' => 1999, 'categoria' => 'Ficção Científica'],
            ['nome' => 'O Poderoso Chefão', 'sinopse' => 'A saga de uma família da máfia italiana nos EUA.', 'ano' => 1972, 'categoria' => 'Drama'],
            ['nome' => 'Toy Story', 'sinopse' => 'Brinquedos ganham vida quando ninguém está olhando.', 'ano' => 1995, 'categoria' => 'Animação'],
        ];

        foreach ($filmes as $dados) {
            $categoria = Categoria::where('nome', $dados['categoria'])->first();

            Filme::create([
                'nome' => $dados['nome'],
                'sinopse' => $dados['sinopse'],
                'ano' => $dados['ano'],
                'categoria_id' => $categoria->id,
                'user_id' => $usuario->id,
            ]);
        }
    }
}
