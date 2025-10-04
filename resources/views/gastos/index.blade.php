@extends('layouts.app')

@section('title', 'Lista de Gastos')

@section('content')
    <h2 class="mb-4">Lista de Gastos</h2>
    <a href="{{ route('gastos.create') }}" class="btn btn-success mb-3">Registrar nuevo gasto</a>

    <ul class="list-group">
        @foreach ($gastos as $gasto)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    {{ $gasto->fecha }} - {{ $gasto->descripcion }}: 
                    <strong>${{ number_format($gasto->monto, 2) }}</strong>
                </span>
                <form method="POST" action="{{ route('gastos.destroy', $gasto->id) }}" 
                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar el gasto del {{ $gasto->fecha }} por ${{ number_format($gasto->monto, 2) }}?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
