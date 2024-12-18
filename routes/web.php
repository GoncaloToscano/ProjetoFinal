<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Aqui você pode registrar as rotas da web para sua aplicação.
| Essas rotas são carregadas pelo RouteServiceProvider dentro de um grupo
| que contém o middleware "web". Agora crie algo incrível!
|
*/

// Definir a rota nomeada 'welcome' (página inicial)
Route::get('/', [CarController::class, 'publicIndex'])->name('welcome'); // Agora usamos o CarController para a página inicial

// Rota para o Dashboard, com middleware de autenticação
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    // Rota para editar perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Rota para atualizar perfil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Rota para excluir perfil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas para demonstração de botões (exemplo de sidebar dropdown links)
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

// Cars CRUD - Rotas para gerenciamento de carros no admin
Route::resource('cars', CarController::class);
// ver mais
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

//Rota para os 4 recentes na pagina principal
Route::get('/carros', [CarController::class, 'publicIndex'])->name('cars.public');

//Rota para ver os carros na página pública
Route::get('/carros-publicos', [CarController::class, 'publicCars'])->name('cars.public.cars');

Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');

//excluir imagens
use App\Http\Controllers\ImageController;
Route::delete('/images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');

Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');


//Funcionários
use App\Http\Controllers\EmployeeController;
Route::resource('employees', EmployeeController::class);

//Users
use App\Http\Controllers\UserController;
Route::resource('users', UserController::class);


// Carregar as rotas de autenticação (login, registro, etc.)
require __DIR__ . '/auth.php';
