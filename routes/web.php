<?php

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

Route::get('/', function () {
    return view('website.home');
})->name('home_page');

Auth::routes(['register' => false]);

Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::resource('pages', \App\Http\Controllers\PageController::class);
});

Route::get('/create', [App\Http\Controllers\ProfileController::class, 'create'])->name('create');
Route::post('/create', [App\Http\Controllers\ProfileController::class, 'store'])->name('store');

Route::get('view/{id}', [App\Http\Controllers\ProfileController::class, 'view'])->name('view');

Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');



