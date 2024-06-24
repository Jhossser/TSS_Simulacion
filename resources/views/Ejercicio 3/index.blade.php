@extends('layout.plantilla')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio3.css">
@endsection

@section('titulo', 'Ejercicio 3')

@section('contenido')
    <h1>Problema de Estacionamiento</h1>
    <img class="imgEst" src="../../Image/estacionamiento.jpg" alt="foto estacionamiento">
    
    @if (isset($datos))
        <p class="margenAbajo" style="text-align: justify;">
            Una tienda pequeña tiene un lote de estacionamiento con {{$datos['c']}} lugares disponibles. Los clientes llegan en forma aleatoria de acuerdo a un proceso Poisson a una razón 
            media de {{$datos['tl']}} clientes por hora, y se van inmediatamente si no existen lugares disponibles en el estacionamiento. El tiempo que un auto permanece en el estacionamiento 
            sigue una distribución uniforme con una tasa de servicio de {{$datos['ts']}}.
        </p>
        <span class="alert alert-primary">
            <p>Tasa de llegada = {{$datos['tl']}} clientes/hora</p>
            <p>Tasa de servicio = {{$datos['ts']}} coches/hora</p>
            <p>Capacidad de estacionamiento = {{$datos['c']}} coches</p>
            <p>Tiempo transcurrido = {{$datos['tiempo']}} horas</p>
        </span>
        <form class="formEj3" id="formEj3" action="" method="get" style="display: none;">
            @csrf
            <div class="form-group">
                <label for="tasaLlegada">Tasa de llegada</label>
                <input class="form-control" type="number" name="tasaLlegada" id="tasaLlegada" placeholder="Ingrese tasa de llegada de vehiculos" value="{{$datos['tl']}}">
            </div>
            <div class="form-group">
                <label for="tasaServicio">Tasa de servicio</label>
                <input class="form-control" type="number" name="tasaServicio" id="tasaServicio" placeholder="Ingrese la tasa de servicio en horas" value="{{$datos['ts']}}">
            </div>
            <div class="form-group">
                <label for="capacidad">Capacidad del estacionamiento</label>
                <input class="form-control" type="number" name="capacidad" id="capacidad" placeholder="Ingrese la capacidad del estacionamiento" value="{{$datos['c']}}">
            </div>
            <div class="form-group">
                <label for="tiempo">Tiempo de simulacion</label>
                <input class="form-control" type="number" name="tiempo" id="tiempo" placeholder="Ingrese el tiempo en horas" value="{{$datos['tiempo']}}">
            </div>
        </form>
    @else
        <p class="margenAbajo" style="text-align: justify;">
            Una tienda pequeña tiene un lote de estacionamiento con 6 lugares disponibles. Los clientes llegan en forma aleatoria de acuerdo a un proceso Poisson a una razón 
            media de 10 clientes por hora, y se van inmediatamente si no existen lugares disponibles en el estacionamiento. El tiempo que un auto permanece en el estacionamiento 
            sigue una distribución uniforme entre 10 y 30 minutos.
        </p>
        <span class="alert alert-primary"> El timpo transcurrido es de 10 horas</span>
    @endif

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
            <tbody id="tablaIteracion">
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
    <p id="iteraciones">{{ count($iteraciones) }}</p>
    <br>
    <div class="ecuacion">
        <h1>Estadisticas</h1>
        <p id="porcentajePerdidos">Porcentaje de Clientes perdidos: {{ $porcentajePerdidos }}%</p>
        <p id="probabilidadEspacioLibre">Probabilidad de encontrar espacio: {{$probabilidadEspacioLibre}}</p>
        <p id="promedioEspaciosLibres">Promedio de espacios libres: {{ $promedioEspaciosLibres }}</p>
    </div>
    <div class="botones">
        <a href="{{route('ej3.edit')}}" class="btn btn-primary">Personalizar problema</a>
        @if (isset($datos))
            <button class="btn btn-secondary" onclick="rehacerDatos()">Simular nuevamente 2</button>
        @else
            <button class="btn btn-secondary" onclick="rehacer()">Simular nuevamente</button>
        @endif
    </div>
    <br>
    <h2>Funcion de distribucion exponencial</h2>
    <p>$$F(x) = -\frac{\log(1 - \lambda)}{k} $$</p>
@endsection

@section('script')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <script src="../../js/ej3.js"></script>
@endsection