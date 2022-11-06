<?php

use App\Http\Controllers\WorkingTimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::group(['prefix' => 'auth', 'namespace' => 'Auth', 'as' => 'auth.'], function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::post('create', [AuthController::class, 'createUser'])->name('createUser');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('working', [WorkingTimeController::class, 'point'])->name('point');
    Route::get('reports', [WorkingTimeController::class, 'reports'])->name('reports');
    Route::get('me', [UserController::class, 'profile'])->name('me');
    Route::post('register', [WorkingTimeController::class, 'register'])->name('point.register');
});
