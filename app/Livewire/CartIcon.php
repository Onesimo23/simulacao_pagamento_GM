<?php

namespace App\Livewire;

use App\Models\CartItem;
use Livewire\Component;

class CartIcon extends Component
{
    public $cartCount = 0;

    #[On('cartUpdated')]
    public function updateCount()
    {
        if (auth()->check()) {
            $this->cartCount = CartItem::where('user_id', auth()->id())->sum('quantity');
        }
    }

    public function mount()
    {
        $this->updateCount();
    }

    public function render()
    {
        return view('livewire.cart-icon');
    }
}
