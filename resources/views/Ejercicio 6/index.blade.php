@extends('layout.plantilla')

@section('titulo', 'Reabastecimiento')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio6.css">
@endsection

@section('contenido')
    <h1>Problema de Reabastecimiento</h1>
    <img class="imgEst" src="../../Image/reabastecimiento.jpg" alt="Reabastecimiento">
    <p class="parrafo" style="text-align: justify;">
    Una cadena de supermercados es abastecida por un almacén central. La mercancía que llega a
este almacén es descargada en turnos nocturnos. Los camiones que se descargan en este almacén
llegan en forma aleatoria de acuerdo a un proceso Poisson a una razón media de 2 camiones por
hora. El tiempo que un equipo de tres trabajadores se tarda en descargar un camión, sigue una
distribución uniforme entre 20 y 30 minutos. Si el número de trabajadores en el equipo se
incrementa, entonces, la razón de servicio se incrementa. Por ejemplo, si el equipo está formado
por 4 trabajadores, el tiempo de servicio esta uniformemente distribuido entre 15 y 25 minutos; si
el equipo está formado por 5 trabajadores, el tiempo de servicio esta uniformemente distribuido
entre 10 y 20 minutos y si el equipo está formado por 6 trabajadores, el tiempo de servicio esta
uniformemente distribuido entre 5 y 15 minutos. Cada trabajador recibe $25 por hora durante el
turno nocturno de ocho horas. El costo de tener un camión esperando se estima en $50 por hora.
    </p>
    <ul class="lista">
    <li>¿El administrador del almacén desea saber cuál es el tamaño optimo del equipo?/li>
</ul>
    <br>
    <!-- Botones -->
    <div class="botones">
        <a href="{{ route('ej6.edit') }}" class="btn btn-primary">Personalizar problema</a>
        <button class="btn btn-secondary" onclick="rehacer()">Simular nuevamente</button>
    </div>

    <!-- Recuadro de costos -->
    <h3>Costos de Equipos y Espera de Camiones</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Equipo</th>
                    <th>Costo de Equipo (Bs/hora)</th>
                    <th>Costo de Espera (Bs/hora)</th>
                    <th>Costo Total (Bs/hora)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($costosEquipos as $costo)
                    <tr>
                        <td>{{ $costo['equipo'] }}</td>
                        <td>{{ $costo['costoEquipo'] }}</td>
                        <td>{{ $costo['costoEsperando'] }}</td>
                        <td>{{ $costo['costoTotal'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tabla de tiempos de llegada de camiones -->
    <h3>Tiempos de Llegada de Camiones</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Número de Camión</th>
                    <th>Tiempo de Llegada (minutos)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arrivalTimes as $index => $arrivalTime)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $arrivalTime }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tabla de tiempos de servicio de los equipos -->
    <h3>Tiempos de Servicio de Equipos</h3>
    @foreach ($teamsResults as $team => $result)
        <div class="table-responsive">
            <h4>Equipo {{ $team+1 }}</h4>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Número de Camión</th>
                        <th>Tiempo de Servicio (minutos)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result['serviceTimes'] as $index => $serviceTime)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $serviceTime }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

    <!-- Gráfico comparativo -->
    <h3>Comparación de Tiempos de Servicio</h3>
    <canvas id="graficoComparacion" width="400" height="200"></canvas>
    <br>
    <p class="parrafo" style="text-align: justify;">
        para esta simulacion se le aplica el siguiente trato a la funcion de origen de la distribucion y que esta pueda darse atraves de una variable de 0 a 1
        por el metodo de la transformada inversa que genera el valor acumulado de probabilidad q tiene cada funcion la funcion acumulada se optiene a traves de una integral
        que transforma a la funcion de densidad(casos probables k)a su forma acumulada lo cual nos da eventos simulados atraves de la probabilidad acumulada de dichos eventos.
    </p>
    <h2>Distribución de Poisson</h2>
    <div style="display: flex; justify-content: space-around;">
        <div style="width: 30%;">
            <p>Función de Densidad de Probabilidad (pdf):</p>
            $$ P(X = k) = \frac{\lambda^k e^{-\lambda}}{k!} $$
        </div>
        <div style="width: 30%;">
            <p>Función de Distribución Acumulada (cdf):</p>
            $$ P(X \le k) = e^{-\lambda} \sum_{i=0}^k \frac{\lambda^i}{i!} $$
            <p>Para \( t \) y \( t + \Delta t \):</p>
            $$ P(T \le t + \Delta t) = 1 - e^{-\lambda (t + \Delta t)} $$
        </div>
        <div style="width: 30%;">
            <p>Transformada Inversa:</p>
            $$ T = -\frac{1}{\lambda} \ln(1 - U) $$
        </div>
    </div>

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

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('graficoComparacion').getContext('2d');
        var graficoComparacion = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: @json($datasets)
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        function rehacer() {
            window.location.reload();
        }

        function crecer() {
            //$('#graficoComparacion').addClass('fullscreen');
        }
    </script>
@endsection
