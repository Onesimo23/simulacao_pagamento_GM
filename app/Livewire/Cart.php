<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class Cart extends Component {
    public $cart = [];

    protected $listeners = ['addToCart' => 'add', 'removeFromCart' => 'remove'];

    public function mount() {
        $this->cart = session()->get('cart', []);
    }

    public function add($productId) {
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        $this->cart = $cart;
        $this->emit('cartUpdated');
    }

    public function remove($productId) {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        session()->put('cart', $cart);

        $this->cart = $cart;

        // atualiza o header
        $this->emit('cartUpdated');
    }

    public function render() {
        return view('livewire.cart');
    }
}
