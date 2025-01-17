<?php

namespace Database\Seeders;

use App\Models\Projeto;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run()
    {
        // Primeiro, cria um projeto para associar as tasks
        $projeto = Projeto::factory()->create();

        // Cria várias tasks para esse projeto
        Task::factory()->count(5)->create([
            'projeto_id' => $projeto->id,
        ]);
    }
}
