<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Client\ClientDashboardController;
use App\Livewire\Admin\Products;
use App\Livewire\Store\Homepage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', Homepage::class)->name('home');

Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();
    if (! $user) {
        return redirect('/');
    }
    return $user->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('client.dashboard');
})->name('dashboard');

// profile permanece
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// rotas admin
Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/products', Products::class)->name('products');
});

// rotas client com URI diferente para evitar colisão com /dashboard global
Route::middleware(['auth','role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
    // outras rotas exclusivas de client...
});

require __DIR__.'/auth.php';
