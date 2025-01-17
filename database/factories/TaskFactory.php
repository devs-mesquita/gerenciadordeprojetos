<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Projeto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = \App\Models\Task::class;

    public function definition(): array
    {
        return [
            // 'projeto_id' => Projeto::factory(), // Cria uma task associada a um projeto gerado pelo Factory de Projeto
            'nome_task' => $this->faker->sentence(3), // Nome fictício da task
            'descricao_task' => $this->faker->paragraph, // Descrição fictícia
            'status_task' => $this->faker->randomElement(['TAREFAS', 'FAZENDO', 'ANALISE', 'FINALIZADO']), // Status aleatório
            'user_responsavel' => "1", // Associa um usuário fictício
            'prazo' => $this->faker->date(), // Data de prazo fictícia
        ];
    }
}
