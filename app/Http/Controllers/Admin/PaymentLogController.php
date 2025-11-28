<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentLogController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order')->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.payments.index', compact('payments'));
    }
}
