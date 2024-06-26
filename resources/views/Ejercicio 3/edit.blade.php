@extends('layout.plantilla')

@section('titulo', 'Ej3 Personalizar')
    
@section('links')
    <link rel="stylesheet" href="../../css/ejercicio3.css">
@endsection

@section('contenido')
    <h1>Problema de Estacionamiento</h1>
    <img class="imgEst" src="../../Image/estacionamiento.jpg" alt="foto estacionamiento">
    <p class="margenAbajo" style="text-align: justify;">
        Una tienda pequeña tiene un lote de estacionamiento con ciertos lugares disponibles. Los clientes llegan en forma aleatoria de acuerdo a un proceso Poisson a una razón 
        media de una cantidad de clientes por hora, y se van inmediatamente si no existen lugares disponibles en el estacionamiento. El tiempo que un auto permanece en el estacionamiento 
        sigue una distribución uniforme entre un intervalo de minutos.
    </p>
    <br>
    <h2 class="margenAbajo">Personalice este problema a sus necesidades</h2>
    <form class="formEj3" action="{{route('ej3.update')}}" method="get">
        @csrf
        <div class="form-group">
            <label for="tasaLlegada">Tasa de llegada</label>
            <input class="form-control" type="number" name="tasaLlegada" id="tasaLlegada" placeholder="Ingrese tasa de llegada de vehiculos" value="{{old('tasaLlegada', $hist->tasaLlegada ?? '')}}">
            @error('tasaLlegada')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="tasaServicio">Tasa de servicio</label>
            <input class="form-control" type="number" name="tasaServicio" id="tasaServicio" placeholder="Ingrese la tasa de servicio en horas" value="{{old('tasaServicio', $hist->tasaServicio ?? '')}}">
            @error('tasaServicio')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="capacidad">Capacidad del estacionamiento</label>
            <input class="form-control" type="number" name="capacidad" id="capacidad" placeholder="Ingrese la capacidad del estacionamiento" value="{{old('capacidad', $hist->cantCupos ?? '')}}">
            @error('capacidad')
                <span class="text-danger">*{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="tiempo">Tiempo de simulacion</label>
            <input class="form-control" type="number" name="tiempo" id="tiempo" placeholder="Ingrese el tiempo en horas" value="{{old('tiempo', $hist->tiemposimu ?? '')}}">
            @error('tiempo')
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
        <button type="button" class="btn btn-secondary" onclick="window.location='{{route('ej3.index')}}'">Cancelar</button>
    </form>
@endsection

@section('script')
<script src="../../js/ej3.js"></script>
@endsection