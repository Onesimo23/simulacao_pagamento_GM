<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema de Simulação de Pagamentos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <!-- Adicione ao <head> do seu layout principal -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="flex h-screen flex-col lg:flex-row">
        <!-- Sidebar Estilizada -->
        <aside class="w-64 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-white flex flex-col">
            <div class="flex items-center h-16 px-6 border-b border-gray-700">
                <span class="text-xl font-bold">Sistema de S.P do G.M</span>
            </div>
            <nav class="px-4 py-6 space-y-2 flex-1">
                <a href="{{ route('home') }}" class="block px-4 py-2 rounded hover:bg-gray-800">Loja</a>
                <!-- <a href="{{ route('cart.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800">Carrinho</a> -->
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-800">Dashboard</a>
                <a href="{{ route('checkout') }}" class="block px-4 py-2 rounded hover:bg-gray-800">Checkout</a>
                <a href="{{ route('transactions.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800">Transações</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-red-900/20">Sair</button>
                </form>
            </nav>
        </aside>
        <!-- Conteúdo Principal -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                @if (isset($slot))
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>
        </div>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
