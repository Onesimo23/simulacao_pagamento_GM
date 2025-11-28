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
        return view('admin.dashboard')->layout('layouts.app');
    }
}
