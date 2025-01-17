<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecretariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Secretaria::firstOrCreate(["nome_secretaria" => "admin@argon.com"], [
            'nome_secretaria' => 'Tecnologia da Informação',
        ]);

        \App\Models\Setor::firstOrCreate(["nome_setor" => "Desenvolvimento"], [
            'nome_setor'   => 'Desenvolvimento',
            'secretaria_id' => 1,
        ]);
    }
}
