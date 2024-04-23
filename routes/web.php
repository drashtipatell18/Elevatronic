<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Elevatortypes\ElevatortypesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.main');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/forgetpass', [DashboardController::class, 'forgetPass'])->name('forgetpass');
Route::get('/session', [DashboardController::class, 'Session'])->name('session');

//Clientes
Route::get('/clientes', [CustomerController::class, 'customer'])->name('customer');
Route::get('/clientes/crear',[CustomerController::class,'customerCreate'])->name('create.customer');
Route::post('/clientes/insertar',[CustomerController::class,'customerInsert'])->name('insert.customer');
Route::get('/clientes/editar/{id}', [CustomerController::class, 'customerEdit'])->name('edit.customer');
Route::get('/clientes/vista/{id}', [CustomerController::class, 'customerView'])->name('view.customer');
Route::post('/clientes/actualizar/{id}', [CustomerController::class, 'customerUpdate'])->name('update.customer');
Route::delete ('/clientes/destruir/{id}',[CustomerController::class,'customerDestroy'])->name('destroy.customer');

Route::get('/clientes/destruir/{id}',[CustomerController::class,'customerDestroy'])->name('destroy.customer');


//Elevatortypes
Route::get('/tipos/de/ascensor', [ElevatortypesController::class, 'elevatortypes'])->name('elevatortypes');
Route::get('/tipos/de/ascensor/crear',[ElevatortypesController::class,'elevatortypesCreate'])->name('create.elevatortypes');
Route::post('/tipos/de/ascensor/insertar',[ElevatortypesController::class,'elevatortypesInsert'])->name('insert.elevatortypes');
Route::get('/tipos/de/ascensor/editar/{id}', [ElevatortypesController::class, 'elevatortypesEdit'])->name('edit.elevatortypes');
Route::post('/tipos/de/ascensor/actualizar/{id}', [ElevatortypesController::class, 'elevatortypesUpdate'])->name('update.elevatortypes');
Route::get('/tipos/de/ascensor/destruir/{id}',[ElevatortypesController::class,'elevatortypesDestroy'])->name('destroy.elevatortypes');

