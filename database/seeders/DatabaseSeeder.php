<?php

namespace Database\Seeders;

use Database\Factories\PacienteFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SecretariaSeeder::class,
            UserSeeder::class,
            // projetosSeeder::class,
            // TaskSeeder::class,
        ]);

    }
}
