<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery Management</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-amber-50 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-amber-800 text-white px-6 py-4 flex items-center justify-between shadow-md">
    <h1 class="text-xl font-bold tracking-wide">🥐 Bakery Manager</h1>
    <div class="flex gap-6 text-sm font-medium">
        <a href="{{ route('dashboard') }}" class="hover:text-amber-200 transition">Dashboard</a>
        <a href="{{ route('products.index') }}" class="hover:text-amber-200 transition">Products</a>
        <a href="{{ route('orders.index') }}" class="hover:text-amber-200 transition">Orders</a>
        <a href="{{ route('inventories.index') }}" class="hover:text-amber-200 transition">Inventory</a>
    </div>
</nav>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-6 py-8">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>

</body>
</html>