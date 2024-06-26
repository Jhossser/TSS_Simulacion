@extends('layout.plantilla')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio6.css">
@endsection

@section('titulo', 'Reabastecimiento')

@section('contenido')
    <!-- Contenido de la vista -->
    <h1>Problema de Reabastecimiento</h1>
    <div class="contenedor">
    <img class="imgEst" src="../../Image/reabastecimiento.jpg"  alt="Colas de servicio">
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
    
    <h3>Tiempos por Cliente</h3>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>

            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
    <!-- Gráficos -->
    <h1>Gráfico de Distribución de Poisson</h1>
    <canvas id="graficoPoisson" width="400" height="200"></canvas>
    <h1>Gráfico de Distribución Uniforme</h1>
    <canvas id="graficoUniforme" width="400" height="200"></canvas>

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
