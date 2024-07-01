@extends('layout.plantilla')

@section('titulo', 'Personalizar Problema de Reabastecimiento')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio4.css">
    <link rel="stylesheet" href="../../css/ejercicio3.css">
@endsection

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
    <form action="{{ route('ej6.index') }}" method="GET" style="width: 100%;">
        <div class="form-group">
            <label for="lambda">Tasa media de llegada de camiones por hora (λ):</label>
            <input type="number" name="lambda" id="lambda" class="form-control" required value="{{old('lambda',$hist->tasaLlegada ?? '')}}">
        </div>
        <div class="form-group" style="display: none;">
            <label for="numEquipos">Número de equipos:</label>
            <input type="number" name="numEquipos" id="numEquipos" class="form-control" required value="{{$hist->numEquipos ?? '1'}}">
        </div>
        <div id="equipos-container">
            @if (isset($hist))
                @foreach ($equipos as $equipo)   
                    <div class="form-group">
                        <label for="minTiempoServicio">Tiempo mínimo de servicio (equipo {{$equipo->numEquipo}}):</label>
                        <input type="number" name="minTiempoServicio[]" class="form-control" required value="{{$equipo->min}}">
                    </div>
                    <div class="form-group">
                        <label for="maxTiempoServicio">Tiempo máximo de servicio (equipo {{$equipo->numEquipo}}):</label>
                        <input type="number" name="maxTiempoServicio[]" class="form-control" required value="{{$equipo->max}}">
                    </div>
                @endforeach
            @else    
                <div class="form-group">
                    <label for="minTiempoServicio">Tiempo mínimo de servicio (equipo 1):</label>
                    <input type="number" name="minTiempoServicio[]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="maxTiempoServicio">Tiempo máximo de servicio (equipo 1):</label>
                    <input type="number" name="maxTiempoServicio[]" class="form-control" required>
                </div>
            @endif

        </div>

    <div class="margenAbajo" id="masInfo">
            <p onclick="masInfo()">Mas infomacion <i class="fas fa-caret-down" id="flechaInfo"></i></p>
        </div>
        <div class="margenAbajo" id="informacion">
            <h2>Tasa media de llegada de camiones por hora</h2>
            <p>La tasa de llegada (λ) se refiere a la frecuencia con la que los camiones llegan al almacenamiento. En el contexto de nuestro modelo, esta tasa se mide en camiones por hora.</p>
            <h2>Numero de equipo</h2>
            <p>EL numero equipos es para comparar la eficiencia de diversos equipos que tienen una diferencia que no afecta a la simulasion que marca que haya diferencia entre sus maximos y minimos.</p>
            <h2>Max,Min</h2>
            <p>Marcan el rango que entiende la distribucion uniforme que genera la eficiencia de cada equipo.</p>
        </div>       
        <button type="button" id="agregar-equipo" class="btn btn-secondary">Agregar equipo</button>
        <button type="submit" class="btn btn-primary">Simular</button>
        <button type="button" class="btn btn-secondary" onclick="window.location='{{route('ej6.index')}}'">Cancelar</button>
    </form>
@endsection

@section('script')
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

            let currentValue = parseInt($('#numEquipos').val());

            // Incrementa el valor en 1
            let newValue = currentValue + 1;

            // Actualiza el valor del input
            $('#numEquipos').val(newValue);
        });
    </script>
<script src="../../js/ej3.js"></script>
@endsection