<!-- resources/views/Ejercicio 1/edit.blade.php -->

@extends('layout.plantilla')

@section('titulo', 'Editar Parámetros')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio4.css">
    <link rel="stylesheet" href="../../css/ejercicio3.css">
@endsection

@section('contenido')
<h1>Colas de servicio</h1>
<p class="margenAbajo" style="text-align: justify;">
<img class="imgEst" src="../../Image/Colas_de_servicio.jpg" alt="Colas de servicio">
    Se tiene un sistema de colas formado por dos estaciones en serie. Los clientes atendidos en la primera estación pasan en seguida a formar cola en la segunda. En la primera estación de servicio,
    la razón de llegadas sigue una distribución Poisson con media de 20 clientes por hora, y el tiempo de servicio sigue una distribución exponencial con media de 2 minutos por persona. En la segunda
    estación, el tiempo de servicio está uniformemente distribuido entre 1 y 2 minutos. Para esta información:
    </p>
    <br>
<form action="{{ route('ej1.index') }}" method="GET" style="width: 100%;">
    @csrf <!-- Esto se puede eliminar si se usa el método GET -->
    <div class="form-group">
        <label for="lambda">Lambda (clientes por hora):</label>
        <input type="number" class="form-control" id="lambda" name="lambda" value="{{ old('lambda', $hist->lambda ?? '') }}" required>
    </div>
    <div class="form-group">
        <label for="meanService1">Media de servicio en la estación 1 (minutos):</label>
        <input type="number" class="form-control" id="meanService1" name="meanService1" value="{{ old('meanService1', $hist->mediaEst1 ?? '') }}" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="minService2">Mínimo de servicio en la estación 2 (minutos):</label>
        <input type="number" class="form-control" id="minService2" name="minService2" value="{{ old('minService2', $hist->minEst2 ?? '') }}" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="maxService2">Máximo de servicio en la estación 2 (minutos):</label>
        <input type="number" class="form-control" id="maxService2" name="maxService2" value="{{ old('maxService2', $hist->maxEst2 ?? '') }}" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="numClientes">Número de clientes:</label>
        <input type="number" class="form-control" id="numClientes" name="numClientes" value="{{ old('numClientes', $hist->numClientes ?? '') }}" required>
    </div>
    <div class="margenAbajo" id="masInfo">
            <p onclick="masInfo()">Mas infomacion <i class="fas fa-caret-down" id="flechaInfo"></i></p>
        </div>
        <div class="margenAbajo" id="informacion">
            <h2>Tasa de llegada</h2>
            <p>La tasa de llegada (λ) se refiere a la frecuencia con la que los clientes llegan a la primera estacion de servicio. En el contexto de nuestro modelo, esta tasa se mide en clientes por hora.</p>
            <h2>Media de servicio en la estación 1</h2>
            <p>La media de servicio da el tiempo en el cual son atendidos los clientes en la primera estacion dada por una distribucion esponencial en funcion de esta. </p>
            <h2>Max,Min</h2>
            <p>Es el rango de tiempo de atencion en la segunda estacion y esta dad por una distribucion uniforme.</p>
            <h2>Cantidad de clientes</h2>
            <p>Esta simulacion va de acuerdo a n clientes para ver la eficiencia de las dos colas.</p>
        </div>   
    <button type="submit" class="btn btn-primary">Simular</button>
    <button type="button" class="btn btn-secondary" onclick="window.location='{{route('ej1.index')}}'">Cancelar</button>
</form>
@endsection

@section('script')
<script src="../../js/ej3.js"></script>
@endsection
