<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/iniciarSesion.css">

    <link rel="icon" href="../../Image/icono.png" type="image/x-icon">
    <link rel="shortcut icon" href="../../Image/icono.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <title>Iniciar Sesión</title>
</head>
<body>
    <header class="cabecera">
        
    </header>


    <main class="principal">
        <div class="cont1">
            <div class="cont2">
                <div class="nombre">
                    <h1 class="mob">MOBILE</h1>
                    <h1 class="sim">SIMU</h1>
                </div>  
                <br>
                <div style="width: 100%;">
                    <h1>Registrarse</h1>
                </div>
                <form class="formIniciar" action="{{route('usuario.register')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese un nombre" value="{{old('nombre')}}">
                        @error('nombre')
                            <span class="text-danger">*{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" type="number" name="password" id="password" placeholder="Ingrese su password" value="">
                        @error('password')
                            <span class="text-danger">*{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <input type="password" class="form-control" type="number" name="password_confirmation" id="password_confirmation" placeholder="Vuelva a ingresar password" value="">
                        @error('password_confirmation')
                            <span class="text-danger">*{{$message}}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="btnIniciar">
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location='{{route('usuario.iniciar')}}'">Volver</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <div id="fondoGris"></div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script> 
<script src="../../js/iniciarSesion.js"></script>

</html>