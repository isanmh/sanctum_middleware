<?php

use App\Http\Controllers\BasicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

// cara pertam menggunakan route function closure / anonymous function
Route::get('/hai/{nama}', function ($nama) {
    return 'Hello World, ' . $nama;
});
Route::get('/hai', fn () => 'Hello World');

// ini untuk validasi parameter
Route::get('/user/{nama}', function ($nama) {
    return 'Hello ' . $nama;
    // })->where('nama', '[A-Za-z]+');
    // })->where('nama', '[0-9]+');
    // })->whereNumber('nama');
})->whereAlphaNumeric('nama');

// menggunakan controller
Route::get('/', [BasicController::class, 'index']);
Route::get('/about', [BasicController::class, 'about'])->name('about');

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// route list
Route::get('/restore/{id}', [ProductController::class, 'restore'])->name('restore');
Route::resource('products', ProductController::class)->middleware('auth');
