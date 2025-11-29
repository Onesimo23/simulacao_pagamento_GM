<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect('/')->with('warning', 'Seu carrinho está vazio!');
        }

        $total = $cartItems->sum(fn($item) => $item->price * $item->quantity);

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        // Validação base
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'payment_method' => 'required|in:visa,m_pesa,e_mola',
        ]);

        // Validação específica por método de pagamento
        $paymentMethod = $request->payment_method;

        if ($paymentMethod === 'visa') {
            $request->validate([
                'card_number' => 'required|string',
                'card_holder' => 'required|string',
                'card_expiry' => 'required|string',
                'card_cvv' => 'required|string',
            ]);
        } elseif ($paymentMethod === 'm_pesa' || $paymentMethod === 'e_mola') {
            $request->validate([
                'mobile_number' => 'required|string',
            ]);
        }

        // Calcular total
        $cartItems = CartItem::where('user_id', auth()->id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect('/')->with('warning', 'Seu carrinho está vazio!');
        }

        $amount = $cartItems->sum(fn($item) => $item->price * $item->quantity);

        // Preparar dados da transação
        $transactionData = [
            'user_id' => auth()->id(),
            'payment_method' => $paymentMethod,
            'amount' => $amount,
            'status' => 'pending',
        ];

        // Adicionar dados específicos do método de pagamento
        if ($paymentMethod === 'visa') {
            $cardNumber = $request->card_number;
            $cleanCardNumber = str_replace(' ', '', $cardNumber);
            $cardLastFour = substr($cleanCardNumber, -4);

            $transactionData['card_last_four'] = $cardLastFour ?: '0000';
            $transactionData['card_holder'] = strtoupper($request->card_holder);
            $transactionData['card_number'] = $cleanCardNumber;
            $transactionData['card_expiry'] = $request->card_expiry;
            $transactionData['card_cvv'] = $request->card_cvv;
        } elseif ($paymentMethod === 'm_pesa' || $paymentMethod === 'e_mola') {
            $mobileNumber = str_replace(' ', '', $request->mobile_number);
            $transactionData['mobile_number'] = $mobileNumber;
        }

        // Criar transação
        $transaction = Transaction::create($transactionData);

        // Limpar carrinho
        CartItem::where('user_id', auth()->id())->delete();

        return redirect()->route('payment.simulate', $transaction->id);
    }
}
