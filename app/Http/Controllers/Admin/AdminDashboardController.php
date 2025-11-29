<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Show admin dashboard.
     */
    public function index(Request $request)
    {
        $totalTransacoes = \App\Models\Transaction::count();
        $valorTotal = \App\Models\Transaction::sum('amount');
        $transacoesPendentes = \App\Models\Transaction::where('status', 'pending')->count();
        $transacoesPorStatus = \App\Models\Transaction::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $formasPagamento = \App\Models\Transaction::selectRaw('payment_method, COUNT(*) as total')
            ->groupBy('payment_method')
            ->pluck('total', 'payment_method')
            ->toArray();

        $formaMaisUsada = collect($formasPagamento)->sortDesc()->keys()->first();

        return view('admin.dashboard', compact(
            'totalTransacoes',
            'valorTotal',
            'transacoesPendentes',
            'transacoesPorStatus',
            'formasPagamento',
            'formaMaisUsada'
        ))->layout('layouts.app');
    }
}
