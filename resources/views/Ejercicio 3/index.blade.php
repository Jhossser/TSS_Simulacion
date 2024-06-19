@extends('layout.plantilla')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio3.css">
@endsection

@section('titulo', 'Ejercicio 3')

@section('contenido')
    <h1>Problema de Estacionamiento</h1>
    <img class="imgEst" src="../../Image/estacionamiento.jpg" alt="foto estacionamiento">
    <p class="margenAbajo" style="text-align: justify;">
        Una tienda pequeña tiene un lote de estacionamiento con 6 lugares disponibles. Los clientes llegan en forma aleatoria de acuerdo a un proceso Poisson a una razón 
        media de 10 clientes por hora, y se van inmediatamente si no existen lugares disponibles en el estacionamiento. El tiempo que un auto permanece en el estacionamiento 
        sigue una distribución uniforme entre 10 y 30 minutos.
    </p>
    <p class="margenAbajo">
        a) ¿Qué porcentaje de los clientes es perdido por no tener más lugares disponibles?<br>
        b) ¿Cuál es la probabilidad de encontrar un lugar disponible en el estacionamiento?<br>
        c) ¿Cuál es el porcentaje promedio de espacios disponibles? 
    </p>
    <br>
    <div class="margenAbajo">
        <h1>Proceso de Llegada de Clientes</h1>
        <p style="text-align: justify;">
            Los clientes llegan según un proceso de Poisson con una tasa media de 10 clientes por hora. La distribución de Poisson describe el número de eventos que ocurren
             en un intervalo de tiempo dado, dado un promedio constante de ocurrencias y eventos independientes.
        </p>
    </div>

    <h2>Detalles de la simulacion</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Tiempo(horas)</th>
                    <th>Evento</th>
                    <th>Espacios Libres</th>
                    <th>Espacios Ocupados</th>
                    <th>Cliente Perdido</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($iteraciones as $iteracion)
                    <tr>
                        <td>{{ $iteracion['time'] }}</td>
                        <td>{{ $iteracion['event'] }}</td>
                        <td>{{ $iteracion['available_spaces'] }}</td>
                        <td>{{ $iteracion['occupied_spaces'] }}</td>
                        <td>{{ $iteracion['lost_customers'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <h1>Cantidad de Eventos</h1>
    <p>{{ count($iteraciones) }}</p>
    <br>
    <div class="ecuacion">
        <h1>Estadisticas</h1>
        <p>Porcentaje de Clientes perdidos: {{ $porcentajePerdidos }}%</p>
        <p>Probabilidad de encontrar espacio: {{$probabilidadEspacioLibre}}</p>
        <p>Promedio de espacios libres: {{ $promedioEspaciosLibres }}</p>
    </div>
    <br>
    <h2>Funcion de distribucion exponencial</h2>
    <p>$$F(x) = -\frac{\log(1 - \lambda)}{k} $$</p>
@endsection

@section('script')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
@endsection