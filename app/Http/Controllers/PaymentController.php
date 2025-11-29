<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\CartItem;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Simular processamento de pagamento
     */
    public function simulate($id)
    {
        $transaction = Transaction::findOrFail($id);
        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado');
        }

        return view('payment.simulate', compact('transaction'));
    }


    public function confirm($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado');
        }
        $transaction->update(['status' => 'completed']);
        CartItem::where('user_id', auth()->id())->delete();
        return view('payment.confirmation', compact('transaction'));
    }

    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id);
        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado');
        }

        $transaction->update(['status' => 'failed']);

        return redirect()->route('checkout')
            ->with('error', 'Pagamento cancelado. Tente novamente.');
    }

    public function getStatus($id)
    {
        $transaction = Transaction::findOrFail($id);
        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado');
        }

        return response()->json([
            'id' => $transaction->id,
            'status' => $transaction->status,
            'status_label' => $transaction->status_label,
            'status_color' => $transaction->status_color,
            'amount' => number_format($transaction->amount, 2, ',', '.'),
            'payment_method' => $transaction->payment_method_label,
        ]);
    }
}
