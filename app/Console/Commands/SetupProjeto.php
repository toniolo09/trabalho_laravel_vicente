<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupProjeto extends Command
{
    protected $signature = 'projeto:setup';
    protected $description = 'Recria o banco (migrations) e popula os dados (seeders) do zero';

    public function handle(): void
    {
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->call('storage:link');

        $this->info('Projeto configurado! Banco recriado, dados populados e storage linkado.');
    }
}