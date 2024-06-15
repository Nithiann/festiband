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
Route::get('/artist/{id}', [ArtistController::class, 'details'])->name('artists.details');


Route::middleware('checkRole:admin')->group(function () {
    Route::get('/admin/festival', [AdminController::class, 'FestivalIndex'])->name('festival-admin-list');

    Route::get('/admin/festival/create', function () {
        return view('festival.admin.create');
    })->name('admin.festival.create');
    Route::post('/festival/create', [FestivalController::class, 'create'])->name('festival.store');
    Route::get('/admin/festival/{festival}/lineup', [FestivalController::class, 'lineupPage'])->name('admin.festivals.lineup');
    Route::post('/admin/festival/{festival}/lineup', [FestivalController::class, 'submitLineup'])->name('admin.festivals.lineup');
    Route::get('/admin/artist/{id}/edit', [ArtistController::class, 'edit'])->name('admin.artists.edit');
    Route::delete('/admin/artist/{id}', [ArtistController::class, 'destroy'])->name('admin.artists.destroy');
    Route::get('/admin/festival/{id}/edit', [FestivalController::class, 'edit'])->name('admin.festivals.edit');
    Route::delete('/admin/festival/{id}', [FestivalController::class, 'destroy'])->name('admin.festivals.destroy');
    Route::get('/admin/artist', [AdminController::class, 'ArtistIndex'])->name('artist-admin-list');

    Route::get('/artists/create', function () {
        return view('artist.admin.create');
    })->name('admin.artist.create');
    Route::post('/artists/create', [ArtistController::class, 'store'])->name('admin.artist.store');
});




require __DIR__.'/auth.php';
