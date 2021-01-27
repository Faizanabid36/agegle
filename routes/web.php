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

Route::get('/', [App\Http\Controllers\ProfileController::class,'home_page'])->name('home_page');

Auth::routes(['register' => false]);

Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::resource('pages', \App\Http\Controllers\PageController::class);
    Route::get('profiles', [\App\Http\Controllers\PageController::class,'profiles'])->name('profiles');
    Route::get('add_sponsor/{id}', [\App\Http\Controllers\PageController::class,'add_sponsor'])->name('add_sponsor');
    Route::post('store_sponsor/{id}', [\App\Http\Controllers\PageController::class,'store_sponsor'])->name('store_sponsor');
    Route::get('profile/delete/{id}', [\App\Http\Controllers\PageController::class,'delete_profile'])->name('profile.delete');
});

Route::get('/create', [App\Http\Controllers\ProfileController::class, 'create'])->name('create');
Route::post('/create', [App\Http\Controllers\ProfileController::class, 'store'])->name('store');

Route::get('view/{slug}', [App\Http\Controllers\ProfileController::class, 'view'])->name('view');
Route::post('add_image/{slug}/{age_id}', [App\Http\Controllers\ProfileController::class, 'add_image'])->name('add_image');

Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');



