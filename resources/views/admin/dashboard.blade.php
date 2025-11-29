@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Painel de Administração</h1>
    <p>Bem-vindo, administrador. Aqui estão as ferramentas e relatórios restritos a administradores.</p>

    <!-- Estatísticas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold mb-2">Total de Transações</h2>
            <p class="text-2xl font-bold">{{ $totalTransacoes }}</p>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold mb-2">Valor Total</h2>
            <p class="text-2xl font-bold">MZN {{ number_format($valorTotal, 2, ',', '.') }}</p>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold mb-2">Pendentes</h2>
            <p class="text-2xl font-bold">{{ $transacoesPendentes }}</p>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold mb-2">Forma de Pagamento Mais Usada</h2>
            <p class="text-2xl font-bold">{{ $formaMaisUsada ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
        <div class="bg-white shadow rounded p-6 flex flex-col items-center">
            <h2 class="text-lg font-semibold mb-4">Transações por Status</h2>
            <canvas id="transacoesStatusChart" width="200" height="200"></canvas>
        </div>
        <div class="bg-white shadow rounded p-6 flex flex-col items-center">
            <h2 class="text-lg font-semibold mb-4">Formas de Pagamento</h2>
            <canvas id="formasPagamentoChart" width="200" height="200"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de Status
    new Chart(document.getElementById('transacoesStatusChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_keys($transacoesPorStatus)) !!},
            datasets: [{
                data: {!! json_encode(array_values($transacoesPorStatus)) !!},
                backgroundColor: ['#22c55e', '#f59e42', '#ef4444', '#38bdf8', '#a78bfa'],
            }]
        },
        options: {
            responsive: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Gráfico de Formas de Pagamento
    new Chart(document.getElementById('formasPagamentoChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($formasPagamento)) !!},
            datasets: [{
                data: {!! json_encode(array_values($formasPagamento)) !!},
                backgroundColor: ['#38bdf8', '#f59e42', '#a78bfa', '#22c55e', '#ef4444'],
            }]
        },
        options: {
            responsive: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endsection
