@extends('layouts.app')

@section('title', 'Pagamento Confirmado')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-emerald-50 py-12">
    <div class="w-full max-w-md">
        <!-- Success Card -->
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">

            <!-- Success Icon -->
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center animate-pulse">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            <h2 class="text-3xl font-bold text-green-600 mb-2">Pagamento Confirmado!</h2>
            <p class="text-gray-600 mb-6">Sua transação foi processada com sucesso</p>

            <!-- Transaction Details -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6 space-y-4">
                <div class="border-b border-gray-200 pb-4">
                    <p class="text-gray-600 text-sm mb-1">ID da Transação</p>
                    <p class="text-xl font-bold text-gray-900">#{{ $transaction->id }}</p>
                </div>

                <div class="border-b border-gray-200 pb-4">
                    <p class="text-gray-600 text-sm mb-1">Método de Pagamento</p>
                    <div class="flex items-center justify-center gap-2 mt-2">
                        @if($transaction->payment_method === 'visa')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" class="h-8">
                        @elseif($transaction->payment_method === 'm_pesa')
                            <img src="{{ asset('m-pesa.png') }}" alt="M-Pesa" class="h-8">
                        @elseif($transaction->payment_method === 'e_mola')
                            <img src="{{ asset('emola.png') }}" alt="E-mola" class="h-8">
                        @endif
                        <span class="font-semibold text-gray-900">{{ $transaction->payment_method_label }}</span>
                    </div>
                </div>

                <div>
                    <p class="text-gray-600 text-sm mb-1">Valor Pago</p>
                    <p class="text-3xl font-bold text-green-600">
                        {{ number_format($transaction->amount, 2, ',', '.') }} MT
                    </p>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <p class="text-gray-600 text-sm mb-1">Data e Hora</p>
                    <p class="text-gray-900 font-semibold">
                        {{ $transaction->created_at->format('d/m/Y H:i:s') }}
                    </p>
                </div>
            </div>

            <!-- Status Badge -->
            <div class="mb-6 inline-block">
                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-bold">
                    ✓ {{ $transaction->status_label }}
                </span>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <a href="{{ route('home') }}" class="block w-full px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition">
                    Voltar à Loja
                </a>

                <a href="{{ route('client.dashboard') }}" class="block w-full px-6 py-3 border-2 border-indigo-600 text-indigo-600 font-bold rounded-lg hover:bg-indigo-50 transition">
                    Meus Pedidos
                </a>
            </div>
        </div>

        <!-- Info Box -->
        <div class="mt-6 bg-blue-50 border-l-4 border-blue-600 rounded-lg p-4">
            <div class="flex gap-3">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="text-left">
                    <p class="font-semibold text-blue-900 text-sm">Confirmação por Email</p>
                    <p class="text-blue-800 text-xs mt-1">Um recibo foi enviado para seu email com todos os detalhes da transação.</p>
                </div>
            </div>
        </div>

        <!-- Security Info -->
        <div class="mt-4 text-center text-gray-600 text-xs">
            <div class="flex items-center justify-center gap-1">
                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414L10 3.586l4.707 4.707a1 1 0 01-1.414 1.414L11 6.414V15a1 1 0 11-2 0V6.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                Transação segura e criptografada
            </div>
        </div>
    </div>
</div>

<!-- Confetti Animation (opcional) -->
<script>
    // Animação simples de confete
    function createConfetti() {
        const confetti = document.createElement('div');
        confetti.style.position = 'fixed';
        confetti.style.width = '10px';
        confetti.style.height = '10px';
        confetti.style.backgroundColor = ['#10b981', '#34d399', '#6ee7b7', '#a7f3d0'][Math.floor(Math.random() * 4)];
        confetti.style.left = Math.random() * window.innerWidth + 'px';
        confetti.style.top = '-10px';
        confetti.style.borderRadius = '50%';
        confetti.style.pointerEvents = 'none';
        confetti.style.zIndex = '9999';

        document.body.appendChild(confetti);

        let top = -10;
        const speed = Math.random() * 3 + 2;
        const angle = Math.random() * Math.PI * 2;

        const interval = setInterval(() => {
            top += speed;
            confetti.style.top = top + 'px';
            confetti.style.left = (parseFloat(confetti.style.left) + Math.cos(angle) * 2) + 'px';

            if (top > window.innerHeight) {
                clearInterval(interval);
                confetti.remove();
            }
        }, 30);
    }

    // Criar confete
    for (let i = 0; i < 50; i++) {
        setTimeout(createConfetti, i * 30);
    }
</script>

<style>
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>
@endsection
