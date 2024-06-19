@extends('layout.plantilla')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio3.css">
@endsection

@section('titulo', 'Ejercicio 3')

@section('contenido')
    <h1>Problema de Estacionamiento</h1>
    <img class="imgEst" src="../../Image/estacionamiento.jpg" alt="foto estacionamiento">
    <p class="enunciado" style="text-align: justify;">
        Una tienda pequeña tiene un lote de estacionamiento con 6 lugares disponibles. Los clientes llegan en forma aleatoria de acuerdo a un proceso Poisson a una razón media de 10 clientes por hora, y se van inmediatamente si no existen lugares disponibles en el estacionamiento. El tiempo que un auto permanece en el estacionamiento sigue una distribución uniforme entre 10 y 30 minutos.
    </p>
    <p class="preguntas">
        a) ¿Qué porcentaje de los clientes es perdido por no tener más lugares disponibles?<br>
        b) ¿Cuál es la probabilidad de encontrar un lugar disponible en el estacionamiento?<br>
        c) ¿Cuál es el porcentaje promedio de espacios disponibles? 
    </p>

    <div class="resultado" style="display: flex; flex-direction: column;">
        <h1>Parking Lot Statistics</h1>
        <p>Percentage of Lost Customers: {{ $percentageLostCustomers }}%</p>
        <p>Probability of Finding an Available Space: {{ $probabilityAvailableSpace }}</p>
        <p>Average Available Spaces: {{ $averageAvailableSpaces }}</p>
    </div>
@endsection