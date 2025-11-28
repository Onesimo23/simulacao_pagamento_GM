<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientDashboardController extends Controller
{
    /**
     * Show client dashboard.
     */
    public function index(Request $request)
    {
        return view('client.dashboard');
    }
}
