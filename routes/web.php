<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UrlController;

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
Route::post('/store', [UrlController::class, 'insertUrl'])->name('store');
Route::get('/urls', [UrlController::class, 'readAll'])->name('urls');
Route::get('/urls/{id}', [UrlController::class, 'readUrl'])->name('url');
