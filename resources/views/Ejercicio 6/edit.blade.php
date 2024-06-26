@extends('layout.plantilla')

@section('titulo', 'Ejercicio 6 Personalizar')
    
@section('links')
    <link rel="stylesheet" href="../../css/ejercicio6.css">
@endsection

@section('contenido')
    <h1>Problema de Reabastecimiento - Personalizar</h1>
    <img class="imgEst" src="../../Image/reabastecimiento.jpg" alt="Colas de servicio">
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
    <form action="{{ route('ej6.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="lambda">Tasa media de llegada (λ):</label>
            <input type="number" class="form-control" id="lambda" name="lambda" value="{{ old('lambda', 2) }}" step="0.1" required>
        </div>

        <div class="form-group">
            <label for="numEquipos">Número de Equipos:</label>
            <input type="number" class="form-control" id="numEquipos" name="numEquipos" value="{{ old('numEquipos', 4) }}" min="1" required>
        </div>

        <div id="equipos">
            @for ($i = 1; $i <= old('numEquipos', 4); $i++)
                <div class="form-group">
                    <label>Equipo {{ $i }}</label>
                    <input type="number" class="form-control" name="minTiempoServicio[]" placeholder="Tiempo mínimo de servicio (min)" value="{{ old('minTiempoServicio.' . ($i-1), 20) }}" required>
                    <input type="number" class="form-control" name="maxTiempoServicio[]" placeholder="Tiempo máximo de servicio (min)" value="{{ old('maxTiempoServicio.' . ($i-1), 30) }}" required>
                </div>
            @endfor
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection

@section('script')
    <script>
        document.getElementById('numEquipos').addEventListener('input', function() {
            const numEquipos = this.value;
            const equiposDiv = document.getElementById('equipos');
            equiposDiv.innerHTML = '';

            for (let i = 1; i <= numEquipos; i++) {
                const equipoDiv = document.createElement('div');
                equipoDiv.className = 'form-group';
                equipoDiv.innerHTML = `
                    <label>Equipo ${i}</label>
                    <input type="number" class="form-control" name="minTiempoServicio[]" placeholder="Tiempo mínimo de servicio (min)" value="20" required>
                    <input type="number" class="form-control" name="maxTiempoServicio[]" placeholder="Tiempo máximo de servicio (min)" value="30" required>
                `;
                equiposDiv.appendChild(equipoDiv);
            }
        });
    </script>
@endsection