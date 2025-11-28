@extends('layouts.public')

@section('title', 'Checkout')

<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
            <p class="text-gray-600 mt-2">Revise seu pedido e finalize a compra</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Summary -->
            <div class="lg:col-span-2">
                <!-- Items Review -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Resumo do Pedido</h2>

                    <div class="space-y-4">
                        @foreach($cartItems as $item)
                            <div class="flex gap-4 pb-4 border-b border-gray-200 last:border-b-0">
                                @if($item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded-lg">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif

                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">Quantidade: {{ $item->quantity }}</p>
                                    <p class="text-indigo-600 font-bold mt-2">{{ number_format($item->price * $item->quantity, 2, ',', '.') }} MT</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Checkout Form -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Dados de Entrega</h2>

                    <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                                <input type="text" id="full_name" name="full_name" required class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('full_name', auth()->user()->name) }}">
                                @error('full_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" name="email" required class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('email', auth()->user()->email) }}">
                                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="tel" id="phone" name="phone" required class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="(+258) 84 123 4567">
                            @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Endereço</label>
                            <input type="text" id="address" name="address" required class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Rua, número, complemento">
                            @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">Cidade</label>
                                <input type="text" id="city" name="city" required class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                                @error('city') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="payment_method" class="block text-sm font-medium text-gray-700">Método de Pagamento</label>
                                <select id="payment_method" name="payment_method" required class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Selecione um método</option>
                                    <option value="credit_card">Cartão de Crédito</option>
                                    <option value="debit_card">Cartão de Débito</option>
                                    <option value="pix">PIX</option>
                                    <option value="bank_transfer">Transferência Bancária</option>
                                </select>
                                @error('payment_method') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition mt-6">
                            Confirmar Pedido
                        </button>
                    </form>
                </div>
            </div>

            <!-- Order Total -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Resumo</h2>

                    <div class="space-y-3 border-b border-gray-200 pb-4 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-semibold">{{ number_format($total, 2, ',', '.') }} MT</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Frete:</span>
                            <span class="font-semibold text-green-600">Grátis</span>
                        </div>
                    </div>

                    <div class="flex justify-between mb-6">
                        <span class="text-lg font-bold text-gray-900">Total:</span>
                        <span class="text-lg font-bold text-indigo-600">{{ number_format($total, 2, ',', '.') }} MT</span>
                    </div>

                    <a href="/" class="block w-full px-4 py-2 text-center text-indigo-600 border-2 border-indigo-600 rounded-lg hover:bg-indigo-50 transition mb-2">
                        Continuar Comprando
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
