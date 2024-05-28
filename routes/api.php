<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// user routes
Route::post('/users', [UserController::class, 'store']);

// auth routes
Route::post('/login', [AuthController::class, 'login']);

// route only accessed by admin
Route::middleware(['checkRole:admin'])->group(function() {
    // user routes
    Route::get('/users', [UserController::class, 'getAll']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // festival routes
    Route::post('/festival', [FestivalController::class, 'store']);
    Route::put('/festival/{id}', [FestivalController::class, 'update']);
    Route::delete('/festival/{id}', [FestivalController::class, 'destroy']);
    Route::post('/festival/{id}/add', [FestivalController::class, 'addToLineup']);
    Route::post('/festival/{id}/remove', [FestivalController::class, 'removeFromLineup']);

    // artist routes
    Route::post('/artist', [ArtistController::class, 'store']);
    Route::put('/artist/{id}', [ArtistController::class, 'update']);
    Route::delete('/artist/{id}', [ArtistController::class, 'destroy']);


});

// route only accessed by loggedInUser
Route::middleware(['checkAuth'])->group(function() {
    // user routes
    Route::get('/users/{id}', [UserController::class, 'getOne']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // festival routes
    Route::get('/festival', [FestivalController::class, 'getAll']);
    Route::get('/festival/{id}', [FestivalController::class, 'getOne']);
});
