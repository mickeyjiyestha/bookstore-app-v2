<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RatingController;

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

Route::get('/', [BookController::class, 'index'])->name('books.index');

Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');

Route::get('/rating', [RatingController::class, 'index'])->name('rating.index');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');