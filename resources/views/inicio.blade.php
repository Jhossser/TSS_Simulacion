@extends('layout.plantilla')

@section('links')
    <link rel="stylesheet" href="../../css/inicio.css">
@endsection

@section('titulo', 'Mobile Simu')

@section('contenido')
    <h1>Bienvenido</h1>
    <br>
    <p class="bienvenido">!Seis divertidos ejercicios de simulacion!</p>
    <div class="contBotones">
        <a href="{{route('ej1.index')}}" class="opcion">Estacion de Servicio</a>
        <a href="" class="opcion">Cajeros</a>
        <a href="{{route('ej3.index')}}" class="opcion">Estacionamiento</a>
        <a href="" class="opcion">Transporte de Productos</a>
        <a href="" class="opcion">Reparacion de maquinaria</a>
        <a href="" class="opcion">Reabastecimiento</a>
    </div>
@endsection