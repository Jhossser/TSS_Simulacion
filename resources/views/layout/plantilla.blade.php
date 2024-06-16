<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/plantilla.css">
    @yield('links')
    <title>@yield('titulo')</title>
</head>
<body>
    <header>
        aqui estara el menu
    </header>
    <main>
        @yield('contenido')
    </main>
</body>
<script src="../../js/plantilla.js"></script>
@yield('script')
</html>