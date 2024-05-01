<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Elevatortypes\ElevatortypesController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\ElevatorController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ReviewTypeController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\MaintInReviewController;

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

// customer //

Route::get('/clientes', [CustomerController::class, 'customer'])->name('customer');
Route::post('/clientes/insertar',[CustomerController::class,'customerInsert'])->name('insert.customer');
Route::get('/clientes/editar/{id}', [CustomerController::class, 'customerEdit'])->name('edit.customer');
Route::get('/clientes/vista/{id}', [CustomerController::class, 'customerView'])->name('view.customer');
Route::post('/clientes/actualizar/{id}', [CustomerController::class, 'customerUpdate'])->name('update.customer');
Route::delete ('/clientes/destruir/{id}',[CustomerController::class,'customerDestroy'])->name('destroy.customer');

// ElevatorType//

Route::get('/tipos/de/ascensor', [ElevatortypesController::class, 'elevatortypes'])->name('elevatortypes');
Route::post('/tipos/de/ascensor/insertar',[ElevatortypesController::class,'elevatortypesInsert'])->name('insert.elevatortypes');
Route::get('/tipos/de/ascensor/editar/{id}', [ElevatortypesController::class, 'elevatortypesEdit'])->name('edit.elevatortypes');
Route::get('/tipos/de/ascensor/detalle/{id}', [ElevatortypesController::class, 'elevatortypesDetails'])->name('details.elevatortypes');
Route::post('/tipos/de/ascensor/actualizar/{id}', [ElevatortypesController::class, 'elevatortypesUpdate'])->name('update.elevatortypes');
Route::delete('/tipos/de/ascensor/destruir/{id}',[ElevatortypesController::class,'elevatortypesDestroy'])->name('destroy.elevatortypes');

// Province //

Route::get('/provincia', [ProvinceController::class, 'province'])->name('province');
Route::post('/provincia/insertar',[ProvinceController::class,'provinceInsert'])->name('insert.province');
Route::get('/provincia/editar/{id}', [ProvinceController::class, 'provinceEdit'])->name('edit.province');
Route::get('/provincia/vista/{id}', [ProvinceController::class, 'provinceView'])->name('view.province');
Route::post('/provincia/actualizar/{id}', [ProvinceController::class, 'provinceUpdate'])->name('update.province');
Route::delete ('/provincia/destruir/{id}',[ProvinceController::class,'provinceDestroy'])->name('destroy.province');

// Elevator //

Route::get('/ascensore', [ElevatorController::class, 'elevator'])->name('elevator');
Route::post('/ascensore/insertar',[ElevatorController::class,'elevatorInsert'])->name('insert.elevator');
Route::get('/ascensore/editar/{id}', [ElevatorController::class, 'elevatorEdit'])->name('edit.elevator');
Route::get('/ascensore/vista/{id}', [ElevatorController::class, 'elevatorView'])->name('view.elevator');
Route::post('/ascensore/actualizar/{id}', [ElevatorController::class, 'elevatorUpdate'])->name('update.elevator');
Route::delete ('/ascensore/destruir/{id}',[ElevatorController::class,'elevatorDestroy'])->name('destroy.elevator');


// Maint In Review //

Route::get('/mant/en/revisión', [MaintInReviewController::class, 'maintInReview'])->name('maint_in_review');
Route::post('/mant/en/revisión/insertar',[MaintInReviewController::class,'maintInReviewInsert'])->name('insert.maint.in.review');
Route::get('/mant/en/revisión/editar/{id}', [MaintInReviewController::class, 'maintInReviewEdit'])->name('edit.maint.in.review');
Route::get('/mant/en/revisión/vista/{id}', [MaintInReviewController::class, 'maintInReviewView'])->name('view.maint.in.review');
Route::post('/mant/en/revisión/actualizar/{id}', [MaintInReviewController::class, 'maintInReviewUpdate'])->name('update.maint.in.review');
Route::delete ('/mant/en/revisión/destruir/{id}',[MaintInReviewController::class,'maintInReviewDestroy'])->name('destroy.maint.in.review');


// Maintenance //

Route::get('/mantenimiento', [MaintenanceController::class, 'maintenance'])->name('maintenance');
Route::post('/mantenimiento/insertar',[MaintenanceController::class,'maintenanceInsert'])->name('insert.maintenance');
Route::get('/mantenimiento/editar/{id}', [MaintenanceController::class, 'maintenanceEdit'])->name('edit.maintenance');
Route::get('/mantenimiento/vista/{id}', [MaintenanceController::class, 'maintenanceView'])->name('view.maintenance');
Route::post('/mantenimiento/actualizar/{id}', [MaintenanceController::class, 'maintenanceUpdate'])->name('update.maintenance');
Route::delete ('/mantenimiento/destruir/{id}',[MaintenanceController::class,'maintenanceDestroy'])->name('destroy.maintenance');


