<?php

use App\Http\Controllers\AdvertController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
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

 Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
     return Inertia('Dashboard');
 })->name('dashboard');


 Route::get('/home',[CityController::class, 'index'])->name('Home');
 Route::get('/search/{search}',[AdvertController::class, 'search'])->name('Search');
 Route::get('/{city}',[CategoryController::class, 'index'])->name('City');
 Route::get('/{city}/{category}',[AdvertController::class, 'index'])->name('Category');
 Route::get('/{city}/{category}/{subCategory?}',[AdvertController::class, 'index'])->name('Category');
 Route::get('/{city}/{category}/advert/{advert}',[AdvertController::class, 'show'])->name('Advert');
 Route::get('/{city}/{category}/{subCategory?}/advert/{advert}',[AdvertController::class, 'show'])->name('Advert');

