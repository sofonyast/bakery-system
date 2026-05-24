@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-amber-900">Orders</h2>
    <a href="{{ route('orders.create') }}" class="bg-amber-700 text-white px-4 py-2 rounded hover:bg-amber-800 text-sm">+ New Order</a>
</div>
<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-amber-100 text-amber-900 text-left">
            <tr>
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">Product</th>
                <th class="px-4 py-3">Qty</th>
                <th class="px-4 py-3">Total</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-amber-50">
            @forelse($orders as $order)
            <tr class="hover:bg-amber-50">
                <td class="px-4 py-3 font-medium">{{ $order->customer_name }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $order->product->name ?? 'N/A' }}</td>
                <td class="px-4 py-3">{{ $order->quantity }}</td>
                <td class="px-4 py-3">${{ number_format($order->total_price, 2) }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs font-medium
                        {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('orders.edit', $order) }}" class="text-amber-700 hover:underline">Edit</a>
                    <form action="{{ route('orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Delete this order?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-6 text-center text-gray-400">No orders yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection