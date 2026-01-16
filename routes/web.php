<?php
use App\Http\Controllers\FoodController;

// BUYERS (public)
Route::get('/', [FoodController::class, 'publicIndex']);

// Auth routes (login, register, password, etc.)
require __DIR__.'/auth.php';

// Dashboard (authenticated landing)
Route::get('/dashboard', function () {
    return redirect()->route('admin.foods.index');
})->middleware(['auth'])->name('dashboard');

// ADMIN
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/profile', [FoodController::class, 'profile'])->name('admin.profile');
    Route::get('/foods', [FoodController::class, 'index'])->name('admin.foods.index');
    Route::get('/foods/create', [FoodController::class, 'create'])->name('admin.foods.create');
    Route::post('/foods', [FoodController::class, 'store'])->name('admin.foods.store');
    Route::get('/foods/{food}/edit', [FoodController::class, 'edit'])->name('admin.foods.edit');
    Route::put('/foods/{food}', [FoodController::class, 'update'])->name('admin.foods.update');
    Route::delete('/foods/{food}', [FoodController::class, 'destroy'])->name('admin.foods.destroy');
});
