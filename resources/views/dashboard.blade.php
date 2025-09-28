@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="mb-4 text-center">Resumen Financiero 🍕</h1>

    {{-- Filtros por fecha --}}
    <form method="GET" action="/dashboard" class="row g-3 justify-content-center mb-4">
        <div class="col-auto">
            <label for="desde" class="form-label">Desde:</label>
            <input type="date" name="desde" id="desde" class="form-control" value="{{ request('desde') }}">
        </div>
        <div class="col-auto">
            <label for="hasta" class="form-label">Hasta:</label>
            <input type="date" name="hasta" id="hasta" class="form-control" value="{{ request('hasta') }}">
        </div>
        <div class="col-auto align-self-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>

    {{-- Tarjetas resumen --}}
    <div class="row text-center">
        <div class="col-md-4 mb-3">
            <div class="card border-success">
                <div class="card-body">
                    <h5 class="card-title text-success">Ingresos Totales</h5>
                    <p class="card-text fs-4">${{ number_format($totalIngresos, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-danger">
                <div class="card-body">
                    <h5 class="card-title text-danger">Gastos Totales</h5>
                    <p class="card-text fs-4">${{ number_format($totalGastos, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title text-primary">Balance</h5>
                    <p class="card-text fs-4">
                        @if($balance >= 0)
                            <span class="text-success">+${{ number_format($balance, 2) }}</span>
                        @else
                            <span class="text-danger">-${{ number_format(abs($balance), 2) }}</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Gráfico comparativo --}}
    <div class="mt-5">
        <h4 class="text-center">Comparativa de Ingresos vs Gastos</h4>
        <canvas id="graficoFinanciero" height="100"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('graficoFinanciero').getContext('2d');
        const grafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Ingresos', 'Gastos'],
                datasets: [{
                    label: 'Monto en USD',
                    data: [{{ $totalIngresos }}, {{ $totalGastos }}],
                    backgroundColor: ['#198754', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endsection
