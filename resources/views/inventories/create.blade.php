@extends('layouts.app')
@section('content')
<div class="max-w-lg">
    <h2 class="text-2xl font-bold text-amber-900 mb-6">Add Inventory Record</h2>
    @if($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded text-sm mb-4">
            {{ $errors->first() }}
        </div>
    @endif
    <form action="{{ route('inventories.store') }}" method="POST" class="bg-white rounded-xl shadow p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Product</label>
            <select name="product_id" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400" required>
                <option value="">Select a product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->stock }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
            <select name="type" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400" required>
                <option value="restock">Restock — adds to stock</option>
                <option value="adjustment">Adjustment — removes from stock</option>
                <option value="sale">Sale — record only, no stock change</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
            <input name="quantity" type="number" min="1" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Note <span class="text-gray-400">(optional)</span></label>
            <textarea name="note" rows="2" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400"></textarea>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-amber-700 text-white px-5 py-2 rounded-lg hover:bg-amber-800 text-sm">Save</button>
            <a href="{{ route('inventories.index') }}" class="text-sm text-gray-500 hover:underline self-center">Cancel</a>
        </div>
    </form>
</div>
@endsection