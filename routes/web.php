<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// routes/web.php ထဲမှာ ဒီလိုပုံစံမျိုး ပြောင်းပေးပါ
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // တခြား admin route များ...
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/admin/divisions', [DivisionController::class, 'index'])->name('admin.divisions.index');
    Route::get('/admin/divisions/create', [DivisionController::class, 'create'])->name('admin.divisions.create');
    Route::post('/admin/divisions', [DivisionController::class, 'store'])->name('admin.divisions.store');
    Route::get('/admin/divisions/{division}/edit', [DivisionController::class, 'edit'])->name('admin.divisions.edit');
    Route::put('/admin/divisions/{division}', [DivisionController::class, 'update'])->name('admin.divisions.update');
});
require __DIR__.'/auth.php';
