@extends('layout.plantilla')

@section('links')
    <link rel="stylesheet" href="../../css/inicio.css">
@endsection

@section('titulo', 'Mobile Simu')

@section('contenido')
    <h1>Bienvenid@ {{ Auth::user()->nombre }}</h1>
    <br>
    <p class="bienvenido">!Seis divertidos ejercicios de simulacion!</p>
    <div class="contBotones">
        <a href="{{ route('ej1.index')}}" class="opcion">Estacion de servicio</a>
        <a href="{{ route('ej2.index')}}" class="opcion">Cajeros</a>
        <a href="{{ route('ej3.index')}}" class="opcion">Estacionamiento</a>
        <a href="{{ route('ej4.index') }}" class="opcion">Transporte de Productos</a>
        <a href="{{ route('ej5.index') }}" class="opcion">Reparacion de maquinaria</a>
        <a href="{{ route('ej6.index') }}" class="opcion">Reabastecimiento</a>
    </div>
@endsection