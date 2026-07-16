<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagodaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TownshipController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

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

Route::middleware('auth')->group(function () {
    Route::get('/admin/townships', [TownshipController::class, 'index'])->name('admin.townships.index');
    Route::get('/admin/townships/create', [TownshipController::class, 'create'])->name('admin.townships.create');
    Route::post('/admin/townships', [TownshipController::class, 'store'])->name('admin.townships.store');
    Route::get('/admin/townships/{township}/edit', [TownshipController::class, 'edit'])->name('admin.townships.edit');
    Route::put('/admin/townships/{township}', [TownshipController::class, 'update'])->name('admin.townships.update');
    Route::get('/admin/get-districts-by-division/{division_id}', [TownshipController::class, 'getDistrictsByDivision'])->name('admin.get-districts-by-division');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/districts', [DistrictController::class, 'index'])->name('admin.districts.index');
    Route::get('/admin/districts/create', [DistrictController::class, 'create'])->name('admin.districts.create');
    Route::post('/admin/districts', [DistrictController::class, 'store'])->name('admin.districts.store');
    Route::get('/admin/districts/{district}/edit', [DistrictController::class, 'edit'])->name('admin.districts.edit');
    Route::put('/admin/districts/{district}', [DistrictController::class, 'update'])->name('admin.districts.update');

});

Route::middleware('auth')->group(function () {
    Route::get('/admin/pagodas', [PagodaController::class, 'index'])->name('admin.pagodas.index');
    Route::get('/admin/pagodas/create', [PagodaController::class, 'create'])->name('admin.pagodas.create');
    Route::post('/admin/pagodas', [PagodaController::class, 'store'])->name('admin.pagodas.store');
    Route::get('/admin/pagodas/{pagoda}/edit', [PagodaController::class, 'edit'])->name('admin.pagodas.edit');
    Route::put('/admin/pagodas/{pagoda}', [PagodaController::class, 'update'])->name('admin.pagodas.update');
    Route::get('/admin/get-townships-by-district/{district_id}', [PagodaController::class, 'getTownshipsByDistrict'])->name('admin.get-townships-by-district');
});
require __DIR__.'/auth.php';
