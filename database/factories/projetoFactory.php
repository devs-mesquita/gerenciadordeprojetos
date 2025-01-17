<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projeto>
 */
class ProjetoFactory extends Factory
{
    protected $model = \App\Models\Projeto::class;

    public function definition(): array
    {
        return [
            'nome_projeto' => $this->faker->company, // Nome fictício para o projeto
            'descricao_projeto' => $this->faker->sentence, // Frase curta para descrição
            'tempo_limite' => $this->faker->date(), // Data aleatória
            'setor' => $this->faker->randomElement(['SAUDE', 'PREFEITURA', 'EDUCACAO']), // Setor aleatório
            'repositorio' => $this->faker->url, // URL para repositório fictício
        ];
    }
}
