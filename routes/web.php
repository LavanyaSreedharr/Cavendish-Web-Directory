<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/websites', [WebsiteController::class, 'store']);
    Route::post('/websites/{website}/vote', [VoteController::class, 'store']);
    Route::delete('/websites/{website}/vote', [VoteController::class, 'destroy']);
    Route::delete('/websites/{website}', [AdminController::class, 'destroy'])->middleware('can:admin');
});

Route::get('/websites', [WebsiteController::class, 'index']);
Route::get('/websites/{website}', [WebsiteController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
