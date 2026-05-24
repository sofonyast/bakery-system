<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Inventory;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        $lowStock = Product::where('stock', '<=', 5)->get();
        $recentOrders = Order::with('product')->latest()->take(5)->get();
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');

        return view('dashboard', compact(
            'totalProducts',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'lowStock',
            'recentOrders',
            'totalRevenue'
        ));
    }
}