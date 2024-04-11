<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mapa con Mapbox</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src='https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.css' rel='stylesheet' />

    <link rel="icon" type="image/png" href="{{ asset('img/logo-02.png') }}">
    <link rel="stylesheet" href="{{ asset('css/proveedor1.css') }}" />
</head>

<body>
    <img src="{{ asset('img/superhero.png') }}" alt="" id="super">
    @yield('contenido')
    <div id="map">
        <a href="{{ route('proveedor2') }}">
            <button class="mover" id="mover">Gestionar Proveedor</button>
        </a>
    </div>
    <form class="d-flex" role="search">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::user()["tipo"]==="rider") {{$rider["nickname"]}} @else {{Auth::user()["nombre"]}} @if (Auth::check()&&Auth::user()["tipo"]==="administrador") {{$administrador["apellidos"]}} @endif @endif
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="logout" href="{{url('/logout')}}">Cerrar sesion</a>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{url('/login')}}">Iniciar Sesion</a>
                    </li>
                @endif
            </ul>
        </form>
    <script src="{{ asset('js/rider.js') }}"></script>
</body>

</html>