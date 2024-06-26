@extends('layout.plantilla')

@section('links')
<link rel="stylesheet" href="../../css/ejercicio1.css">
@endsection

@section('titulo', 'Ejercicio 1')

@section('contenido')
    <h1>Colas de servicio<h1>
        <div class="contenedor">
    <img class="imagenEjer1" src="../../Image/Colas_de_servicio.jpg" alt="Colas de servicio">
        </div>    
    <p class="parrafo">
            Se tiene un sistema de colas formado por dos estaciones en serie. Los clientes atendidos en la primera estación pasan en seguida a formar cola en la segunda. En la primera estación de servicio,
            la razón de llegadas sigue una distribuci6n Poisson con media de 20 clientes por hora, y el tiempo de servicio sigue una distribución exponencial con media de 2 minutos por persona. En la segunda
            estación, el tiempo de servicio esta uniformemente distribuido entre 1 y 2 minutos. Para esta información, 
    </p>
    <ul class="lista">
        <li>a) ¿Cuál es el tiempo promedio en el sistema?</li>
        <li>b)¿Cuál de las dos colas que se forman es mayor?</li>
    </ul>
@endsection

@section('script')
@endsection