<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/plantilla.css">

    <link rel="icon" href="../../Image/icono.png" type="image/x-icon">
    <link rel="shortcut icon" href="../../Image/icono.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    @yield('links')
    <title>@yield('titulo')</title>
</head>
@yield('style')
<body>
    <header class="cabecera">
        <i class="fas fa-bars" id="btnMenu"></i>
        <i onclick="logout()" class="fas fa-arrow-right-from-bracket"></i>
        <div class="contMenu" id="menu">
            <nav class="menu" >
                <ul>
                    <div class="cabeza">
                        <i class="fas fa-user" id="nomMenu"><p>{{ Auth::user()->nombre }}</p></i>
                        
                    </div>
                    <hr>
                    <li>
                        <a href="{{route('home')}}"><i class='fas fa-home'></i> INICIO</a>
                    </li>
                    <hr>
                    <li onclick="simu()" class="btnPrin">
                        <p><i class='fas fa-clipboard'></i> SIMULACIONES</p>
                        <i class="fas fa-caret-down" id="flecha1"></i>
                    </li>
                    <nav class="subMenu" id="sub1">
                        <ul>
                            <li>
                                <a href="{{ ('ambiente.create') }}">Estacion de servicio</a>
                            </li>
                            <li>
                                <a href="{{ ('AmbientesRegistrados') }}">Cajeros</a>
                            </li>
                            <li>
                                <a href="{{ route('ej3.index') }}">Estacionamiento</a>
                            </li>
                            <li>
                                <a href="{{ route('ej4.index') }}">Transporte de productos</a>
                            </li>
                            <li>
                                <a href="{{ route('ej5.index') }}">Reparacion de maquinaria</a>
                            </li>
                            <li>
                                <a href="{{ route('ej6.index') }}">Reabastecimiento</a>
                            </li>
                        </ul>
                    </nav>
                    <hr>
                    <li onclick="window.location='{{route('historial.index')}}'" class="btnPrin">
                        <p><i class='fas fa-clock-rotate-left'></i> HISTORIAL</p>
                        <i class="fas fa-caret-down" id="flecha2"></i>
                    </li>
                    <hr>
                </ul>
            </nav>
        </div>
    </header>
    <main class="principal">
        <div class="imagen">
            <img src="../../Image/icono.png" alt="Icono">
        </div>
        <div class="cont1">
            <div class="cont2">
                @yield('contenido')
            </div>
        </div>
    </main>
    <div id="fondoGris"></div>

    <!-- Formulario oculto para el logout -->
    <form id="logout-form" action="{{ route('usuario.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>   
<script src="../../js/plantilla.js"></script>
@yield('script')
</html>