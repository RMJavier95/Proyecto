<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RegisterController;

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

Route::get('/principal', function () {
    return view('principal');
});

Route::get('/resenas', function () {
    return view('resenas');
});

Route::get('/favorites', function () {
    return view('favorites');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');


Route::get('/book/search', [BookController::class, 'search'])->name('book.search');
Route::get('/book/{id}', [BookController::class, 'show'])->name('book.show');


Route::post('/favorites/{id}', [FavoriteController::class, 'store'])->name('favorites.store');
Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::get('/favorites/{id}', [FavoriteController::class, 'show'])->name('favorites.show');



/*Route::post('/favorites/{id}', [FavoriteController::class, 'store'])->name('favorites.store');
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');*/

Route::get('/principal', [HomeController::class, 'index'])->name('book.home');
Route::get('/resena', [ResenaController::class, 'index'])->name('resena');
