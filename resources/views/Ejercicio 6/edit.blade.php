@extends('layout.plantilla')

@section('titulo', 'Ejercicio 6 - Personalizar')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio6.css">
@endsection

@section('contenido')
    <h1>Personalizar Problema de Reabastecimiento</h1>
    <form action="{{ route('ej6.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="lambda">Tasa de Llegada (lambda):</label>
            <input type="number" class="form-control" id="lambda" name="lambda" value="{{ old('lambda', $lambda) }}" step="0.01" required>
            @error('lambda')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="numEquipos">Número de Equipos:</label>
            <input type="number" class="form-control" id="numEquipos" name="numEquipos" value="{{ old('numEquipos', 10) }}" min="1" required>
            @error('numEquipos')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        @foreach ($minTiemposServicio as $index => $minTiempo)
            <div class="form-group">
                <label for="minTiempoServicio{{ $index + 1 }}">Tiempo Mínimo de Servicio para Equipo {{ $index + 1 }} (minutos):</label>
                <input type="number" class="form-control" id="minTiempoServicio{{ $index + 1 }}" name="minTiempoServicio[]" value="{{ old('minTiempoServicio.'.$index, $minTiempo) }}" min="1" required>
                @error('minTiempoServicio.'.$index)
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        @endforeach

        @foreach ($maxTiemposServicio as $index => $maxTiempo)
            <div class="form-group">
                <label for="maxTiempoServicio{{ $index + 1 }}">Tiempo Máximo de Servicio para Equipo {{ $index + 1 }} (minutos):</label>
                <input type="number" class="form-control" id="maxTiempoServicio{{ $index + 1 }}" name="maxTiempoServicio[]" value="{{ old('maxTiempoServicio.'.$index, $maxTiempo) }}" min="1" required>
                @error('maxTiempoServicio.'.$index)
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection

@section('script')
    <script src="../../js/ejercicio6.js"></script>
@endsection
