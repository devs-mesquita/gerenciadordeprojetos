<?php

namespace Database\Seeders;

use App\Models\Projeto;
use App\Models\Task;
use Illuminate\Database\Seeder;

class ProjetosSeeder extends Seeder
{
    public function run()
    {
        // Cria um projeto
        $projeto = Projeto::factory()->create();

        // Cria várias tasks associadas ao projeto
        Task::factory()->count(5)->create([
            'projeto_id' => $projeto->id, // Associa as tasks ao projeto recém-criado
        ]);
    }
}
