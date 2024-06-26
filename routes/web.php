<?php

use App\Http\Controllers\AdminController;
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

Route::view('/', 'welcome')->name('home');
Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

// accessable by everyone
Route::get('/festival/{id}', [FestivalController::class, 'details'])->name('festival.details');
Route::get('/festivals', [FestivalController::class, 'index'])->name('festival');
Route::get('/artists', [ArtistController::class, 'index'])->name('artist');
Route::get('/artist/{id}', [ArtistController::class, 'details'])->name('artist.details');

// only accessable when logged in
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// only accessable by admin
Route::middleware('checkRole:admin')->group(function () {
    // festival management routes
    Route::get('/admin/festival', [AdminController::class, 'FestivalIndex'])->name('admin.festival.list');
    Route::view('/admin/festival/create', 'festival.admin.create')->name('admin.festival.create');
    Route::post('/admin/festival/create', [FestivalController::class, 'create'])->name('festival.store');
    Route::get('/admin/festival/{id}/edit', [FestivalController::class, 'edit'])->name('admin.festival.edit');
    Route::delete('/admin/festival/{id}', [FestivalController::class, 'destroy'])->name('admin.festival.destroy');

    // lineup management routes
    Route::get('/admin/festival/{festival}/lineup', [FestivalController::class, 'lineupPage'])->name('admin.festival.lineup');
    Route::post('/admin/festival/{festival}/lineup', [FestivalController::class, 'submitLineup'])->name('admin.festival.lineup');

    // artist management routes
    Route::get('/admin/artist/{id}/edit', [ArtistController::class, 'edit'])->name('admin.artist.edit');
    Route::delete('/admin/artist/{id}', [ArtistController::class, 'destroy'])->name('admin.artist.destroy');
    Route::get('/admin/artist', [AdminController::class, 'ArtistIndex'])->name('admin.artist.list');
    Route::view('/admin/artist/create', 'artist.admin.create')->name('admin.artist.create');
    Route::post('/admin/artist/create', [ArtistController::class, 'store'])->name('admin.artist.store');
});




require __DIR__.'/auth.php';
