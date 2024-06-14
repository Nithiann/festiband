<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/festivals/{id}', [FestivalController::class, 'details'])->name('festivals.details');
Route::get('/festivals', [FestivalController::class, 'index'])->name('festivals');
Route::get('/artists', [ArtistController::class, 'index'])->name('artists');


Route::middleware('checkRole:admin')->group(function () {
    Route::get('/admin/festivals/create', function () {
        return view('festival.create');
    })->name('add-festival');
    Route::post('/festivals/create', [FestivalController::class, 'create'])->name('festival.store');

    Route::get('/artists/create', function () {
        return view('artist.create');
    })->name('add-artist');
    Route::post('/artists/create', [ArtistController::class, 'create'])->name('artist.store');
});




require __DIR__.'/auth.php';
