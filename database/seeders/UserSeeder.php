<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // Criar um usuário padrão
    User::factory()->create([
        'name' => 'user',
        'email' => 'user@gmail.com',
        'role' => 'user',
        'password' => bcrypt('user'),
    ]);

        // Criar um administrador padrão
        User::factory()->admin()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);
    }
}
