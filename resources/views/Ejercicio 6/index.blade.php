@extends('layout.plantilla')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio6.css">
@endsection

@section('titulo', 'Reabastecimiento')

@section('contenido')
    <h1>Problema de Reabastecimiento</h1>
    <div class="contenedor">
        <img class="imgEst" src="../../Image/reabastecimiento.jpg" alt="Colas de servicio">
    </div>
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
¿El administrador del almacén desea saber cuál es el tamaño optimo del equipo
    </p>
    <br>

    <!-- Aquí mostramos los resultados de la simulación -->
    <div class="table-responsive">
        <h3>Eficiencia de Equipos</h3>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Equipo</th>
                    <th>Tiempo Promedio de Servicio (horas)</th>
                    <th>Tiempo Promedio en el Sistema (horas)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teamsResults as $team => $result)
                    <tr>
                        <td>Equipo {{ $team }}</td>
                        <td>{{ round($result['avgServiceTime'], 2) }}</td>
                        <td>{{ round($result['avgSystemTime'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Gráfico del tiempo en el sistema de los camiones por cada equipo -->
    <h1>Gráfico del Tiempo en el Sistema de los Camiones por Equipo</h1>
    <canvas id="graficoTiempoSistema" width="400" height="200"></canvas>

    <!-- Gráfico de la eficiencia de los equipos -->
    <h1>Gráfico de Eficiencia de Equipos</h1>
    <canvas id="graficoEficienciaEquipos" width="400" height="200"></canvas>

    <!-- Botones y scripts -->
    <div class="botones">
        <a href="{{ route('ej6.edit') }}" class="btn btn-primary">Personalizar problema</a>
        @if (isset($datos))
            <button class="btn btn-secondary" onclick="rehacerDatos()">Simular nuevamente</button>
        @else
            <button class="btn btn-secondary" onclick="rehacer()">Simular nuevamente</button>
        @endif
    </div>
@endsection

@section('script')
    <script>
        // Datos para el gráfico de tiempo en el sistema de los camiones por equipo
        var labels = ["Equipo 1", "Equipo 2", "Equipo 3", "Equipo 4"];
        var systemTimes = @json(array_map(fn($result) => round($result['avgSystemTime'], 2), $teamsResults));

        var ctxTiempoSistema = document.getElementById('graficoTiempoSistema').getContext('2d');
        var graficoTiempoSistema = new Chart(ctxTiempoSistema, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tiempo Promedio en el Sistema (horas)',
                    data: systemTimes,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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

        // Datos para el gráfico de eficiencia de los equipos
        var avgServiceTimes = @json(array_map(fn($result) => round($result['avgServiceTime'], 2), $teamsResults));

        var ctxEficienciaEquipos = document.getElementById('graficoEficienciaEquipos').getContext('2d');
        var graficoEficienciaEquipos = new Chart(ctxEficienciaEquipos, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tiempo Promedio de Servicio (horas)',
                    data: avgServiceTimes,
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

