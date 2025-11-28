<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
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
Route::post('/add-to-cart', function (\Illuminate\Http\Request $request) {
    Log::info('Add to cart chamado', $request->all());

    if (!auth()->check()) {
        return response()->json(['success' => false, 'message' => 'Não autenticado'], 401);
    }

    $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1);

    if (!$productId || $quantity < 1) {
        return response()->json(['success' => false, 'message' => 'Dados inválidos'], 400);
    }

    try {
        $product = \App\Models\Product::findOrFail($productId);
        $user = auth()->user();

        $cartItem = \App\Models\CartItem::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
            $message = 'Quantidade aumentada!';
        } else {
            \App\Models\CartItem::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
            $message = 'Produto adicionado!';
        }

        Log::info('Sucesso ao adicionar', ['user_id' => $user->id, 'product_id' => $productId]);

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    } catch (\Exception $e) {
        Log::error('Erro ao adicionar', ['error' => $e->getMessage()]);
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
})->middleware('auth');


Route::get('/', Homepage::class)->name('home');
Route::get('/cart', function () {
    return view('cart.index');
})->name('cart.index');

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
})->middleware('auth');

require __DIR__.'/auth.php';
