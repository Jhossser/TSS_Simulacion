@extends('layout.plantilla')

@section('titulo', 'Ej3 Personalizar')
    
@section('links')
    <link rel="stylesheet" href="../../css/ejercicio3.css">
@endsection

@section('contenido')
    <h1>Problema de Estacionamiento</h1>
    <img class="imgEst" src="../../Image/cajeros.jpg" alt="foto estacionamiento">
    <p class="margenAbajo" style="text-align: justify;">
        Un banco emplea 3 cajeros para servir a sus clientes. Los clientes arriban de acuerdo 
        a un proceso Poisson a una razón media de 40 por hora. Si un cliente encuentra todos 
        los cajeros ocupados. entonces se incorpora a la cola que alimenta a todos los cajeros. 
        El tiempo que dura la transacción entre un cajero y un cliente sigue una distribución 
        uniforme entre 0 y 1 minuto. Para esta información, ¿Cuál es el tiempo promedio en el sistema?, 
        ¿Cuál es la cantidad promedio de clientes en el sistema? 
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
            <h2>Tasa de llegada</h2>
            <p>La tasa de llegada (λ) se refiere a la frecuencia con la que los clientes llegan al estacionamiento. En el contexto de nuestro modelo, esta tasa se mide en clientes por hora.</p>
            <h2>Tasa de servicio</h2>
            <p>La tasa de servicio (μ) representa la rapidez con la que los espacios de estacionamiento se liberan, es decir, el tiempo que cada auto permanece estacionado. Se mide en términos de "servicios" por hora.</p>
            <h2>Capacidad del estacionamiento</h2>
            <p>La capacidad del estacionamiento es el número total de espacios disponibles en el estacionamiento.</p>
            <h2>Tiempo de simulacion</h2>
            <p>El tiempo de simulación es la duración total durante la cual se lleva a cabo la simulación. Este tiempo se mide en minutos u horas, según el contexto.</p>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <button type="button" class="btn btn-secondary" onclick="window.location='{{route('ej3.index')}}'">Cancelar</button>
    </div>
@endsection
@section('script')
<script src="../../js/ej2.js"></script>
@endsection