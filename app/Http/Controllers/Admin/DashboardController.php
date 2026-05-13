<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])
                        ->latest()
                        ->get();

       return view('admin.index', compact('orders')); 
    }
}
