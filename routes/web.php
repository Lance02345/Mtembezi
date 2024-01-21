<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\BlogRequestController;
use App\Http\Controllers\ProfileController;



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
Route::get('/weather', 'WeatherController@getWeather')->name('weather');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::group(['middleware' => ['auth:web'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/send-request', [BlogRequestController::class, 'sendRequest'])->name('sendRequest'); 

});


Route::group(['middleware' => ['auth:web'], 'prefix' => 'admin', 'as' => 'admin.'],function () {

    Route::get('/add-blog', [AdminController::class, 'create'])->name('createBlog');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::get('/myblogs', [AdminController::class, 'myblogs'])->name('myblogs');
    Route::get( '/blogs/{id}/edit', [AdminController::class, 'edit'])->name('editform');
    Route::put('/blogs/{id}', [AdminController::class, 'update'])->name('update');
    Route::delete('/blogs/{id}', [AdminController::class, 'destroy'])->name('destroy');
    Route::get('/admin/blog-requests', [AdminController::class, 'blogRequests'])->name('blogRequests');
    Route::post('/admin/approve-request/{id}', [AdminController::class, 'approveRequest'])->name('approveRequest');
    Route::post('/admin/decline-request/{id}', [AdminController::class, 'declineRequest'])->name('declineRequest');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});






