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
                <input class="form-control" type="number" name="vc" id="vc" value="{{old('vc',$hist->velocidad ?? '')}}">
                <span>km/h</span>
            </div>
            @error('vc')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="d">Distancia entre fabrica y almacen</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="d" id="d" value="{{old('d',$hist->distancia ?? '')}}">
                <span>km</span>
            </div>
            @error('d')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="tc">Tiempo en carga</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="tc" id="tc" value="{{old('tc',$hist->tiempoCarga ?? '')}}">
                <span>min</span>
            </div>
            @error('tc')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="td">Tiempo en descargar</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="td" id="td" value="{{old('td',$hist->tiempoDescarga ?? '')}}">
                <span>min</span>
            </div>
            @error('td')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="tt">Jornada laboral</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="tt" id="tt" value="{{old('tt',$hist->jornada ?? '')}}">
                <span>hr</span>
            </div>
            @error('tt')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="ce">Costo de transportar producto exedente</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="ce" id="ce" value="{{old('ce',$hist->costoExedente ?? '')}}">
                <span>Bs</span>
            </div>
            @error('ce')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="cac">Costo anual de camion</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="cac" id="cac" value="{{old('cac',$hist->costoAnualCamion ?? '')}}">
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
            <h2>Velocidad de Camion</h2>
            <p>velocidad promedio de los camiones a los que se los quiera poner en simulacion.</p>
            <h2>Distancia entre fabrica y almacen</h2>
            <p>Distancia a la que los camiones se pondran a prueba durante la simulacion.</p>
            <h2>Tiempo en carga,Tiempo en descargar</h2>
            <p>Eficiencia de atencion en los dos puntos que sirve para poder obtener el tiempo total para cada entrega.</p>
            <h2>Jornada laboral</h2>
            <p>Limite de tiempo para hacer el translado de la carga diaria.</p>
            <h2>Costo de transportar producto exedente,Costo anual de camion</h2>
            <p>Costo que sirve como variable principal para la resolucion de que eleccion es mejor.</p>
        </div>
        <button type="submit" class="btn btn-primary">Resolver</button>
        <button type="button" class="btn btn-secondary" onclick="window.location='{{route('ej4.index')}}'">Cancelar</button>
    </form>
@endsection

@section('script')
<script src="../../js/ej3.js"></script>
@endsection