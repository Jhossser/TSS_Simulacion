@extends('layout.plantilla')

@section('links')
    <link rel="stylesheet" href="../../css/inicio.css">
@endsection

@section('titulo', 'Mobile Simu')

@section('style')
<style>
    .table{
        font-size: 14px;
    }
</style>
@endsection

@section('contenido')
    <h1>Historial</h1>
    <br>
    <h2>Ejercicio 1</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>lambda</th>
                    <th>Media Estacion 1</th>
                    <th>Min estacion 2</th>
                    <th>Max estacion 2</th>
                    <th>Numero Clientes</th>
                </tr>
            </thead>
            <tbody id="tablaIteracion">
                @if($ej1->isEmpty())
                    <tr>
                        <td class="alert alert-primary">Sin</td>
                        <td class="alert alert-primary">registros.</td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                    </tr>
                @else
                    @foreach ($ej1 as $item)
                        <tr>
                            <td>{{$item->lambda}}</td>
                            <td>{{$item->mediaEst1}}</td>
                            <td>{{$item->minEst2}}</td>
                            <td>{{$item->maxEst2}}</td>
                            <td>{{$item->numClientes}}</td>
                            <td><a href="{{route('ej1.hist', $item)}}" class="btn btn-primary">Simular</a></td>
                            
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <br>
    <h2>Ejercicio 2</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Numero Cajeros</th>
                    <th>Clientes por hora</th>
                    <th>Tiempo max. en cajero</th>
                </tr>
            </thead>
            <tbody id="tablaIteracion">
                @if($ej2->isEmpty())
                    <tr>
                        <td class="alert alert-primary">Sin</td>
                        <td class="alert alert-primary">registros.</td>
                        <td class="alert alert-primary"></td>
                    </tr>
                @else
                    @foreach ($ej2 as $item)
                        <tr>
                            <td>{{$item->numCajeros}}</td>
                            <td>{{$item->clientePorHora}}</td>
                            <td>{{$item->maxTiempoCajero}}</td>
                            <td><a href="{{route('ej2.hist', $item)}}" class="btn btn-primary">Simular</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <br>
    <h2>Ejercicio 3</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Tasa de llegada</th>
                    <th>Tasa de servicio</th>
                    <th>Cantidad estacionamientos</th>
                    <th>Tiempo simulacion</th>
                </tr>
            </thead>
            <tbody id="tablaIteracion">
                @if($ej3->isEmpty())
                    <tr>
                        <td class="alert alert-primary">Sin</td>
                        <td class="alert alert-primary">registros.</td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                    </tr>
                @else
                    @foreach ($ej3 as $item)
                        <tr>
                            <td>{{$item->tasaLlegada}}</td>
                            <td>{{$item->tasaServicio}}</td>
                            <td>{{$item->cantCupos}}</td>
                            <td>{{$item->tiemposimu}}</td>
                            <td><a href="{{route('ej3.hist', $item)}}" class="btn btn-primary">Simular</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <br>
    <h2>Ejercicio 4</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Velocidad</th>
                    <th>Distancia</th>
                    <th>Tiempo de carga</th>
                    <th>Tiempo de descarga</th>
                    <th>Jornada laboral</th>
                    <th>Costo de producto exedente</th>
                    <th>Costo anual de camion</th>
                </tr>
            </thead>
            <tbody id="tablaIteracion">
                @if($ej4->isEmpty())
                    <tr>
                        <td class="alert alert-primary">Sin</td>
                        <td class="alert alert-primary">registros.</td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                    </tr>
                @else
                    @foreach ($ej4 as $item)
                        <tr>
                            <td>{{$item->velocidad}}</td>
                            <td>{{$item->distancia}}</td>
                            <td>{{$item->tiempoCarga}}</td>
                            <td>{{$item->tiempoDescarga}}</td>
                            <td>{{$item->jornada}}</td>
                            <td>{{$item->costoExedente}}</td>
                            <td>{{$item->costoAnualCamion}}</td>
                            <td><a href="{{route('ej4.hist', $item)}}" class="btn btn-primary">Simular</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <br>
    <h2>Ejercicio 5</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Numero simulaciones</th>
                    <th>Cantidad de Operadores</th>
                    <th>Costo de maquina ociosa</th>
                    <th>Salario por hora</th>
                </tr>
            </thead>
            <tbody id="tablaIteracion">
                @if($ej5->isEmpty())
                    <tr>
                        <td class="alert alert-primary">Sin</td>
                        <td class="alert alert-primary">registros.</td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                    </tr>
                @else
                    @foreach ($ej5 as $item)
                        <tr>
                            <td>{{$item->numSimu}}</td>
                            <td>{{$item->cantOperadores}}</td>
                            <td>{{$item->costoMaqOciosa}}</td>
                            <td>{{$item->salario}}</td>
                            <td><a href="{{route('ej5.hist', $item)}}" class="btn btn-primary">Simular</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <br>
    <h2>Ejercicio 6</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Tasa llegada</th>
                    <th>Numero Equipos</th>
                    <th>Tiempo min. Eq.1</th>
                    <th>Tiempo min. Eq.2</th>
                    <th>Tiempo min. Eq.3</th>
                    <th>Tiempo min. Eq.4</th>
                    <th>Tiempo max. Eq.1</th>
                    <th>Tiempo max. Eq.2</th>
                    <th>Tiempo max. Eq.3</th>
                    <th>Tiempo max. Eq.4</th>
                </tr>
            </thead>
            <tbody id="tablaIteracion">
                @if($ej6->isEmpty())
                    <tr>
                        <td class="alert alert-primary">Sin</td>
                        <td class="alert alert-primary">registros.</td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                        <td class="alert alert-primary"></td>
                    </tr>
                @else
                    @foreach ($ej6 as $item)
                        <tr>
                            <td>{{$item->tasaLlegada}}</td>
                            <td>{{$item->numEquipos}}</td>
                            <td>{{$item->tminE1}}</td>
                            <td>{{$item->tminE2}}</td>
                            <td>{{$item->tminE3}}</td>
                            <td>{{$item->tminE4}}</td>
                            <td>{{$item->tmaxE1}}</td>
                            <td>{{$item->tmaxE2}}</td>
                            <td>{{$item->tmaxE3}}</td>
                            <td>{{$item->tmaxE4}}</td>
                            <td><a href="{{route('ej6.hist', $item)}}" class="btn btn-primary">Simular</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
