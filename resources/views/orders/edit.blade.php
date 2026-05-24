@extends('layouts.app')
@section('content')
@if($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-3 rounded text-sm mb-2">
        {{ $errors->first() }}
    </div>
@endif
<div class="max-w-lg">
    <h2 class="text-2xl font-bold text-amber-900 mb-6">Edit Order</h2>
    <form action="{{ route('orders.update', $order) }}" method="POST" class="bg-white rounded-xl shadow p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Customer Name</label>
            <input name="customer_name" type="text" value="{{ $order->customer_name }}" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Product</label>
            <select name="product_id" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $order->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} — ${{ $product->price }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
            <input name="quantity" type="number" min="1" value="{{ $order->quantity }}" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400">
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-amber-700 text-white px-5 py-2 rounded-lg hover:bg-amber-800 text-sm">Update</button>
            <a href="{{ route('orders.index') }}" class="text-sm text-gray-500 hover:underline self-center">Cancel</a>
        </div>
    </form>
</div>
@endsection