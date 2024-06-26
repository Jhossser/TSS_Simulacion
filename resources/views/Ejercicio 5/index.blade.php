@extends('layout.plantilla')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio4.css">
@endsection

@section('titulo', 'Reaparacion Maquinaria')

@section('contenido')
    <h1>Problema de Reparacion de maquinaria</h1>
    <img class="imgEst" src="../../Image/reparacionMaquinaria.jpg" alt="foto estacionamiento">
    
    <p class="margenAbajo" style="text-align: justify;">
        Una cierta compañía posee un gran número de máquinas en uso. El tiempo que dura en operación
        cada una de estas máquinas, sigue la siguiente distribuci6n de probabilidad:
    </p>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Tiempo entre descomposturas (horas)</th>
                    <th>Probabilidad</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>6 - 8</td>
                        <td>0.10</td>
                    </tr>
                    <tr>
                        <td>8 - 10</td>
                        <td>0.15</td>
                    </tr>
                    <tr>
                        <td>10 - 12</td>
                        <td>0.24</td>
                    </tr>
                    <tr>
                        <td>12 - 14</td>
                        <td>0.26</td>
                    </tr>
                    <tr>
                        <td>16 - 18</td>
                        <td>0.18</td>
                    </tr>
                    <tr>
                        <td>18 - 20</td>
                        <td>0.07</td>
                    </tr>
            </tbody>
        </table>
    </div>
    
    <p>
        El tiempo que un operador se tarda en reparar una máquina, sigue la siguiente distribución de
        probabilidad:
    </p>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Tiempo de reparacion (horas)</th>
                    <th>Probabilidad</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>2 - 4</td>
                        <td>0.15</td>
                    </tr>
                    <tr>
                        <td>4 - 6</td>
                        <td>0.25</td>
                    </tr>
                    <tr>
                        <td>6 - 8</td>
                        <td>0.30</td>
                    </tr>
                    <tr>
                        <td>8 - 10</td>
                        <td>0.20</td>
                    </tr>
                    <tr>
                        <td>10 - 12</td>
                        <td>0.10</td>
                    </tr>
            </tbody>
        </table>
    </div>
    <p>
        El costo de tener una maquina ociosa durante una hora es de $500, y el salario por hora para este
        tipo de operarios es de $50.
    </p>
    <span class="alert alert-primary">
        <p>Numero de operarios = {{$datos['no']}}</p>
        <p>Costo de maquina ociosa = Bs. {{$datos['cmo']}}</p>
        <p>Salario = {{$datos['sh']}} Bs/hora</p>
    </span>

    <p class="margenAbajo">
        a) ¿Cuantas maquinas se deben asignar a cada mecánico para que las
        atienda?
    </p>
    <br>
    <div class="margenAbajo">
        <h1>Proceso de asignacion</h1>
        <p style="text-align: justify;">
            Supondremos una cantidad de operadores en la compañia a los cuales se les sera asignado una cantida de maquinas. Con ayuda de la formula de la distribucion uniforme y posteriores calculos sabremos cual es la asignacion optima.
        </p>
    </div>
    <br>
    <h1>Cantidad de simulaciones</h1>
    <p id="iteraciones">{{$datos['ns']}}</p>
    <br>
    <div class="ecuacion">
        <h1>Respuesta</h1>
        <p>La asignacion optima de maquinas es:</p>
        <p class="text-danger" id="asignacionMinimo">{{$asignacionMinimo}} maquinas</p>
        <p>Su coste minimo es:</p>
        <p class="text-danger" id="costoMinimo2">Bs. {{$costoMinimo2}}</p>
    </div>
    
    {{-- Grafico --}}
    <br>
    <h1>Costo vs. Asignaciones</h1>
    <canvas id="graficoAsignaCosto" width="150" height="200"></canvas>
    <br>   
    <h2>Tabla de costo y asignacion</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Asignacion</th>
                    <th>Costo</th>
                </tr>
            </thead>
            <tbody id="tablaIteracion">
                @foreach ($tablaAsignadoCosto as $asignadoCosto)
                    <tr>
                        <td>{{ $asignadoCosto['asignado'] }}</td>
                        <td>{{ $asignadoCosto['costo']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    
    <div class="botones">
        <a href="{{route('ej5.edit')}}" class="btn btn-primary">Personalizar problema</a>
        <button class="btn btn-secondary" onclick="rehacer()">Simular nuevamente</button>
    </div>
    <br>

    <h2>Formula de Distribucion Uniforme</h2>
    <p>$$ F(R) = a + (b - a)R $$</p>

    {{-- Formulario para simular nuevamente --}}
    <form class="formEj3" id="formEj3" action="" method="get" style="display: none;">
        @csrf
        <div class="form-group">
            <label for="ns">Número de Simulaciones</label>
            <input class="form-control" type="number" name="ns" id="ns" value="{{$datos['ns']}}">
        </div>
        <div class="form-group">
            <label for="no">Numero de operarios</label>
            <input class="form-control" type="number" name="no" id="no" value="{{$datos['no']}}">
        </div>
        <div class="form-group">
            <label for="cmo">Costo maquina ociosa</label>
            <input class="form-control" type="number" name="cmo" id="cmo" value="{{$datos['cmo']}}">
        </div>
        <div class="form-group">
            <label for="sh">Salario de operador</label>
            <input class="form-control" type="number" name="sh" id="sh" value="{{$datos['sh']}}">
        </div>
    </form>
@endsection

@section('script')  
    <script>
        const tablaAsignadoCosto = @json($tablaAsignadoCosto);
    </script>
    <script src="../../js/ej5.js"></script>
@endsection