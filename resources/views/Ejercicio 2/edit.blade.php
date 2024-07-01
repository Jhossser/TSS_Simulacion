@extends('layout.plantilla')

@section('titulo', 'Ej2 Personalizar')
    
@section('links')
    <link rel="stylesheet" href="../../css/ejercicio3.css">
@endsection

@section('contenido')
    <h1>Problema de Estacionamiento</h1>
    <img class="imgEst" src="../../Image/cajeros.jpg" alt="foto cajeros">
    <p class="margenAbajo" style="text-align: justify;">
        Un banco emplea 3 cajeros para servir a sus clientes. Los clientes arriban de acuerdo 
        a un proceso Poisson a una razón media de 40 por hora. Si un cliente encuentra todos 
        los cajeros ocupados. entonces se incorpora a la cola que alimenta a todos los cajeros. 
        El tiempo que dura la transacción entre un cajero y un cliente sigue una distribución 
        uniforme entre 0 y 1 minuto. Para esta información, ¿Cuál es el tiempo promedio en el sistema?, 
        ¿Cuál es la cantidad promedio de clientes en el sistema? 
    </p>
    <br>
    <h2 class="margenAbajo">Personalice este problema a sus necesidades</h2>
    <div class="formEj3" >
        
        <div class="form-group">
            <label for="tasaLlegada">Numero de Cajeros</label>
            <input class="form-control" type="number" name="tasaLlegada" id="tasaLlegada" placeholder="Ingrese el numero de cajeros" value="{{$hist->numCajeros ?? ''}}">
            <span class="error-message" id="error-tasaLlegada"></span>
        </div>
        <div class="form-group">
            <label for="tasaServicio">Clientes por hora</label>
            <input class="form-control" type="number" name="tasaServicio" id="tasaServicio" placeholder="Ingrese el numero de clientes por hora" value="{{$hist->clientePorHora ?? ''}}">
            <span class="error-message" id="error-tasaServicio"></span>
        </div>
        <div class="form-group">
            <label for="capacidad">Tiempo maximo del cliente en el cajero</label>
            <input class="form-control" type="number" name="capacidad" id="capacidad" placeholder="Ingrese el tiempo del cliente en el cajero" value="{{$hist->maxTiempoCajero ?? ''}}">
            <span class="error-message" id="error-capacidad"></span>
        </div>
        
        <div class="margenAbajo" id="masInfo">
            <p onclick="masInfo()">Mas infomacion <i class="fas fa-caret-down" id="flechaInfo"></i></p>
        </div>
        <div class="margenAbajo" id="informacion">
            <h2>Numero de Cajeros</h2>
            <p> El editar el numero de cajeros que se tiene llega a ser util al momento de dar una simulacion mas fiel para el usuario </p>
            <h2>Clientes por hora</h2>
            <p> La media de clientes  atendidos (λ) se refiere a la frecuencia con la que los clientes llegan a los cajeros. En el contexto de nuestro modelo, esta tasa se mide en clientes por hora. </p>
            <h2>Tiempo maximo del cliente en el cajero</h2>
            <p>-------(μ)</p>
            </div>
        <button type="submit" class="btn btn-primary"  id="Calcular">Actualizar</button>
        <button type="button" class="btn btn-secondary" onclick="window.location='{{route('ej2.index')}}'">Cancelar</button>
    </div>
    <br>
    <div class="actualizar" style="display:none; width: 100%;">
        <h2>Detalles de la simulacion</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Nro</th>
                        <th>Clientes por hora</th>
                        <th>Tiempo de llegada</th>
                        <th>Tiempo de transaccion</th>
                        <th>Tiempo final de transaccion</th>
                        <th>Tiempo en sistemas</th>
                        <th>Clientes en el sistema</th>
                    </tr>
                </thead>
                <tbody id="tablaIteracion">
                    
                </tbody>
            </table>
        </div>

        <h1>Cantidad de Eventos</h1>
        <p id="iteraciones"></p>
        <br>
        <div class="ecuacion">
            <h1>Estadisticas</h1>
            <p id="promedioClientes">Cantidad promedio de Clientes: <span id="promCl"> </span></p>
            <p id="tiempoPromedio">Tiempo promedio en el sistema: <span id="temP"></span></p>
        </div>
        
        {{-- Grafico --}}
        <br>
        <h1>Tiempo Promedio</h1>
        <canvas id="graficoExponencial" width="150" height="200" style="margin-top: 20px;"></canvas>
        <h1>Clientes promedio en el sistema</h1>
        <canvas id="graficoUniforme" width="150" height="200" style="margin-top: 20px;"></canvas>
    </div>
@endsection


@section('script')
<script src="../../js/ej2.js"></script>
@endsection
<style>
.error-message {
    color: red;
    font-size: 0.9em;
    margin-top: 5px;
}
</style>