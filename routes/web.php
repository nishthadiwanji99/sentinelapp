<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ActivationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'visitors'], function(){
    Route::get('/register',[RegistrationController::class, 'register']);

    Route::post('/register',[RegistrationController::class,'postRegister']);
    
    Route::get('/login', [LoginController::class,'login']);
    
    Route::post('/login',[LoginController::class,'postLogin']);
});



Route::post('/logout',[LoginController::class,'logout']);

Route::get('/earnings',[AdminController::class,'earnings'])->middleware('admin');

Route::get('/tasks', [ManagerController::class,'tasks'])->middleware('manager');

Route::get('/activate/{email}/{activationCode}', [ActivationController::class,'activate']);