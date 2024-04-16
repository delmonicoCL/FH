<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>FOODHERO</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg" style="background-color: #DA2427;">
            <div class="container-fluid">
                <a class="navbar-brand text-light" href="{{url('/')}}">FOODHERO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if (Auth::check()&&Auth::user()["tipo"]==="administrador")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Edicion USERS</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ url("usuarios")}}">RIDERS</a>
                                    <a class="dropdown-item" href="">PROVEEDORES</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Estadisticas</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="">RIDERS-Estadisticas</a>
                                    <a class="dropdown-item" href="">PROVEEDORES-Estadisticas</a>
                                </div>
                            </li>
                        @endif
                    </ul>
                    <form class="d-flex" role="search">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @if (Auth::check())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        @if(Auth::user()["tipo"]==="rider") {{$rider["nickname"]}} @else {{Auth::user()["nombre"]}} @if (Auth::check()&&Auth::user()["tipo"]==="administrador") {{$administrador["apellidos"]}} @endif @endif
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{url('/logout')}}">Cerrar sesion</a>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{url('/login')}}">Iniciar Sesion</a>
                                </li>
                            @endif
                        </ul>
                    </form>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            @yield('contenido')
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>