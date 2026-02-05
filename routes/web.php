<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SizeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Items CRUD routes
    Route::resource('items', ItemController::class);
    
    // Types CRUD routes
    Route::resource('types', TypeController::class);
    
    // Categories CRUD routes
    Route::resource('categories', CategoryController::class);
    
    // Classifications CRUD routes
    Route::resource('classifications', ClassificationController::class);
    
    // Colors CRUD routes
    Route::resource('colors', ColorController::class);
    
    // Materials CRUD routes
    Route::resource('materials', MaterialController::class);
    
    // Sizes CRUD routes
    Route::resource('sizes', SizeController::class);
});


Route::get('/admin', function () {
    return view('admin');
})->middleware('auth');

require __DIR__.'/auth.php';
