@extends('layout.plantilla')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio3.css">
@endsection

@section('titulo', 'Ejercicio 3')

@section('contenido')
<h1>Problema de Estacionamiento</h1>
<img class="imgEst" src="../../Image/estacionamiento.jpg" alt="foto estacionamiento">
<p class="margenAbajo" style="text-align: justify;">
    Un banco emplea 3 cajeros para servir a sus clientes. Los clientes arriban de acuerdo a un proceso
Poisson a una razón media de 40 por hora. Si un cliente encuentra todos los cajeros ocupados.
entonces se incorpora a la cola que alimenta a todos los cajeros. El tiempo que dura la transacción
entre un cajero y un cliente sigue una distribución uniforme entre 0 y 1 minuto. Para esta
información, ¿Cuál es el tiempo promedio en el sistema?, ¿Cuál es la cantidad promedio de clientes
en el sistema?
</p>
<br>
<div class="botones">
    <button class="btn btn-primary" onclick="resolverProblema()">Resolver el Problema</button>
    <button class="btn btn-secondary" onclick="resolverProblema()">Resolver el Problema</button>
</div>
    
@endsection

