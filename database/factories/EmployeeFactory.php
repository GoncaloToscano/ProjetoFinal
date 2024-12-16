<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'position' => $this->faker->randomElement([
                'fundador',
                'chefe_concessionaria',
                'vendedor',
                'diretor_marketing',
                'gerente_financeiro',
                'gerente_vendas',
                'assistente_administrativo',
                'supervisor_oficina',
                'consultor_comercial',
                'assessor_marketing',
            ]),
            'salary' => $this->faker->randomFloat(2, 1000, 10000), // Gera um salário aleatório entre 1000 e 10000
        ];
    }
}
