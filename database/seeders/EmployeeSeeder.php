<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        // Cria 50 funcionários com dados aleatórios
        Employee::factory()->count(50)->create();
    }
}