// tipos-de-revision //

Route::get('/tiposderevision', [ReviewTypeController::class, 'reviewtype'])->name('reviewtype');
Route::post('/tiposderevision/insertar',[ReviewTypeController::class,'reviewtypeInsert'])->name('insert.reviewtype');
Route::get('/tiposderevision/editar/{id}', [ReviewTypeController::class, 'reviewtypeEdit'])->name('edit.reviewtype');
Route::get('/tiposderevision/vista/{id}', [ReviewTypeController::class, 'reviewtypeView'])->name('view.reviewtype');
Route::post('/tiposderevision/actualizar/{id}', [ReviewTypeController::class, 'reviewtypeUpdate'])->name('update.reviewtype');
Route::delete ('/tiposderevision/destruir/{id}',[ReviewTypeController::class,'reviewtypeDestroy'])->name('destroy.reviewtype');

//SparePart

Route::get('/repuestos', [SparePartController::class, 'sparepart'])->name('sparepart');
Route::get('/repuestos/crear',[SparePartController::class,'sparepartCreate'])->name('create.sparepart');
Route::post('/repuestos/insertar',[SparePartController::class,'sparepartInsert'])->name('insert.sparepart');
Route::get('/repuestos/editar/{id}', [SparePartController::class, 'sparepartEdit'])->name('edit.sparepart');
Route::get('/repuestos/vista/{id}', [SparePartController::class, 'sparepartView'])->name('view.sparepart');
Route::post('/repuestos/actualizar/{id}', [SparePartController::class, 'sparepartUpdate'])->name('update.sparepart');
Route::delete ('/repuestos/destruir/{id}',[SparePartController::class,'sparepartDestroy'])->name('destroy.sparepart');

//Staff

Route::get('/personal', [StaffController::class, 'staff'])->name('staff');
Route::post('/personal/insertar',[StaffController::class,'staffInsert'])->name('insert.staff');
Route::get('/personal/editar/{id}', [StaffController::class, 'staffEdit'])->name('edit.staff');
Route::get('/personal/vista/{id}', [StaffController::class, 'staffView'])->name('view.staff');
Route::post('/personal/actualizar/{id}', [StaffController::class, 'staffUpdate'])->name('update.staff');
Route::delete ('/personal/destruir/{id}',[StaffController::class,'staffDestroy'])->name('destroy.staff');

// usuarios
Route::get('/usuarios', [UserController::class, 'user'])->name('user');
Route::post('/usuarios/insertar',[UserController::class,'userInsert'])->name('insert.user');
Route::get('/usuarios/editar/{id}', [UserController::class, 'userEdit'])->name('edit.user');
Route::get('/usuarios/vista/{id}', [UserController::class, 'userView'])->name('view.user');
Route::post('/usuarios/actualizar/{id}', [UserController::class, 'userUpdate'])->name('update.user');
Route::delete ('/usuarios/destruir/{id}',[UserController::class,'userDestroy'])->name('destroy.user');

// cronograma
Route::get('/cronograma', [ScheduleController::class, 'schedule'])->name('schedule');
Route::post('/cronograma/insertar',[ScheduleController::class,'scheduleInsert'])->name('insert.schedule');
Route::get('/get-events', [ScheduleController::class, 'getEvents'])->name('getevents');

// cargaarchivos
Route::get('/cargaarchivos', [FileUploadController::class, 'fileupload'])->name('fileupload');
Route::post('/cargaarchivos/insertar',[FileUploadController::class,'fileuploadInsert'])->name('insert.fileupload');
Route::get('/cargaarchivos/editar/{id}', [FileUploadController::class, 'fileuploadEdit'])->name('edit.fileupload');
Route::get('/cargaarchivos/vista/{id}', [FileUploadController::class, 'fileuploadView'])->name('view.fileupload');
Route::post('/cargaarchivos/actualizar/{id}', [FileUploadController::class, 'fileuploadUpdate'])->name('update.fileupload');
Route::delete ('/cargaarchivos/destruir/{id}',[FileUploadController::class,'fileuploadDestroy'])->name('destroy.fileupload');
