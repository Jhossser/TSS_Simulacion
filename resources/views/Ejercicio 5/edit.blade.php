@extends('layout.plantilla')

@section('titulo', 'Ediar Ejercicio 5')
    
@section('links')
    <link rel="stylesheet" href="../../css/ejercicio3.css">
    <link rel="stylesheet" href="../../css/ejercicio4.css">
@endsection

@section('contenido')
    <h1>Problema de Reparacion de maquinaria</h1>
    <img class="imgEst" src="../../Image/reparacionMaquinaria.jpg" alt="foto estacionamiento">
    
    <br>
    <h2 class="margenAbajo">Personalice este problema a sus necesidades</h2>
    <form class="formEj3" id="formEj3" action="{{route('ej5.index')}}" method="get">
        @csrf
        <div class="form-group">
            <label for="ns">Número de Simulaciones</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="ns" id="ns" placeholder="Ingrese # simulaciones" value="{{old('ns',$hist->numSimu ?? '')}}">
                <span></span>
            </div>
            @error('ns')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="no">Numero de operarios</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="no" id="no" placeholder="Ingrese operarios" value="{{old('no',$hist->cantOperadores ?? '')}}">
                <span></span>
            </div>
            @error('no')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="cmo">Costo maquina ociosa</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="cmo" id="cmo" placeholder="Ingrese costo de maquina ociosa" value="{{old('cmo',$hist->costoMaqOciosa ?? '')}}">
                <span>Bs/hora</span>
            </div>
            @error('cmo')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="sh">Salario de operador</label>
            <div class="medidaInput">
                <input class="form-control" type="number" name="sh" id="sh" placeholder="Ingrese salario de operador" value="{{old('sh',$hist->salario ?? '')}}">
                <span>Bs/hora</span>
            </div>
            @error('sh')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>

        <div class="margenAbajo" id="masInfo">
            <p onclick="masInfo()">Mas infomacion <i class="fas fa-caret-down" id="flechaInfo"></i></p>
        </div>
        <div class="margenAbajo" id="informacion">
            <h2>Número de Simulaciones</h2>
            <p>cantida de fallas simuladas de maquinarias.</p>
            <h2>Numero de operarios</h2>
            <p>cantida de operarios a los cuales se les dividiran las maquinarias.</p>
            <h2>Costo maquina ociosa, Salario de operador</h2>
            <p>Costo que fijan la variable principal que da resolucion al problema de cuantas maquinas se le deben asignar a cada operario.</p>
        </div>
        <button type="submit" class="btn btn-primary">Resolver</button>
        <button type="button" class="btn btn-secondary" onclick="window.location='{{route('ej5.index')}}'">Cancelar</button>
    </form>
@endsection

@section('script')
<script src="../../js/ej3.js"></script>
@endsection