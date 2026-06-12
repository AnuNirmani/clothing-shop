<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\OfferCategoryController;
use App\Http\Controllers\DashboardController; // ✅ ADD THIS
use App\Http\Controllers\SiteSettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend');
});

Route::get('/{any}', function () {
    return view('frontend');
})->where('any', 'shop|womens|mens|checkout|item/.*');

// ❌ REMOVE the old closure dashboard route that was here

Route::middleware('auth')->group(function () {
    
    // ✅ Dashboard now uses the controller
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/home-hero-image', [DashboardController::class, 'updateHomeHeroImage'])->name('dashboard.home-hero-image.update');
    Route::get('/site-settings', [SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::post('/site-settings/hero-media', [SiteSettingController::class, 'updateHeroMedia'])->name('site-settings.hero-media.update');
    Route::post('/site-settings/hero-buttons', [SiteSettingController::class, 'updateHeroButtons'])->name('site-settings.hero-buttons.update');
    Route::post('/site-settings/stores', [SiteSettingController::class, 'updateStores'])->name('site-settings.stores.update');
    Route::post('/site-settings/bank-accounts', [SiteSettingController::class, 'updateBankAccounts'])->name('site-settings.bank-accounts.update');
    Route::get('/offered-items', [ItemController::class, 'offeredItems'])->name('offered-items.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('items', ItemController::class);
    Route::resource('types', TypeController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('classifications', ClassificationController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('materials', MaterialController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('offer-categories', OfferCategoryController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('users', \App\Http\Controllers\UserController::class);
});

Route::get('/admin', function () {
    return view('admin');
})->middleware('auth');

require __DIR__.'/auth.php';