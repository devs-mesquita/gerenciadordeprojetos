<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\User::firstOrCreate(["email" => "admin@argon.com"], [
            'name' => 'admin',
            'email' => 'admin@argon.com',
            'nivel'=>'ADMIN',            
            'password' => '$2y$10$eMMXLkP579E/hf8.oSBJRu.yndQDIU0XrjRsY/R9Sr6hxzjToy0gC',
            'cpf'=> '11111111111',
            'telefone'=>'22222222222',
            'setor_id'=> 1,
        ]);

    }
}
