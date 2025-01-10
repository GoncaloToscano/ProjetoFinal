<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Car;
use App\Models\TestDrive;
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

        // Passando as variáveis para a view
        return view('dashboard', compact('usersCount', 'employeesCount', 'carsCount', 'testDrivesCount'));
    }
}
