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


//carsid Ver Mais
Route::get('/cars/{id}', [CarController::class, 'showById'])->name('cars.show');

// modelbybrandname
Route::get('/models-by-brand', [CarController::class, 'getModelsByBrand'])->name('cars.models.byBrand');

//Rota para os 4 recentes na pagina principal
Route::get('/carros', [CarController::class, 'publicIndex'])->name('cars.public');

//Rota para ver os carros na página pública
Route::get('/carros-publicos', [CarController::class, 'publicCars'])->name('cars.public.cars');

Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');

//excluir imagens
use App\Http\Controllers\ImageController;
Route::delete('/images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');

Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');

//testdrive
use App\Http\Controllers\TestDriveController;
// Rota para listar os test drives
Route::get('/testdrives', [TestDriveController::class, 'index'])->name('testdrives.index');
// Rota para agendar um test drive
Route::post('/testdrive/store', [TestDriveController::class, 'store'])->name('testdrive.store');
// Rota para confirmar um test drive
Route::post('/test-drives/{id}/confirm', [TestDriveController::class, 'confirm'])->name('testdrives.confirm');
// Rota para cancelar um test drive
Route::get('/testdrive/cancel/{id}', [TestDriveController::class, 'cancel'])->name('testdrive.cancel');
// Rota para cancelar um Test Drive
Route::post('/testdrives/{id}/cancel', [TestDriveController::class, 'cancel'])->name('testdrives.cancel');
Route::get('/test-drives', [TestDriveController::class, 'index'])->name('testdrives.index');
Route::post('/test-drive', [TestDriveController::class, 'store'])->name('testdrive.store');
Route::post('testdrives/{id}/confirm', [TestDriveController::class, 'confirm'])->name('testdrives.confirm');
Route::post('testdrives/{id}/cancel', [TestDriveController::class, 'cancel'])->name('testdrives.cancel');
Route::delete('testdrives/{id}', [TestDriveController::class, 'destroy'])->name('testdrives.destroy');

//Funcionários
use App\Http\Controllers\EmployeeController;
Route::resource('employees', EmployeeController::class);

//Users
use App\Http\Controllers\UserController;
Route::resource('users', UserController::class);


// Carregar as rotas de autenticação (login, registro, etc.)
require __DIR__ . '/auth.php';
