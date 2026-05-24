<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

public function store(Request $request)
{
    $request->validate([
        'customer_name' => 'required',
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'status' => 'required',
    ]);

    $product = Product::findOrFail($request->product_id);

    // Only check and deduct stock if not cancelled
    if ($request->status !== 'cancelled') {
        if ($request->quantity > $product->stock) {
            return back()->withErrors(['quantity' => 'Not enough stock. Only ' . $product->stock . ' left.'])->withInput();
        }
        $product->decrement('stock', $request->quantity);
    }

    $total = $product->price * $request->quantity;

    Order::create([
        'customer_name' => $request->customer_name,
        'product_id' => $request->product_id,
        'quantity' => $request->quantity,
        'total_price' => $total,
        'status' => $request->status,
    ]);

    return redirect()->route('orders.index')->with('success', 'Order created!');
}

    public function edit(Order $order)
    {
        $products = Product::all();
        return view('orders.edit', compact('order', 'products'));
    }

public function update(Request $request, Order $order)
{
    $request->validate([
        'customer_name' => 'required',
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'status' => 'required',
    ]);

    $product = Product::findOrFail($request->product_id);
    $oldStatus = $order->status;
    $newStatus = $request->status;
    $oldQuantity = $order->quantity;
    $newQuantity = $request->quantity;

    $wasActive = $oldStatus !== 'cancelled';
    $isActive = $newStatus !== 'cancelled';

    if ($wasActive && $isActive) {
        // Both active: adjust for quantity difference
        $difference = $newQuantity - $oldQuantity;
        if ($difference > 0 && $difference > $product->stock) {
            return back()->withErrors(['quantity' => 'Not enough stock. Only ' . $product->stock . ' left.'])->withInput();
        }
        if ($difference > 0) $product->decrement('stock', $difference);
        elseif ($difference < 0) $product->increment('stock', abs($difference));

    } elseif ($wasActive && !$isActive) {
        // Active → Cancelled: restore stock
        $product->increment('stock', $oldQuantity);

    } elseif (!$wasActive && $isActive) {
        // Cancelled → Active: deduct stock
        if ($newQuantity > $product->stock) {
            return back()->withErrors(['quantity' => 'Not enough stock. Only ' . $product->stock . ' left.'])->withInput();
        }
        $product->decrement('stock', $newQuantity);

    }
    // Cancelled → Cancelled: do nothing

    $total = $product->price * $newQuantity;

    $order->update([
        'customer_name' => $request->customer_name,
        'product_id' => $request->product_id,
        'quantity' => $newQuantity,
        'total_price' => $total,
        'status' => $newStatus,
    ]);

    return redirect()->route('orders.index')->with('success', 'Order updated!');
}

    public function destroy(Order $order)
{
    // Only restore stock if order was not cancelled
    if ($order->status !== 'cancelled') {
        $order->product->increment('stock', $order->quantity);
    }
    $order->delete();
    return redirect()->route('orders.index')->with('success', 'Order deleted!');
}

    public function show(Order $order) {}
}