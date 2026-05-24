@extends('layouts.app')
@section('content')
<div class="max-w-lg">
    <h2 class="text-2xl font-bold text-amber-900 mb-6">Add Product</h2>
    <form action="{{ route('products.store') }}" method="POST" class="bg-white rounded-xl shadow p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input name="name" type="text" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <input name="category" type="text" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
            <input name="price" type="number" step="0.01" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
            <input name="stock" type="number" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400" required>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-amber-700 text-white px-5 py-2 rounded-lg hover:bg-amber-800 text-sm">Save</button>
            <a href="{{ route('products.index') }}" class="text-sm text-gray-500 hover:underline self-center">Cancel</a>
        </div>
    </form>
</div>
@endsection