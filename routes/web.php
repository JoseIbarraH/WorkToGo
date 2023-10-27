<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Request\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
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

Route::get('/perfil',[HomeController::class,'perfil']);


//=============================== Service Controller ====================================

Route::get('/service',[serviceController::class,'showServi']);

Route::post('/gestionJobs',[ServiceController::class,'saveService']);

Route::get('/gestionJobs',[ServiceController::class,'gestionJobs'])->name('gestionJobs');

Route::get('/gestionJobs/{servicio}/editar',[ServiceController::class,'showEditar'])->name('gestionJobs.editar');

route::put('/gestionJobs/{servicio}', [serviceController::class, 'update'])->name('gestionJobs.update');

route::delete('/gestionJobs/{servicio}', [serviceController::class, 'destroy'])->name('gestionarJobs.destroy');


//=============================== Logout Controller =======================================

Route::get('/logout',[LogoutController::class,'logout']);

            