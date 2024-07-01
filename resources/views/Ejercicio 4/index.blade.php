@extends('layout.plantilla')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio4.css">
@endsection

@section('titulo', 'Transporte Productos')

@section('contenido')
    <h1>Problema de Transporte de Productos</h1>
    <img class="imgEst" src="../../Image/transporteProductos.jpg" alt="foto estacionamiento">
    
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
        <table class="table table-bordered table-striped" id="tablaPeque">
            <thead class="thead-dark">
                <tr>
                    <th>Produccion diaria (ton)</th>
                    <th>Probabilidad</th>
                </tr>
            </thead>
            <tbody>
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
        <table class="table table-bordered table-striped" id="tablaPeque">
            <thead class="thead-dark">
                <tr>
                    <th>Toneladas diaraias por camion</th>
                    <th>Probabilidad</th>
                </tr>
            </thead>
            <tbody>
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
    <span class="alert alert-primary">
        <p>Velocidad promedio de camion = {{$datos['vc']}}</p>
        <p>Distancia entre fabrica y almacen = {{$datos['d']}}</p>
        <p>Tiempo de trabajo = {{$datos['tt']}}</p>
        <p>Tiempo en cargar = {{$datos['tc']}}</p>
        <p>Tiempo en descargar = {{$datos['td']}}</p>
        <p>Costo de transportar producto exedente = {{$datos['ce']}}</p>
        <p>Costo anual de camion = {{$datos['cac']}}</p>
    </span>

    <p class="margenAbajo">
        a) Si se trabajan 250 días en el
        año, ¿Cuál es el numero óptimo de camiones que esta compañía debe de adquirir?
    </p>
    <br>
    <div class="margenAbajo">
        <h1>Proceso de Transporte</h1>
        <p style="text-align: justify;">
            El ejercio no nos da valores para el tiempo que se tarda en cargar o descargar los productos del camion, sin embargo al ser estos necesarios se colocan valores de estos para completar una buena simulacion.
        </p>
    </div>
    <br>
    <h1>Cantidad de Dias</h1>
    <p id="iteraciones">{{ $diasSimulados }}</p>
    <br>
    <div class="ecuacion">
        <h1>Respuesta</h1>
        <p>El numero de camiones que se deberia adquirir es de:</p>
        <p class="text-danger" id="camionesConCostoMinimo">{{$camionesConCostoMinimo}} camiones</p>
        <p>Su coste en {{$diasSimulados}} dias fue de:</p>
        <p class="text-danger" id="costoMinimo2">Bs. {{$costoMinimo2}}</p>
    </div>
    
    {{-- Grafico --}}
    <br>
    <h1>Costo vs. Numero de camiones</h1>
    <canvas id="graficoNumCamiones" width="150" height="200"></canvas>
    <br>   
    <h2>Tabla de Paso de los dias</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Dia</th>
                    <th>Produccion</th>
                    <th>Numero de Camiones</th>
                    <th>Cantidad Transportada (ton)</th>
                </tr>
            </thead>
            <tbody id="tablaIteracion">
                @foreach ($transporteDia as $transporteDelDia)
                    <tr>
                        <td>{{ $transporteDelDia['dia'] }}</td>
                        <td>{{ $prodDia[$transporteDelDia['dia']-1] }}</td>
                        <td>{{ $transporteDelDia['camiones'] }}</td>
                        <td>{{ $transporteDelDia['transportado'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    
    <div class="botones">
        <a href="{{route('ej4.edit')}}" class="btn btn-primary">Personalizar problema</a>
        <button class="btn btn-secondary" onclick="rehacer()">Simular nuevamente</button>
    </div>
    <br>

    <p class="parrafo" style="text-align: justify;">
        para esta simulacion se le aplica el siguiente trato a la funcion de origen de la distribucion y que esta pueda darse atraves de una variable de 0 a 1
        por el metodo de la transformada inversa que genera el valor acumulado de probabilidad q tiene cada funcion la funcion acumulada se optiene a traves de una integral
        que transforma a la funcion de densidad(casos probables k)a su forma acumulada lo cual nos da eventos simulados atraves de la probabilidad acumulada de dichos eventos.
    </p>
    <h2>Distribución Uniforme</h2>
    <div style="display: flex; justify-content: space-around;">
        <div style="width: 30%;">
            <p>Función de Densidad de Probabilidad (pdf):</p>
            $$ 
            f(x) = 
            \begin{cases} 
            \frac{1}{b-a} & \text{si } a \le x \le b \\
            0 & \text{en otro caso}
            \end{cases} 
            $$
        </div>
        <div style="width: 30%;">
            <p>Función de Distribución Acumulada (cdf):</p>
            $$ 
            F(x) = 
            \begin{cases} 
            0 & \text{si } x < a \\
            \frac{x-a}{b-a} & \text{si } a \le x \le b \\
            1 & \text{si } x > b
            \end{cases} 
            $$
        </div>
        <div style="width: 30%;">
            <p>Transformada Inversa:</p>
            $$ X = a + (b - a)U $$
        </div>
    </div>

    {{-- Formulario para simular nuevamente --}}
    <form class="formEj3" id="formEj3" action="" method="get" style="display: none;">
        @csrf
        <div class="form-group">
            <label for="vc">Velocidad de Camion</label>
            <input class="form-control" type="number" name="vc" id="vc" placeholder="Ingrese tasa de llegada de vehiculos" value="{{$datos['vc']}}">
        </div>
        <div class="form-group">
            <label for="d">Distancia entre fabrica y almacen</label>
            <input class="form-control" type="number" name="d" id="d" placeholder="Ingrese la tasa de servicio en horas" value="{{$datos['d']}}">
        </div>
        <div class="form-group">
            <label for="tc">Tiempo en carga</label>
            <input class="form-control" type="number" name="tc" id="tc" placeholder="Ingrese la tc del estacionamiento" value="{{$datos['tc']}}">
        </div>
        <div class="form-group">
            <label for="td">Tiempo en descargar</label>
            <input class="form-control" type="number" name="td" id="td" placeholder="Ingrese el tiempo en horas" value="{{$datos['td']}}">
        </div>
        <div class="form-group">
            <label for="tt">Jornada laboral</label>
            <input class="form-control" type="number" name="tt" id="tt" placeholder="Ingrese el tiempo en horas" value="{{$datos['tt']}}">
        </div>
        <div class="form-group">
            <label for="ce">Costo de transportar producto exedente</label>
            <input class="form-control" type="number" name="ce" id="ce" placeholder="Ingrese el tiempo en horas" value="{{$datos['ce']}}">
        </div>
        <div class="form-group">
            <label for="cac">Costo anual de camion</label>
            <input class="form-control" type="number" name="cac" id="cac" placeholder="Ingrese el tiempo en horas" value="{{$datos['cac']}}">
        </div>
    </form>

@endsection

@section('script')  
    <script>
        const costoTotalPorCamion = @json($costoTotalPorCamion);
    </script>
    <script src="../../js/ej4.js"></script>
@endsection