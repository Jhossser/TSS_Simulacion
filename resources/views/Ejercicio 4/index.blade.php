@extends('layout.plantilla')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio4.css">
@endsection

@section('titulo', 'Transporte Productos')

@section('contenido')
    <h1>Problema de Transporte de Productos</h1>
    <img class="imgEst" src="../../Image/transporteProductos.jpg" alt="foto estacionamiento">
    
    @if (isset($datos))
        {{-- <p class="margenAbajo" style="text-align: justify;">
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
        </form> --}}
    @else
        <p class="margenAbajo" style="text-align: justify;">
            Debido a un aumento en las ventas, cierta compañía manufacturera necesita más espacio en su
            fábrica. La solución que se ha propuesto es la construcción de un nuevo depósito para almacenar
            los productos terminados. Este depósito estaría localizado a 30 kilómetros del lugar donde está
            ubicada la planta. Además, de acuerdo a este nuevo plan, se requiere que al final del día se envié al
            nuevo depósito, la producción terminada.
            <br><br>
            Por otra parte, se sabe de informaci6n pasada, que la producción diaria de esta compañía, sigue la
            siguiente distribuci6n de probabilidad:
        </p>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Produccion diaria (ton)</th>
                        <th>Probabilidad</th>
                    </tr>
                </thead>
                <tbody id="tablaIteracion">
                        <tr>
                            <td>50 - 55</td>
                            <td>0.10</td>
                        </tr>
                        <tr>
                            <td>55 - 60</td>
                            <td>0.15</td>
                        </tr>
                        <tr>
                            <td>60 - 65</td>
                            <td>0.30</td>
                        </tr>
                        <tr>
                            <td>60 - 70</td>
                            <td>0.35</td>
                        </tr>
                        <tr>
                            <td>75 - 80</td>
                            <td>0.08</td>
                        </tr>
                        <tr>
                            <td>80 - 85</td>
                            <td>0.02</td>
                        </tr>
                </tbody>
            </table>
        </div>
        <br>
        <p style="text-align: justify;">
            También, se sabe que el tipo de camiones que se deben utilizar para trasladar esta producción,
            tienen una capacidad media de carga de 5 toneladas. La cantidad de viajes que se pueden realizar
            cada día (jomada de 8 horas). depende del tiempo de carga y de descarga, como también del tiempo
            que se requiere para recorrer los treinta kilómetros entre la planta y el depósito.
            Consecuentemente. la cantidad de producto terminado que un camión puede trasladar de la planta
            al depósito, es una variable aleatoria cuya distribución de probabilidad es la siguiente:
        </p>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Toneladas diaraias por camion</th>
                        <th>Probabilidad</th>
                    </tr>
                </thead>
                <tbody id="tablaIteracion">
                        <tr>
                            <td>4.0 - 4.5</td>
                            <td>0.30</td>
                        </tr>
                        <tr>
                            <td>4.5 - 5.0</td>
                            <td>0.40</td>
                        </tr>
                        <tr>
                            <td>5.0 - 5.5</td>
                            <td>0.20</td>
                        </tr>
                        <tr>
                            <td>5.5 - 6.0</td>
                            <td>0.10</td>
                        </tr>
                </tbody>
            </table>
        </div>
        <br>
        <p style="text-align: justify;">
            Si la cantidad diaria producida es mayor que la cantidad que puede trasladar la flotilla de camiones,
            el excedente es enviado a través de otra compañía transportista a un costo de $100 por tonelada.
            Además, el costo promedio anual de un nuevo camión es de $100,000.
        </p>
        <span class="alert alert-primary"> Info de Ej4</span>
    @endif

    <p class="margenAbajo">
        a) Si se trabajan 250 días en el
        año, ¿Cuál es el numero óptimo de camiones que esta compañía debe de adquirir?
    </p>
    <br>
    {{-- <div class="margenAbajo">
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
                    <th>Tiempo(minutos)</th>
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
    </div> --}}
    
    {{-- Grafico --}}
    <br>
    <h1>Grafico distribucion poisson</h1>
    <canvas id="graficoPoisson" width="150" height="200"></canvas>
    <h1>Grafico distribucion exponencial</h1>
    <canvas id="graficoExponencial" width="150" height="200" style="margin-top: 20px;"></canvas>
    <h1>Grafico distribucion uniforme</h1>
    <canvas id="graficoUniforme" width="150" height="200" style="margin-top: 20px;"></canvas>

    <br>
    <div class="botones">
        <a href="{{route('ej3.edit')}}" class="btn btn-primary">Personalizar problema</a>
        @if (isset($datos))
            <button class="btn btn-secondary" onclick="rehacerDatos()">Simular nuevamente</button>
        @else
            <button class="btn btn-secondary" onclick="rehacer()">Simular nuevamente</button>
        @endif
    </div>
    <br>
    <h2>Funcion de distribucion exponencial</h2>
    <p>$$F(x) = -\frac{\log(1 - \lambda)}{k} $$</p>
@endsection

@section('script')  
    <script>
        
    </script>
    <script src="../../js/ej6.js"></script>
@endsection