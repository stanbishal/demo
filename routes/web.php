<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\Admin\LinkController as AdminLinkController;

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
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/shorten/url',[LinkController::class,'shortenURL'])->name('shorten.url');


Route::controller(AdminLinkController::class)->middleware('auth')->prefix('admin')->name('admin.')->group(function() {
    Route::get('/list-links','index')->name('list-links');
    Route::get('/view-link/{id}','view')->name('view-link');
    Route::get('/delete-link/{id}','delete')->name('delete-link');
    Route::get('/search-link','searchLinks')->name('search-links'); 
});


require __DIR__.'/auth.php';

Route::get('{code}',[LinkController::class,'shortLink'])->name('short.link');

