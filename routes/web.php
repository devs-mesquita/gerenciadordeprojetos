<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TarefasGeraisController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\SetorController;

// Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
// reset de senha
Route::get('/change-password', [ChangePassword::class, 'show'])->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->name('change.perform');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');

Route::group(['middleware' => 'auth'], function () {

	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
	

	// tarefas_gerais
	Route::get('/', 						[TarefasGeraisController::class, 'index'])->name('home');

	Route::get('/filtro/{setor?}', 						[TarefasGeraisController::class, 'index']);
	// Route::get('tarefas_gerais/create', 	[TarefasGeraisController::class, 'create']); //create
	// Route::store('tarefas_gerais',			[TarefasGeraisController::class, 'store']); //store
	// Route::get('tarefas_gerais/edit', 		[TarefasGeraisController::class, 'edit']); //edit
	// Route::store('tarefas_gerais', 			[TarefasGeraisController::class, 'update']); //update

	Route::resources([
		'projeto'	   => ProjetoController::class,
		'task'	   => TaskController::class,
		'user'	   => UserController::class,
		'tarefas_gerais'   => TarefasGeraisController::class,
		'secretaria'   => SecretariaController::class,
		'setor'   => SetorController::class,
	]);

	Route::get('alterasenha',	[UserController::class, 'alterasenha'])->name('alterasenha');
	Route::post('postalterasenha', 	[UserController::class, 'postalterasenha'])->name('postalterasenha');
	Route::post('/cadastrar_projeto', [ProjetoController::class, 'cadastrar_projeto'])->name('cadastrar_projeto');
	Route::post('/mostrar_projeto/{id}', [ProjetoController::class, 'mostrar_projeto'])->name('mostrar_projeto');
	Route::post('/cadastrar_task', [TaskController::class, 'cadastrar_task'])->name('cadastrar_task');
    Route::get('/gerenciar_projeto/{id}', [TaskController::class, 'gerenciar_projeto'])->name('gerenciar_projeto');
    Route::post('/task/update-status', [TaskController::class, 'updateStatus'])->name('task.updateStatus');
	
	Route::get('/setores-relacionados', [TarefasGeraisController::class, 'getSetoresRelacionados'])
	->name('setores.relacionados');











});

