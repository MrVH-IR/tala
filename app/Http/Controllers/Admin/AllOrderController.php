<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accounter\Order;

class AllOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['asset', 'user', 'confirmedBy'])
            ->latest()
            ->paginate(10);

        return view('admin.allOrders.index', compact('orders'));
    }
}
