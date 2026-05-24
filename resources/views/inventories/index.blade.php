@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-amber-900">Inventory Log</h2>
    <a href="{{ route('inventories.create') }}" class="bg-amber-700 text-white px-4 py-2 rounded hover:bg-amber-800 text-sm">+ Add Record</a>
</div>
<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-amber-100 text-amber-900 text-left">
            <tr>
                <th class="px-4 py-3">Product</th>
                <th class="px-4 py-3">Type</th>
                <th class="px-4 py-3">Quantity</th>
                <th class="px-4 py-3">Note</th>
                <th class="px-4 py-3">Date</th>
                <th class="px-4 py-3">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-amber-50">
            @forelse($inventories as $record)
            <tr class="hover:bg-amber-50">
                <td class="px-4 py-3 font-medium">{{ $record->product->name ?? 'N/A' }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs font-medium
                        {{ $record->type === 'restock' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $record->type === 'sale' ? 'bg-blue-100 text-blue-700' : '' }}
                        {{ $record->type === 'adjustment' ? 'bg-orange-100 text-orange-700' : '' }}">
                        {{ ucfirst($record->type) }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ $record->quantity }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $record->note ?? '—' }}</td>
                <td class="px-4 py-3 text-gray-400">{{ $record->created_at->format('M d, Y') }}</td>
                <td class="px-4 py-3">
                    <form action="{{ route('inventories.destroy', $record) }}" method="POST" onsubmit="return confirm('Delete this record?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-6 text-center text-gray-400">No inventory records yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection