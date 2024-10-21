<?php 
use App\Http\Controllers\DashboardController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Dashboard\produectController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\produectsController;

/**
 * Groups routes together and applies middleware to them.
 *
 * This allows you to apply middleware to a group of routes at once,
 * rather than having to apply it to each route individually.
 *
 * The `middleware` method specifies the middleware that should be
 * applied to the routes in the group.
 *
 * The `name` method allows you to specify a name prefix for the
 * routes in the group, which can be used to generate route URLs.
 */

Route::get('/dashboard',[DashboardController::class,'index'])
->middleware(['auth']) 
->name('dashboard');
Route::resource('dashboard/categories', CategoriesController::class)
->middleware(['auth']);



Route::resource('dashboard/Produects',produectsController::class);  


Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index'); // Dashboard route
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index'); // Categories route
});



Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::resource('categories', CategoriesController::class); // This line defines all resource routes for categories
    Route::get('/', [DashboardController::class, 'index'])->name('index');
});





