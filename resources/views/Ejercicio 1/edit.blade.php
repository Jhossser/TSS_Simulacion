@extends('layout.plantilla')

@section('titulo', 'Ej3 Personalizar')
    
@section('links')
    <link rel="stylesheet" href="../../css/ejercicio3.css">
@endsection

@section('contenido')
    <h1>Problema de Estacion de servicio</h1>
    <img class="imgEst" src="../../Image/fila.jpg" alt="">
    <p class="margenAbajo" style="text-align: justify;">
        Se tiene un sistema de colas formado por dos estaciones en serie. Los clientes atendidos en la
        primera estación pasan en seguida a formar cola en la segunda. En la primera estación de servicio,
        de servicio sigue una distribución exponencial con media de 2 minutos por persona. En la segunda
        la razón de llegadas sigue una distribuci6n Poisson con media de 20 clientes por hora, y el tiempo
        información, ¿Cuál es el tiempo promedio en el sistema?, ¿Cuál de las dos colas que se forman es
        estación, el tiempo de servicio esta uniformemente distribuido entre 1 y 2 minutos. Para esta
        mayor?
    </p>
    <br>
    <h2 class="margenAbajo">Personalice este problema a sus necesidades</h2>
    <div class="formEj3" >
        
        <div class="form-group">
            <label for="tasaLlegada">Numero de Cajeros</label>
            <input class="form-control" type="number" name="tasaLlegada" id="tasaLlegada" placeholder="Ingrese el numero de cajeros" >
            
        </div>
        <div class="form-group">
            <label for="tasaServicio">Clientes por hora</label>
            <input class="form-control" type="number" name="tasaServicio" id="tasaServicio" placeholder="Ingrese el numero de clientes por hora" >
            
        </div>
        <div class="form-group">
            <label for="capacidad">Tiempo maximo del cliente en el cajero</label>
            <input class="form-control" type="number" name="capacidad" id="capacidad" placeholder="Ingrese el tiempo del cliente en el cajero" >
        
        </div>
        
        <div class="margenAbajo" id="masInfo">
            <p onclick="masInfo()">Mas infomacion <i class="fas fa-caret-down" id="flechaInfo"></i></p>
        </div>
        <div class="margenAbajo" id="informacion">
            <h2>Clientes por hora </h2>
            <p> :3 (λ)</p>
            <h2>Tiempo de servicio por persona</h2>
            <p> :3 </p>
            <h2>Tiempo maximo del cliente en la segunda estacion</h2>
            <p> :3</p>
            <h2>Tiempo minimo del cliente en la segunda estacion</h2>
            <p> :3</p>
            </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <button type="button" class="btn btn-secondary" onclick="window.location='{{route('ej1.index')}}'">Cancelar</button>
    </div>
@endsection
@section('script')
<script src="../../js/ej2.js"></script>
@endsection