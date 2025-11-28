<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CartItem;

class CartModal extends Component
{
    public $cartItems = [];

    #[\Livewire\Attributes\On('cartUpdated')]
    public function loadCart()
    {
        if (auth()->check()) {
            // Buscar itens do banco de dados
            $this->cartItems = CartItem::where('user_id', auth()->id())
                ->with('product')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'name' => $item->product->name,
                        'image' => $item->product->image,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                    ];
                })
                ->toArray();
        }
    }

    public function mount()
    {
        $this->loadCart();
    }

    public function removeItem($itemId)
    {
        if (auth()->check()) {
            CartItem::where('id', $itemId)
                ->where('user_id', auth()->id())
                ->delete();

            $this->loadCart();
            $this->dispatch('cartUpdated');
        }
    }

    public function render()
    {
        return view('livewire.cart-modal');
    }
}
