<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\PostulacionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Request\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\serviceController;

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
    return view('home.index');
});


//=============================== Register Controller =====================================

Route::get('/register',[RegisterController::class,'show']);

Route::post('/register',[RegisterController::class,'register']);


//=============================== Login Controller ======================================

Route::get('/login',[LoginController::class,'show']);

Route::post('/login',[LoginController::class,'login']);


//=============================== Home Controller =======================================

Route::get('/home',[HomeController::class,'index']);

Route::get('/perfil',[HomeController::class,'perfil'])->name('perfil');

Route::get('/perfil/history', [HomeController::class,'history'])->name('history');

Route::get('/pqrs',[HomeController::class,'pqrs']);

Route::post('/perfil/postulacion',[HomeController::class,'savepostu'])->name('savepostu');

Route::get('/perfil/postulacion',[HomeController::class,'postulacion'])->name('postulacion');

Route::put('/perfil/postulacion',[HomeController::class,'cancelPublic'])->name('cancelar');

Route::post('/perfil/actualizar', [HomeController::class,'update'])->name('actualizacion');

Route::get('/pqr',[HomeController::class,'showpqr'])->name('show.pqr');

Route::post('/pqr/save',[HomeController::class, 'savepqr'])->name('pqr.save');

//=============================== Service Controller ====================================

Route::get('/service',[serviceController::class,'showServi']);

Route::post('/gestionJobs',[ServiceController::class,'saveService']);

Route::get('/gestionJobs',[ServiceController::class,'gestionJobs'])->name('gestionJobs');

Route::get('/gestionJobs/solicitudes',[ServiceController::class,'solicitudes'])->name('gestionJobs.solicitudes');

Route::post('/gestionJobs/solicitudes/{id}/{CodigoTrabajador}',[ServiceController::class,'acceptJob'])->name('gestionJobs.aceptar');

Route::put('/gestionJobs/solicitudes/{id}/{CodigoTrabajador}',[ServiceController::class,'terminar'])->name('gestionJobs.terminar');

Route::get('/gestionJobs/pendientes',[ServiceController::class,'showpendientes'])->name('gestionJobs.pendientes');

Route::get('/gestionJobs/{servicio}/editar',[ServiceController::class,'showEditar'])->name('gestionJobs.editar');

Route::put('/gestionJobs/{servicio}', [serviceController::class, 'update'])->name('gestionJobs.update');

Route::delete('/gestionJobs/{servicio}', [serviceController::class, 'destroy'])->name('gestionarJobs.destroy');

Route::post('service/reporte',[ServiceController::class,'reportar'])->name('service.reportar');

//=============================== Postulacion Controller =================================

Route::post('/service/{servicio}',[PostulacionController::class,'postu'])->name('postular');

Route::get('/service/{service}',[PostulacionController::class, 'show'])->name('showInfo');


//=============================== MetodoPago Controller ==================================

Route::post('/perfil/nuevoMetodoPago',[MetodoPagoController::class,'nuevoMetodoPago'])->name('nuevoMetodoPago');

Route::delete('/perfil/delete/{metodo_pago}',[MetodoPagoController::class, 'destroy'])->name('deleteTarjeta');

//=============================== Administrador Controller ================================

Route::get('/administrador/reportes',[AdministradorController::class, 'showreportes'])->name('show.reportes');

Route::delete('/administrador/reportes/{reporte}',[AdministradorController::class, 'eliminarReporte'])->name('admin.delete.reportes');

Route::get('/administrador',[AdministradorController::class,'index']);

Route::get('/administrador/pqr',[AdministradorController::class, 'pqrshow'])->name('pqr.show');

Route::get('/administrador/servicios',[AdministradorController::class, 'showServices'])->name('admin.showservice');

Route::get('/administrador/postulacion',[AdministradorController::class,'listaPostu']);

Route::put('/administrador/update',[AdministradorController::class,'editar'])->name('admin.update');

Route::put('/administrador/supender', [AdministradorController::class,'suspender'])->name('admin.suspender');

Route::delete('/administrador/postulacion/delete',[AdministradorController::class,'deletePostu'])->name('admin.delete');

Route::post('/administrador/postulacion/aceptar',[AdministradorController::class,'aceptarPostu'])->name('admin.aceptar');

Route::delete('/administrador/servicios/eliminar',[AdministradorController::class,'eliminarServicios'])->name('admin.serviceDelete');

Route::put('/administrador/pqr/respuesta',[AdministradorController::class, 'respuesta'])->name('admin.respuesta');

Route::delete('/administrador/pqr/delete',[AdministradorController::class,'eliminarpqr'])->name('admin.pqrdelete');

//=============================== Logout Controller =======================================

Route::get('/logout',[LogoutController::class,'logout']);

            