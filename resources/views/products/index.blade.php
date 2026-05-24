@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-amber-900">Products</h2>
    <a href="{{ route('products.create') }}" class="bg-amber-700 text-white px-4 py-2 rounded hover:bg-amber-800 text-sm">+ Add Product</a>
</div>
<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-amber-100 text-amber-900 text-left">
            <tr>
                <th class="px-4 py-3">Name</th>
                <th class="px-4 py-3">Category</th>
                <th class="px-4 py-3">Price</th>
                <th class="px-4 py-3">Stock</th>
                <th class="px-4 py-3">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-amber-50">
            @forelse($products as $product)
            <tr class="hover:bg-amber-50">
                <td class="px-4 py-3 font-medium">{{ $product->name }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $product->category }}</td>
                <td class="px-4 py-3">${{ number_format($product->price, 2) }}</td>
                <td class="px-4 py-3">{{ $product->stock }}</td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('products.edit', $product) }}" class="text-amber-700 hover:underline">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400">No products yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection