<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');

Route::get('/articles/{slug}', [App\Http\Controllers\ArticleController::class, 'show'])->name('article.show');

Route::get('/articles/tag/{tag}', [App\Http\Controllers\ArticleController::class, 'allByTag'])->name('article.tag');
