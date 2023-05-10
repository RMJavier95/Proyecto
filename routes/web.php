<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserReviewController;

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

Route::get('/user-review', function () {
    return view('user-review');
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
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::get('/favorites/{id}', [FavoriteController::class, 'show'])->name('favorites.show');
Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');


Route::get('/principal', [HomeController::class, 'index'])->name('home');
Route::get('/books', [HomeController::class, 'books'])->name('books');
Route::get('/news', [HomeController::class, 'news'])->name('news');
Route::get('/reviews', [HomeController::class, 'reviews'])->name('reviews');
Route::get('/random-books', [HomeController::class, 'randomBooks'])->name('random-books');


Route::get('/book/{id}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::get('/book/{id}/reviews/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::post('/books/{book_id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');


Route::delete('/reviews/{book_id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
/*Hacer ruta de update*/

Route::get('/user-review', [UserReviewController::class, 'index'])->name('user-review.index');

