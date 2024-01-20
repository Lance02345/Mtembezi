<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\admin\AdminController;

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

Route :: get ('/',  [BlogController::class, 'index'])->name('index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::group(['middleware' => 'auth'], function () {

    
});


Route::group(['middleware' => ['auth:web'], 'prefix' => 'admin', 'as' => 'admin.'],function () {

    Route::get('/add-blog', [AdminController::class, 'create'])->name('createBlog');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::get('/myblogs', [AdminController::class, 'myblogs'])->name('myblogs');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});






