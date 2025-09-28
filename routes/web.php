<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Ingreso;
use App\Models\Gasto;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\GastoController;

// Rutas RESTful para ingresos y gastos
Route::resource('ingresos', IngresoController::class);
Route::resource('gastos', GastoController::class);

// Ruta raíz redirige al dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});

// Ruta del dashboard con filtros opcionales
Route::get('/dashboard', function (Request $request) {
    $desde = $request->input('desde');
    $hasta = $request->input('hasta');

    $queryIngresos = Ingreso::query();
    $queryGastos = Gasto::query();

    if ($desde) {
        $queryIngresos->where('fecha', '>=', $desde);
        $queryGastos->where('fecha', '>=', $desde);
    }

    if ($hasta) {
        $queryIngresos->where('fecha', '<=', $hasta);
        $queryGastos->where('fecha', '<=', $hasta);
    }

    $totalIngresos = $queryIngresos->sum('monto');
    $totalGastos = $queryGastos->sum('monto');
    $balance = $totalIngresos - $totalGastos;

    return view('dashboard', compact('totalIngresos', 'totalGastos', 'balance', 'desde', 'hasta'));
})->name('dashboard');
