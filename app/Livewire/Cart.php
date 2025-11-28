<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $cart = [];

    public function mount() {
        $this->cart = session()->get('cart', []);
    }

    public function add($productId)
    {
        $product = Product::find($productId);

        if (!$product) return;

        $this->cart[$productId] = [
            'name' => $product->name,
            'price' => $product->price,
            'qty' => ($this->cart[$productId]['qty'] ?? 0) + 1,
        ];

        session()->put('cart', $this->cart);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
