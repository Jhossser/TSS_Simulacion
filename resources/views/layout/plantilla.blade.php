<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../css/plantilla.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    @yield('links')
    <title>@yield('titulo')</title>
</head>
<body>
    <header>
        <i class="fas fa-bars" id="btnMenu"></i>
        <i class="fas fa-arrow-right-from-bracket"></i>
    </header>
    <div class="contMenu" id="menu">
        <nav class="menu" >
            <ul>
                <div class="cabeza">
                    <i class="fas fa-user"></i>
                </div>
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
                            <a href="{{ ('AmbientesRegistrados') }}">Estacionamiento</a>
                        </li>
                        <li>
                            <a href="{{ ('AmbientesRegistrados') }}">Transporte de productos</a>
                        </li>
                        <li>
                            <a href="{{ ('AmbientesRegistrados') }}">Reparacion de maquinaria</a>
                        </li>
                        <li>
                            <a href="{{ ('AmbientesRegistrados') }}">Reabastecimiento</a>
                        </li>
                    </ul>
                </nav>
                <hr>
                <li onclick="hist()" class="btnPrin">
                    <p><i class='fas fa-clock-rotate-left'></i> HISTORIAL</p>
                    <i class="fas fa-caret-down" id="flecha2"></i>
                </li>
                <hr>
            </ul>
        </nav>
    </div>
    <main class="principal">
        @yield('contenido')
    </main>
    <div id="fondoGris"></div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../../js/plantilla.js"></script>
@yield('script')
</html>