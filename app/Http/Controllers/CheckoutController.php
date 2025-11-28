<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = CartItem::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/')->with('warning', 'Seu carrinho está vazio!');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('checkout.index', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'payment_method' => 'required|in:credit_card,debit_card,pix,bank_transfer',
        ]);

        try {

            CartItem::where('user_id', auth()->id())->delete();

            return redirect('/')->with('success', 'Compra realizada com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao processar a compra: ' . $e->getMessage());
        }
    }
}
