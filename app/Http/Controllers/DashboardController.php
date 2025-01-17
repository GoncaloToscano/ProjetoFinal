<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Car;
use App\Models\TestDrive;
use App\Models\Service; // Importar o modelo de serviços
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Contadores
        $usersCount = User::count();
        $employeesCount = Employee::count();
        $carsCount = Car::count();
        $testDrivesCount = TestDrive::count();
        $servicesCount = Service::count(); // Adicionar o contador de serviços

        // Passando as variáveis para a view
        return view('dashboard', compact(
            'usersCount',
            'employeesCount',
            'carsCount',
            'testDrivesCount',
            'servicesCount' // Passar o contador de serviços
        ));
    }
}
