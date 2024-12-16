<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Listar todos os funcionários
    public function index()
    {
        $employees = Employee::paginate(10); // Pagina os resultados, mostrando 10 por página
        return view('employees.index', compact('employees'));
    }
    

    // Mostrar formulário para criar um novo funcionário
    public function create()
    {
        return view('employees.create');
    }

    // Guardar um novo funcionário na base de dados
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric',
        ]);

        Employee::create($request->all()); // Cria o funcionário
        return redirect()->route('employees.index')->with('success', 'Funcionário criado com sucesso!');
    }

    // Mostrar detalhes de um funcionário específico
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    // Mostrar formulário para editar um funcionário
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // Atualizar os dados do funcionário na base de dados
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric',
        ]);

        $employee->update($request->all()); // Atualiza os dados
        return redirect()->route('employees.index')->with('success', 'Funcionário atualizado com sucesso!');
    }

    // Apagar um funcionário
    public function destroy(Employee $employee)
    {
        $employee->delete(); // Remove o funcionário
        return redirect()->route('employees.index')->with('success', 'Funcionário apagado com sucesso!');
    }
}
