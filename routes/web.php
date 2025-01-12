<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TestDriveController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\DashboardController; // Adicionei o controlador aqui

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

//ROTAS PROTEGIDAS.

//Protegidas pelo middleware Middleware\AdminMiddleware
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // Rota para o Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');  // Agora usa o DashboardController

    // Test-Drives Admin
    Route::get('/testdrives', [TestDriveController::class, 'index'])->name('testdrives.index'); 
    Route::get('/test-drives', [TestDriveController::class, 'index'])->name('testdrives.index'); //Gestão Admin
    Route::post('testdrives/{id}/confirm', [TestDriveController::class, 'confirm'])->name('testdrives.confirm'); //confirmar
    Route::post('testdrives/{id}/cancel', [TestDriveController::class, 'cancel'])->name('testdrives.cancel'); //cancelar
    Route::post('/test-drives/{id}/confirm', [TestDriveController::class, 'confirm'])->name('testdrives.confirm');//confirmar
    Route::delete('testdrives/{id}', [TestDriveController::class, 'destroy'])->name('testdrives.destroy'); //apagar

    // Funcionários Admin
    Route::resource('employees', EmployeeController::class);

    // Users Admin
    Route::resource('users', UserController::class);

    // Carros Admin
    Route::resource('cars', CarController::class); //gestão admin
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit'); //edit carros
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update'); //update carros
    Route::delete('/images/{image}', [ImageController::class, 'destroy'])->name('images.destroy'); //apagar imagens
});

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

// Cars Publico
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
    //carsid Ver Mais
Route::get('/cars/{id}', [CarController::class, 'showById'])->name('cars.show');
    //modelbybrandname
Route::get('/models-by-brand', [CarController::class, 'getModelsByBrand'])->name('cars.models.byBrand');
    //Rota para os 4 recentes na pagina principal
Route::get('/carros', [CarController::class, 'publicIndex'])->name('cars.public');
    //Rota para ver os carros na página pública
Route::get('/carros-publicos', [CarController::class, 'publicCars'])->name('cars.public.cars');

//Test-Drive Publico
Route::post('/testdrive/store', [TestDriveController::class, 'store'])->name('testdrive.store');
Route::get('/testdrive/cancel/{id}', [TestDriveController::class, 'cancel'])->name('testdrive.cancel');
Route::post('/testdrives/{id}/cancel', [TestDriveController::class, 'cancel'])->name('testdrives.cancel');
Route::post('/test-drive', [TestDriveController::class, 'store'])->name('testdrive.store');


use App\Http\Controllers\SuporteController;

Route::post('/suporte/enviar', [SuporteController::class, 'enviar'])->name('suporte.enviar');

// Carregar as rotas de autenticação (login, registro, etc.)
require __DIR__ . '/auth.php';
