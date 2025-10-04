@extends('layouts.app')

@section('title', 'Lista de Ingresos')

@section('content')
    <h2 class="mb-4">Lista de Ingresos</h2>
    <a href="{{ route('ingresos.create') }}" class="btn btn-success mb-3">Registrar nuevo ingreso</a>

    <ul class="list-group">
        @foreach ($ingresos as $ingreso)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $ingreso->fecha }} - {{ $ingreso->descripcion }}: ${{ number_format($ingreso->monto, 2) }}</span>
                <form method="POST" action="{{ route('ingresos.destroy', $ingreso->id) }}" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este ingreso?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
