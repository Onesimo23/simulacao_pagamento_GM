<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index() {
        $totalOrders = Order::count();
        $paidOrders = Order::where('status', 'PAID')->count();
        $totalPayments = Payment::count();
        $successfulPayments = Payment::where('status', 'SUCCESS')->count();
        $failedPayments = Payment::where('status', 'FAILED')->count();
        $methodStats = Payment::selectRaw('method, count(*) as count, sum(case when status = "SUCCESS" then 1 else 0 end) as success_count')
            ->groupBy('method')
            ->get();

        return view('admin.dashboard', compact('totalOrders', 'paidOrders', 'totalPayments', 'successfulPayments', 'failedPayments', 'methodStats'));
    }
}
