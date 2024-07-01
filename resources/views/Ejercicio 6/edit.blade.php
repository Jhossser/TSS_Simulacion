@extends('layout.plantilla')

@section('titulo', 'Personalizar Problema de Reabastecimiento')

@section('contenido')
    <h1>Personalizar Problema de Reabastecimiento</h1>
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
¿El administrador del almacén desea saber cuál es el tamaño optimo del equipo
    </p>
    <br>
    <form action="{{ route('ej6.index') }}" method="GET">
        <div class="form-group">
            <label for="lambda">Tasa media de llegada de camiones por hora (λ):</label>
            <input type="number" name="lambda" id="lambda" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="numEquipos">Número de equipos:</label>
            <input type="number" name="numEquipos" id="numEquipos" class="form-control" required>
        </div>
        <div id="equipos-container">
            <div class="form-group">
                <label for="minTiempoServicio">Tiempo mínimo de servicio (equipo 1):</label>
                <input type="number" name="minTiempoServicio[]" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="maxTiempoServicio">Tiempo máximo de servicio (equipo 1):</label>
                <input type="number" name="maxTiempoServicio[]" class="form-control" required>
            </div>
        </div>
        <button type="button" id="agregar-equipo" class="btn btn-secondary">Agregar equipo</button>
        <button type="submit" class="btn btn-primary">Simular</button>
    </form>

    <script>
        document.getElementById('agregar-equipo').addEventListener('click', function () {
            var equipoIndex = document.querySelectorAll('#equipos-container .form-group').length / 2 + 1;
            var container = document.getElementById('equipos-container');
            var minTiempo = document.createElement('div');
            minTiempo.className = 'form-group';
            minTiempo.innerHTML = `<label for="minTiempoServicio">Tiempo mínimo de servicio (equipo ${equipoIndex}):</label><input type="number" name="minTiempoServicio[]" class="form-control" required>`;
            container.appendChild(minTiempo);

            var maxTiempo = document.createElement('div');
            maxTiempo.className = 'form-group';
            maxTiempo.innerHTML = `<label for="maxTiempoServicio">Tiempo máximo de servicio (equipo ${equipoIndex}):</label><input type="number" name="maxTiempoServicio[]" class="form-control" required>`;
            container.appendChild(maxTiempo);
        });
    </script>
@endsection
