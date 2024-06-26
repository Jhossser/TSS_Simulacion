@extends('layout.plantilla')

@section('titulo', 'Editar ejericico 4')
    
@section('links')
    <link rel="stylesheet" href="../../css/ejercicio4.css">
    <link rel="stylesheet" href="../../css/ejercicio3.css">
@endsection

@section('contenido')
    <h1>Problema de Transporte de Productos</h1>
    <img class="imgEst" src="../../Image/transporteProductos.jpg" alt="foto estacionamiento">
    
    <br>
    <h2 class="margenAbajo">Personalice este problema a sus necesidades</h2>
    <form class="formEj3" id="formEj3" action="{{route('ej4.index')}}" method="get">
        @csrf
        <div class="form-group">
            <label for="vc">Velocidad de Camion</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="vc" id="vc" placeholder="Ingrese tasa de llegada de vehiculos" value="{{old('vc',$hist->velocidad ?? '')}}">
                <span>km/h</span>
            </div>
            @error('vc')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="d">Distancia entre fabrica y almacen</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="d" id="d" placeholder="Ingrese la tasa de servicio en horas" value="{{old('d',$hist->distancia ?? '')}}">
                <span>km</span>
            </div>
            @error('d')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="tc">Tiempo en carga</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="tc" id="tc" placeholder="Ingrese la tc del estacionamiento" value="{{old('tc',$hist->tiempoCarga ?? '')}}">
                <span>min</span>
            </div>
            @error('tc')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="td">Tiempo en descargar</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="td" id="td" placeholder="Ingrese el tiempo en horas" value="{{old('td',$hist->tiempoDescarga ?? '')}}">
                <span>min</span>
            </div>
            @error('td')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="tt">Jornada laboral</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="tt" id="tt" placeholder="Ingrese el tiempo en horas" value="{{old('tt',$hist->jornada ?? '')}}">
                <span>hr</span>
            </div>
            @error('tt')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="ce">Costo de transportar producto exedente</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="ce" id="ce" placeholder="Ingrese el tiempo en horas" value="{{old('ce',$hist->costoExedente ?? '')}}">
                <span>Bs</span>
            </div>
            @error('ce')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="cac">Costo anual de camion</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="cac" id="cac" placeholder="Ingrese el tiempo en horas" value="{{old('cac',$hist->costoAnualCamion ?? '')}}">
                <span>Bs</span>
            </div>
            @error('cac')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>

        <div class="margenAbajo" id="masInfo">
            <p onclick="masInfo()">Mas infomacion <i class="fas fa-caret-down" id="flechaInfo"></i></p>
        </div>
        <div class="margenAbajo" id="informacion">
            <h2>Tasa de llegada</h2>
            <p>La tasa de llegada (λ) se refiere a la frecuencia con la que los clientes llegan al estacionamiento. En el contexto de nuestro modelo, esta tasa se mide en clientes por hora.</p>
            <h2>Tasa de servicio</h2>
            <p>La tasa de servicio (μ) representa la rapidez con la que los espacios de estacionamiento se liberan, es decir, el tiempo que cada auto permanece estacionado. Se mide en términos de "servicios" por hora.</p>
            <h2>Capacidad del estacionamiento</h2>
            <p>La capacidad del estacionamiento es el número total de espacios disponibles en el estacionamiento.</p>
            <h2>Tiempo de simulacion</h2>
            <p>El tiempo de simulación es la duración total durante la cual se lleva a cabo la simulación. Este tiempo se mide en minutos u horas, según el contexto.</p>
        </div>
        <button type="submit" class="btn btn-primary">Resolver</button>
        <button type="button" class="btn btn-secondary" onclick="window.location='{{route('ej4.index')}}'">Cancelar</button>
    </form>
@endsection

@section('script')
<script src="../../js/ej3.js"></script>
@endsection