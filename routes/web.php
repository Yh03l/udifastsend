<?php

use App\Http\Controllers\EncomiendaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes([
    'register' => false, // Registration Routes...
    /* 'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes... */
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['checkstatus', 'auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::group(['prefix' => 'enc'], function () {
        Route::resource('encomiendas', EncomiendaController::class);
    });
});
