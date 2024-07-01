@extends('layout.plantilla')

@section('links')
<link rel="stylesheet" href="../../css/ejercicio1.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('titulo', 'Ejercicio 1')

@section('contenido')
<h1>Colas de servicio</h1>
<div class="contenedor">
    <img class="imgEst" src="../../Image/Colas_de_servicio.jpg" alt="Colas de servicio">
</div>
<p class="parrafo" style="text-align: justify;">
    Se tiene un sistema de colas formado por dos estaciones en serie. Los clientes atendidos en la primera estación pasan en seguida a formar cola en la segunda. En la primera estación de servicio,
    la razón de llegadas sigue una distribución Poisson con media de 20 clientes por hora, y el tiempo de servicio sigue una distribución exponencial con media de 2 minutos por persona. En la segunda
    estación, el tiempo de servicio está uniformemente distribuido entre 1 y 2 minutos. Para esta información:
</p>
<ul class="lista">
    <li>a) ¿Cuál es el tiempo promedio en el sistema?</li>
    <li>b) ¿Cuál de las dos colas que se forman es mayor?</li>
</ul>

<!-- Aquí mostramos los resultados de la simulación -->
<div class="table-responsive">
    <h2>Resultados de la Simulación</h2>
    <p>Tiempo promedio en el sistema: {{ $averageTimeInSystem }}</p>
    <p>Tiempo promedio en la estación 1: {{ $averageServiceTime1 }}</p>
    <p>Tiempo promedio en la estación 2: {{ $averageServiceTime2 }}</p>
    
    <h3>Tiempos por Cliente</h3>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Cliente</th>
                <th>Tiempo de Llegada</th>
                <th>Tiempo de Servicio en Estación 1</th>
                <th>Tiempo de Servicio en Estación 2</th>
                <th>Tiempo Total en el Sistema</th>
            </tr>
        </thead>
        <tbody>
            @foreach($arrivalTimes as $index => $arrivalTime)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $arrivalTime }}</td>
                    <td>{{ $serviceTimes1[$index] ?? '-' }}</td>
                    <td>{{ $serviceTimes2[$index] ?? '-' }}</td>
                    <td>{{ $systemTimes[$index] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Gráfico de Eficiencia -->
<div class="grafico">
    <h3>Eficiencia de Atención</h3>
</div>
<canvas id="eficienciaChart" width="150" height="200"></canvas>
<br>
    <div class="botones">
        <a href="{{route('ej1.edit')}}" class="btn btn-primary">Personalizar problema</a>
        @if (isset($datos))
            <button class="btn btn-secondary" onclick="rehacer()">Simular nuevamente</button>
        @else
            <button class="btn btn-secondary" onclick="rehacer()">Simular nuevamente</button>
        @endif
    </div>
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

    <h2>Distribución Exponencial</h2>
    <div style="display: flex; justify-content: space-around;">
        <div style="width: 30%;">
            <p>Función de Densidad de Probabilidad (pdf):</p>
            $$ 
            f(x) = 
            \begin{cases} 
            \lambda e^{-\lambda x} & \text{si } x \ge 0 \\
            0 & \text{en otro caso}
            \end{cases} 
            $$
        </div>
        <div style="width: 30%;">
            <p>Función de Distribución Acumulada (cdf):</p>
            $$ 
            F(x) = 
            \begin{cases} 
            1 - e^{-\lambda x} & \text{si } x \ge 0 \\
            0 & \text{en otro caso}
            \end{cases} 
            $$
        </div>
        <div style="width: 30%;">
            <p>Transformada Inversa:</p>
            $$ X = -\frac{1}{\lambda} \ln(1 - U) $$
        </div>
    </div>
@endsection

@section('script')
<script src="../../js/ej1.js"></script>
<script>
    var ctx = document.getElementById('eficienciaChart').getContext('2d');
    var eficienciaChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Estación 1', 'Estación 2'],
            datasets: [{
                label: 'Tiempo Promedio de Servicio (min)',
                data: [{{ $averageServiceTime1InMinutes }}, {{ $averageServiceTime2InMinutes }}],
                backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection


