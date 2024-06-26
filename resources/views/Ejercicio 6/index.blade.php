@extends('layout.plantilla')

@section('titulo', 'Reabastecimiento')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio6.css">
@endsection

@section('contenido')
    <!-- Contenido de la vista -->
    <h1>Problema de Reabastecimiento</h1>
    <div class="contenedor">
        <img class="imgEst" src="../../Image/reabastecimiento.jpg"  alt="Colas de servicio">
    </div>
    <p class="parrafo" style="text-align: justify;">
        <!-- Texto o contenido adicional -->
    </p>
    <br>

    <!-- Mostrar resultados por cada equipo -->
    @foreach ($teamsResults as $team => $result)
        <div class="table-responsive">
            <h3>Resultados para Equipo {{ $team }}</h3>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Número de Camión</th>
                        <th>Tiempo de Llegada</th>
                        <th>Tiempo de Servicio</th>
                        <th>Tiempo en el Sistema</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result['arrivalTimes'] as $index => $arrivalTime)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $arrivalTime }}</td>
                            <td>{{ $result['serviceTimes'][$index] }}</td>
                            <td>{{ $result['systemTimes'][$index] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

    <!-- Gráficos -->
    <h1>Gráfico de Distribución de Poisson</h1>
    <canvas id="graficoPoisson" width="400" height="200"></canvas>
    <h1>Gráfico de Distribución Uniforme</h1>
    <canvas id="graficoUniforme" width="400" height="200"></canvas>

    <!-- Botones y scripts -->
    <div class="botones">
        <a href="{{ route('ej6.edit') }}" class="btn btn-primary">Personalizar problema</a>
        @if (isset($datosGraficoPoisson))
            <button class="btn btn-secondary" onclick="rehacerDatos()">Simular nuevamente</button>
        @else
            <button class="btn btn-secondary" onclick="rehacer()">Simular nuevamente</button>
        @endif
    </div>
@endsection

@section('script')
<script>
    // Script para inicializar los gráficos con los datos pasados desde el controlador
    var ctxPoisson = document.getElementById('graficoPoisson').getContext('2d');
    var graficoPoisson = new Chart(ctxPoisson, {
        type: 'line',
        data: {
            labels: @json($datosGraficoPoisson['labels']),
            datasets: [{
                label: 'Distribución de Poisson',
                data: @json($datosGraficoPoisson['data']),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            // Configuración opcional
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctxUniforme = document.getElementById('graficoUniforme').getContext('2d');
    var graficoUniforme = new Chart(ctxUniforme, {
        type: 'bar',
        data: {
            labels: @json($datosGraficoUniforme['labels']),
            datasets: [{
                label: 'Distribución Uniforme',
                data: @json($datosGraficoUniforme['data']),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
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

