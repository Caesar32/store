<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;



Route::middleware('api')->group(function () {
    Route::get('/categories',[ CategoryController::class,'index']);
});
