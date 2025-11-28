<?php

namespace App\Livewire\Store;

use App\Models\Product;
use Livewire\Component;

class Homepage extends Component {
    public function render() {
        return view('livewire.store.homepage', [
            'products' => Product::where('is_active', true)->latest()->take(12)->get()
        ])->layout('layouts.app');
    }
}
