<?php

namespace App\Livewire\Store;

use App\Models\Product;
use App\Models\CartItem;
use Livewire\Component;

class Homepage extends Component {
    public $selectedProduct = null;
    public $quantity = 1;
    public $selectedProductId = null;

    protected $listeners = [
        'add-to-cart-js' => 'addToCartFromJs'
    ];

    public function showProduct($id) {
        $this->selectedProduct = Product::findOrFail($id);
        $this->selectedProductId = $id;
        $this->quantity = 1;
        $this->dispatch('openModal');
    }

    public function addToCartFromJs($productId, $quantity) {
        \Log::info('addToCartFromJs chamado', ['productId' => $productId, 'quantity' => $quantity]);

        if (!auth()->check()) {
            $this->js('alert("Você precisa estar logado!")');
            return;
        }

        if (!is_numeric($productId) || !is_numeric($quantity) || $quantity < 1) {
            $this->js('alert("Dados inválidos!")');
            return;
        }

        try {
            $product = Product::findOrFail($productId);
            $user = auth()->user();

            $cartItem = CartItem::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $quantity);
                $message = 'Quantidade aumentada no carrinho!';
            } else {
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);
                $message = 'Produto adicionado ao carrinho!';
            }

            \Log::info('Produto adicionado com sucesso', ['user_id' => $user->id, 'product_id' => $productId]);

            $this->dispatch('closeModal');
            $this->dispatch('cartUpdated');
            $this->js("alert('$message')");

        } catch (\Exception $e) {
            \Log::error('Erro ao adicionar ao carrinho', ['error' => $e->getMessage()]);
            $this->js('alert("Erro: ' . $e->getMessage() . '")');
        }
    }

    public function submitAddToCart() {
        $this->addToCartFromJs($this->selectedProductId, $this->quantity);
    }

    public function closeModal() {
        $this->selectedProduct = null;
        $this->selectedProductId = null;
        $this->dispatch('closeModal');
    }

    public function render() {
        return view('livewire.store.homepage', [
            'products' => Product::where('is_active', true)->latest()->take(12)->get()
        ])->layout('layouts.public');
    }
}
