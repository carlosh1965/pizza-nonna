@extends('layouts.app')

@section('title', 'Nuevo Ingreso')

@section('content')
    <h2 class="mb-4">Registrar Ingreso</h2>
    <form method="POST" action="{{ route('ingresos.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Descripción:</label>
            <input type="text" name="descripcion" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Monto:</label>
            <input type="number" name="monto" step="0.01" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha:</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('ingresos.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
@endsection
