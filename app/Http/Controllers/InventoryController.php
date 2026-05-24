<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('product')->latest()->get();
        return view('inventories.index', compact('inventories'));
    }

    public function create()
    {
        $products = Product::all();
        return view('inventories.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'type'       => 'required',
            'note'       => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->type === 'restock') {
            $product->increment('stock', $request->quantity);
        } elseif ($request->type === 'adjustment') {
            if ($request->quantity > $product->stock) {
                return back()->withErrors(['quantity' => 'Cannot adjust more than current stock (' . $product->stock . ')'])->withInput();
            }
            $product->decrement('stock', $request->quantity);
        }

        Inventory::create($request->all());

        return redirect()->route('inventories.index')->with('success', 'Inventory record added!');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventories.index')->with('success', 'Record deleted!');
    }

    public function show(Inventory $inventory) {}
    public function edit(Inventory $inventory) {}
    public function update(Request $request, Inventory $inventory) {}
}