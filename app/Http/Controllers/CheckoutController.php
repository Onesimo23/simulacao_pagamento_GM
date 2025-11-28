<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{   
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'O carrinho está vazio.');
        }

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return view('checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        return redirect()->back()->with('error', 'Lógica de simulação pendente.');
    }

    public function confirmation(Order $order)
    {
        return view('checkout.confirmation', compact('order'));
    }
}
