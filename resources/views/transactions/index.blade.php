@extends('layouts.app')

@section('title', 'Minhas Transações')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Registros de Transações</h1>
            <p class="text-gray-600 mt-2">Histórico de todos os seus pagamentos</p>
        </div>

        @if($transactions->count() > 0)
            <!-- Desktop Table -->
            <div class="hidden md:block bg-white rounded-lg shadow-md overflow-hidden">
                <table id="transactionsTable" class="w-full">
                    <thead class="bg-gradient-to-r from-gray-100 to-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">ID</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Método</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Valor</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Data</th>
                            <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">Ação</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach($transactions as $transaction)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                    #{{ $transaction->id }}
                                </td>

                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center gap-2">
                                        @if($transaction->payment_method === 'visa')
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" class="h-6 opacity-70">
                                        @elseif($transaction->payment_method === 'm_pesa')
                                            <img src="{{ asset('m-pesa.png') }}" alt="M-Pesa" class="h-6 opacity-70">
                                        @elseif($transaction->payment_method === 'e_mola')
                                            <img src="{{ asset('emola.png') }}" alt="E-mola" class="h-6 opacity-70">
                                        @endif
                                        <span class="font-medium text-gray-700">{{ $transaction->payment_method_label }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                    {{ number_format($transaction->amount, 2, ',', '.') }} MT
                                </td>

                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold
                                        @if($transaction->status === 'completed')
                                            bg-green-100 text-green-800
                                        @elseif($transaction->status === 'pending')
                                            bg-yellow-100 text-yellow-800
                                        @elseif($transaction->status === 'failed')
                                            bg-red-100 text-red-800
                                        @else
                                            bg-gray-100 text-gray-800
                                        @endif
                                    ">
                                        {{ $transaction->status_label }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $transaction->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <button onclick="openDetails({{ $transaction->id }})" class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">
                                        Detalhes
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="md:hidden space-y-4">
                @foreach($transactions as $transaction)
                    <div class="bg-white rounded-lg shadow p-4 border-l-4
                        @if($transaction->status === 'completed')
                            border-green-500
                        @elseif($transaction->status === 'pending')
                            border-yellow-500
                        @elseif($transaction->status === 'failed')
                            border-red-500
                        @else
                            border-gray-500
                        @endif
                    ">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-gray-900">#{{ $transaction->id }}</h3>
                            <span class="px-2 py-1 rounded-full text-xs font-bold
                                @if($transaction->status === 'completed')
                                    bg-green-100 text-green-800
                                @elseif($transaction->status === 'pending')
                                    bg-yellow-100 text-yellow-800
                                @elseif($transaction->status === 'failed')
                                    bg-red-100 text-red-800
                                @else
                                    bg-gray-100 text-gray-800
                                @endif
                            ">
                                {{ $transaction->status_label }}
                            </span>
                        </div>

                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Método:</span>
                                <span class="font-medium text-gray-900">{{ $transaction->payment_method_label }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Valor:</span>
                                <span class="font-bold text-indigo-600">{{ number_format($transaction->amount, 2, ',', '.') }} MT</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Data:</span>
                                <span class="text-gray-900">{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>

                        <button onclick="openDetails({{ $transaction->id }})" class="w-full px-3 py-2 bg-indigo-50 text-indigo-600 rounded font-medium text-sm hover:bg-indigo-100 transition">
                            Ver Detalhes
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $transactions->links() }}
            </div>

        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Nenhuma Transação</h3>
                <p class="text-gray-600 mb-6">Você ainda não realizou nenhum pagamento</p>
                <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition">
                    Comece a Comprar
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Modal de Detalhes -->
<div id="detailsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-900">Detalhes da Transação</h2>
            <button onclick="closeDetails()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div id="modalContent" class="space-y-4">
            <!-- Conteúdo carregado via AJAX -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#transactionsTable').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.8/i18n/pt-BR.json"
            },
            paging: false 
        });
    });

    function openDetails(transactionId) {
        fetch(`/payment/status/${transactionId}`)
            .then(response => response.json())
            .then(data => {
                const content = `
                    <div class="space-y-3 border-b border-gray-200 pb-4 mb-4">
                        <div>
                            <p class="text-gray-600 text-sm">ID</p>
                            <p class="font-bold text-lg">#${data.id}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Método de Pagamento</p>
                            <p class="font-semibold">${data.payment_method}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Valor</p>
                            <p class="font-bold text-xl text-indigo-600">${data.amount} MT</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Status</p>
                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                ${data.status === 'completed' ? 'bg-green-100 text-green-800' :
                                  data.status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                  'bg-red-100 text-red-800'}
                            ">
                                ${data.status_label}
                            </span>
                        </div>
                    </div>
                    <button onclick="closeDetails()" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                        Fechar
                    </button>
                `;
                document.getElementById('modalContent').innerHTML = content;
                document.getElementById('detailsModal').classList.remove('hidden');
            });
    }

    function closeDetails() {
        document.getElementById('detailsModal').classList.add('hidden');
    }

    // Fechar modal ao clicar fora
    document.getElementById('detailsModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDetails();
        }
    });
</script>

<style>
    .divide-y > * + * {
        border-top-width: 1px;
    }
</style>
@endsection
