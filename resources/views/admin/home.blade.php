@extends('admin.layouts.app')

@section('content')
    <div class="p-6 space-y-8">
        {{-- ORDERS CHART --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-bold mb-4">Orders (Buy / Sell)</h2>

            <canvas id="ordersChart"></canvas>
        </div>

        {{-- WALLET CHART --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-bold mb-4">Wallet Balances</h2>

            <canvas id="walletChart"></canvas>
        </div>

    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const orderStats = @json($orderStats ?? []);
            const walletStats = @json($walletStats ?? []);

            const ordersEl = document.getElementById('ordersChart');
            const walletEl = document.getElementById('walletChart');

            if (!ordersEl || !walletEl) return;

            new Chart(ordersEl, {
                type: 'line',
                data: {
                    labels: orderStats.labels ?? [],
                    datasets: [
                        {
                            label: 'BUY',
                            data: orderStats.buy ?? [],
                            borderColor: '#22c55e',
                            backgroundColor: 'rgba(34, 197, 94, 0.1)',
                            fill: true,
                            tension: 0.5,
                            pointRadius: 4,
                        },
                        {
                            label: 'SELL',
                            data: orderStats.sell ?? [],
                            borderColor: '#ef4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            fill: true,
                            tension: 0.5,
                            pointRadius: 4,
                        }
                    ]
                },
                options: {
                    animation: {
                        duration: 1200,
                        easing: 'easeOutQuart'
                    }
                }
            });

            new Chart(walletEl, {
                type: 'bar',
                data: {
                    labels: walletStats.labels ?? [],
                    datasets: [
                        {
                            label: 'Balance',
                            data: walletStats.balances ?? [],
                            backgroundColor: '#3b82f6',
                            borderRadius: 6
                        },
                        {
                            label: 'Locked',
                            data: walletStats.locked ?? [],
                            backgroundColor: '#f59e0b',
                            borderRadius: 6
                        }
                    ]
                }
            });

        });
    </script>
@endsection
