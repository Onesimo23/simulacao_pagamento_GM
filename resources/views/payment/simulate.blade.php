@extends('layouts.app')

@section('title', 'Processando Pagamento')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-50 py-12">
    <div class="w-full max-w-md">
        <div class="bg-white p-8 rounded-lg shadow-lg text-center mb-6">

            <h2 class="text-2xl font-bold mb-6 text-gray-900">Processando Pagamento</h2>

            <div class="bg-gray-50 rounded-lg p-6 mb-6 space-y-4">
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
                        <span class="font-semibold text-gray-900">
                            @if($transaction->payment_method === 'visa') Cartão Visa
                            @elseif($transaction->payment_method === 'm_pesa') M-Pesa
                            @elseif($transaction->payment_method === 'e_mola') E-mola
                            @endif
                        </span>
                    </div>
                </div>

                <div class="border-b border-gray-200 pb-4">
                    <p class="text-gray-600 text-sm mb-1">Valor</p>
                    <p class="text-2xl font-bold text-indigo-600">
                        {{ number_format($transaction->amount, 2, ',', '.') }} MT
                    </p>
                </div>

                <div>
                    <p class="text-gray-600 text-sm mb-1">ID da Transação</p>
                    <p class="font-mono text-gray-900 font-semibold">#{{ $transaction->id }}</p>
                </div>
            </div>

            @if($transaction->payment_method === 'm_pesa' || $transaction->payment_method === 'e_mola')
                <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded mb-6 text-left">
                    <h3 class="font-bold text-blue-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                        </svg>
                        Próximos Passos
                    </h3>

                    <div class="space-y-2 text-sm text-blue-800">
                        <div class="flex items-start gap-3">
                            <span class="font-bold bg-blue-200 text-blue-900 rounded-full w-6 h-6 flex items-center justify-center text-xs flex-shrink-0">1</span>
                            <div>
                                <p class="font-semibold">Verifique seu telefone</p>
                                <p class="text-xs text-blue-700">Você receberá uma notificação {{ $transaction->payment_method === 'm_pesa' ? 'M-Pesa' : 'E-mola' }} em seu celular</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="font-bold bg-blue-200 text-blue-900 rounded-full w-6 h-6 flex items-center justify-center text-xs flex-shrink-0">2</span>
                            <div>
                                <p class="font-semibold">Digite seu PIN</p>
                                <p class="text-xs text-blue-700">Insira o código PIN de segurança para confirmar o pagamento</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="font-bold bg-blue-200 text-blue-900 rounded-full w-6 h-6 flex items-center justify-center text-xs flex-shrink-0">3</span>
                            <div>
                                <p class="font-semibold">Pagamento Confirmado</p>
                                <p class="text-xs text-blue-700">Você receberá uma confirmação após o processamento</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-blue-100 rounded border border-blue-300">
                        <p class="text-xs font-semibold text-blue-900 mb-1">Número {{ $transaction->payment_method === 'm_pesa' ? 'M-Pesa' : 'E-mola' }}:</p>
                        <p class="text-sm font-mono text-blue-900 font-bold">{{ $transaction->mobile_number }}</p>
                    </div>
                </div>
            @elseif($transaction->payment_method === 'visa')
                <!-- Visa Card Info -->
                <div class="bg-purple-50 border-l-4 border-purple-600 p-4 rounded mb-6 text-left">
                    <h3 class="font-bold text-purple-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm12 4v4a2 2 0 002-2v-4a2 2 0 00-2 2zm0 0V6a2 2 0 012 2v4a2 2 0 01-2 2z" />
                        </svg>
                        Informações do Cartão
                    </h3>

                    <div class="space-y-3 text-sm text-purple-800">
                        <div>
                            <p class="text-xs text-purple-600 font-semibold">Titular</p>
                            <p class="font-semibold text-purple-900">{{ $transaction->card_holder }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-purple-600 font-semibold">Últimos 4 Dígitos</p>
                            <p class="font-mono text-purple-900 font-bold">**** **** **** {{ $transaction->card_last_four }}</p>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-purple-100 rounded border border-purple-300">
                        <p class="text-xs font-semibold text-purple-900 mb-2">Próximos Passos</p>
                        <ul class="text-xs text-purple-800 space-y-1">
                            <li class="flex items-center gap-2">
                                <span class="font-bold">•</span>
                                <span>Confirmando dados do cartão</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="font-bold">•</span>
                                <span>Processando pagamento com banco</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="font-bold">•</span>
                                <span>Finalizando transação</span>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Loading Animation -->
            <div id="loading" class="flex items-center justify-center space-x-2 mb-6">
                <div class="w-4 h-4 bg-indigo-600 rounded-full animate-bounce"></div>
                <div class="w-4 h-4 bg-indigo-600 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                <div class="w-4 h-4 bg-indigo-600 rounded-full animate-bounce" style="animation-delay: 0.4s;"></div>
            </div>

            <p class="text-gray-600 font-semibold mb-2">Processando pagamento...</p>
            <p class="text-gray-500 text-sm mb-6">⏱️ Aguarde alguns segundos enquanto confirmamos sua transação</p>

            <!-- Progress Bar -->
            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                <div id="progress" class="bg-gradient-to-r from-indigo-600 to-purple-600 h-full transition-all duration-3000" style="width: 0%"></div>
            </div>
        </div>

        <!-- Info Box -->
        <div class="bg-yellow-50 border-l-4 border-yellow-600 rounded-lg p-4">
            <div class="flex gap-3">
                <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="text-left">
                    <p class="font-semibold text-yellow-900 text-sm">📱 Atenção</p>
                    <p class="text-yellow-800 text-xs mt-1">
                        <strong>SIMULAÇÃO:</strong> Este é um ambiente de teste. Na realidade, o processamento levaria alguns minutos. Aguarde enquanto simulamos o fluxo completo.
                    </p>
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

<script>
    // Animar barra de progresso
    const progressBar = document.getElementById('progress');
    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.random() * 30;
        if (progress > 90) progress = 90;
        progressBar.style.width = progress + '%';
    }, 300);

    // Redirecionar após 3 segundos
    setTimeout(() => {
        clearInterval(interval);
        progressBar.style.width = '100%';

        setTimeout(() => {
            window.location.href = "{{ route('payment.confirm', $transaction->id) }}";
        }, 500);
    }, 3000);
</script>

<style>
    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .animate-bounce {
        animation: bounce 1s infinite;
    }
</style>
@endsection
