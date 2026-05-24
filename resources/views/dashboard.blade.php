@extends('layouts.app')
@section('content')

<!-- Stats Cards -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Total Products</p>
        <p class="text-3xl font-bold text-amber-800">{{ $totalProducts }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Total Orders</p>
        <p class="text-3xl font-bold text-amber-800">{{ $totalOrders }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Revenue</p>
        <p class="text-3xl font-bold text-green-700">${{ number_format($totalRevenue, 2) }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Low Stock Items</p>
        <p class="text-3xl font-bold text-red-500">{{ $lowStock->count() }}</p>
    </div>
</div>

<!-- Order Status Row -->
<div class="grid grid-cols-3 gap-4 mb-8">
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-5 text-center">
        <p class="text-xs text-yellow-600 uppercase tracking-wide mb-1">Pending</p>
        <p class="text-2xl font-bold text-yellow-700">{{ $pendingOrders }}</p>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-xl p-5 text-center">
        <p class="text-xs text-green-600 uppercase tracking-wide mb-1">Completed</p>
        <p class="text-2xl font-bold text-green-700">{{ $completedOrders }}</p>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-xl p-5 text-center">
        <p class="text-xs text-red-400 uppercase tracking-wide mb-1">Cancelled</p>
        <p class="text-2xl font-bold text-red-500">{{ $cancelledOrders }}</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Recent Orders -->
    <div class="bg-white rounded-xl shadow p-5">
        <h3 class="text-sm font-bold text-amber-900 uppercase tracking-wide mb-4">Recent Orders</h3>
        @forelse($recentOrders as $order)
        <div class="flex justify-between items-center py-2 border-b border-amber-50 last:border-0">
            <div>
                <p class="text-sm font-medium">{{ $order->customer_name }}</p>
                <p class="text-xs text-gray-400">{{ $order->product->name ?? 'N/A' }} × {{ $order->quantity }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold">${{ number_format($order->total_price, 2) }}</p>
                <span class="text-xs px-2 py-0.5 rounded-full
                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}
                    {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                    {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>
        @empty
        <p class="text-sm text-gray-400">No orders yet.</p>
        @endforelse
        <a href="{{ route('orders.index') }}" class="text-xs text-amber-700 hover:underline mt-3 inline-block">View all orders →</a>
    </div>

    <!-- Low Stock Alerts -->
    <div class="bg-white rounded-xl shadow p-5">
        <h3 class="text-sm font-bold text-amber-900 uppercase tracking-wide mb-4">⚠️ Low Stock Alerts</h3>
        @forelse($lowStock as $product)
        <div class="flex justify-between items-center py-2 border-b border-amber-50 last:border-0">
            <div>
                <p class="text-sm font-medium">{{ $product->name }}</p>
                <p class="text-xs text-gray-400">{{ $product->category }}</p>
            </div>
            <span class="text-sm font-bold text-red-500">{{ $product->stock }} left</span>
        </div>
        @empty
        <p class="text-sm text-gray-400">✅ All products are well stocked.</p>
        @endforelse
        <a href="{{ route('products.index') }}" class="text-xs text-amber-700 hover:underline mt-3 inline-block">Manage products →</a>
    </div>

</div>
@endsection