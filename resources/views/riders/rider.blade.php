<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FoodHero</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/rider.css')}}" />
        <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon">
        <link href="https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/luckiest-guy" rel="stylesheet">
        <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.3.1/mapbox-gl-directions.css" type="text/css">
        <script src="https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.js"></script>
        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.3.1/mapbox-gl-directions.js"></script>
    </head>
    <style>
        h4,
        h5,
        h2 {
            font-family: 'Luckiest Guy', cursive;
            /* Usa la fuente 'Luckiest Guy' */
        }
        
        td{
        font-family: 'Luckiest Guy', cursive;
        }
    
        /* Estilos personalizados para el modal redondo */
        .modal-contentREDON {
            border-radius: 50%;
        background-image: url('https://img.freepik.com/vector-gratis/fondo-marco-comico_79603-1916.jpg');
          background-size: cover;*/
        }
    
        .modal-dialogREDON {
            width: 400px;
            /* Tamaño fijo para el modal */
            height: 400px;
            /* Tamaño fijo para el modal */
            margin: auto;
            border-radius: 50%;
        }
    
        .modal-bodyREDON {
            padding: 35px;
            /* Ajusta el relleno según sea necesario */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    
        .modal-bodyREDON1 {
            padding: 0px;
            /* Ajusta el relleno según sea necesario */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    
        .modal-titleREDON {
            margin-bottom: 20px;
            text-align: center;
            /* Centra el texto horizontalmente */
            margin: 0 auto;
            /* Centra el elemento dentro de su contenedor */
        }
    
        .modal-footerREDON {
            display: flex;
            justify-content: center;
            border-color: none !important; 
        }

        .modal-header {
            border-color: none !important; 
        }

        .modal-footer {
            border-color: none !important; 
        }

        .btn-unstyled {
        border: none;
        background-color: transparent;
        padding: 0;
        cursor: pointer;
        }

    </style>
    <body id="contenedorPrincipal">
        @yield('contenido')
        <div id="map">
            <img src="{{asset('media/img/avatares')}}{{'/'.$rider->avatar}}" id="super" alt="imagen avatar" height="150vh" width="150vw" draggable="false">

            {{-- MODAL CREA PUA --}}
            <div id="myModal" class="modal-pua">
                <div class="modal-content-pua">
                    <span class="close" id="closeButton">&times;</span>
                    <h2>Crear Pua</h2>
                    <form id="puaForm">
                        <input type="hidden" id="lng" name="lng">
                        <input type="hidden" id="lat" name="lat">
                        <label for="cantidad_de_personas">Cuantas personas hay?:</label><br>
                        <input type="number" id="cantidad_de_personas" name="cantidad_de_personas"><br><br>
                        <button type="button" id="submitForm">Crear Pua</button>
                    </form>
                </div>
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
        </div>

        <!-- Navbar Inferior -->
        <nav class="navbar-bottom">
            <div class="container text-center d-flex ">
                <div class="navbar-item">
                    <button id="boton-perfil">
                        <img src="{{ asset('img/perfil.png') }}" alt="Perfil" class="img-fluid" draggable="false"/>
                    </button>
                </div>
                <div class="navbar-item">
                    <button id="createMarkerButton">
                        <img src="{{ asset('img/crear_pua.png') }}"alt="Crear Pua" class="img-fluid" draggable="false"/>
                    </button>
                </div>
                <div class="navbar-item">
                    <button id="boton-reservas">
                        <img src="{{ asset('img/reservas.png') }}" alt="Reservar" class="img-fluid" draggable="false"/>
                    </button>
                </div>
                <div class="navbar-item">
                    <button id="boton-historial" class="btn btn-unstyled" data-bs-toggle="modal" data-bs-target="#modalRounded">
                        <img src="{{ asset('img/historial.png') }}"alt="Historial" class="img-fluid" draggable="false"/>
                    </button>
                </div>
                
            </div>
        </nav>

        <!-- Modal de reservar -->
        <div id="modal-reservar" class="modal-reservar">
            <div class="modal-content-reservar modal-lg">
                <span class="close" id="closeButtonReservar">&times;</span>
                <h2>Reservar Comida</h2>
                <form id="reservar-form" action="{{action([App\Http\Controllers\ReservaController::class,'store'])}}" method="POST">
                    @csrf
                    <label for="cantidad">Cuantos quieres reservar?:</label>
                    <input type="number" id="cantidad" name="cantidad"><br><br>
                    <input type="text" id="proveedor" name="proveedor" value="" hidden>
                    <input type="text" id="rider" name="rider" value={{$rider["id"]}} hidden>
                    <button type="submit" class="btn btn-success" id="enviarReserva" class="enviarReserva">Enviar Reserva</button>
                </form>
            </div>
        </div>

        <div class="modal-perfil" id="modal-perfil">
            <div class="modal-content-perfil modal-lg">
                <div class="modal-content">
                    <div class="card" style="height: 455px;">
                        <div class="card-header">
                            <div class="text-end">
                                <span class="close" id="closeButtonPerfil">&times;</span>
                            </div>
                            <div class="card-title text-center">
                                <h3>
                                    PERFIL
                                </h3>
                                <p class="lead text-muted fw-light">
                                    Información de rider.
                                </p>
                            </div>
                        </div>
                        <div class="card-body" style="height: 300px; overflow-y: auto;">
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <img src="{{asset('media/img/avatares')}}{{'/'.$rider->avatar}}" alt="imagen avatar" height="150vh" width="150vw" draggable="false">
                                </div>

                                <p class="col-sm-12 text-center">
                                    <strong>
                                        Nickname:
                                    </strong>
                                      {{$rider->nickname}}
                                </p>

                                <p class="col-sm-12 text-center">
                                    <strong>
                                        Menus:
                                    </strong>
                                      {{$rider->stock_rider}}
                                </p>

                                <p class="col-sm-12 text-center">
                                    <strong>
                                        Nombre:
                                    </strong>
                                      {{$user->nombre}}
                                </p>

                                <p class="col-sm-12 text-center">
                                    <strong>
                                        Apellidos:
                                    </strong>
                                      {{$rider->apellidos}}
                                </p>

                                <p class="col-sm-12 text-center">
                                    <strong>
                                        Correo:
                                    </strong>
                                      {{$user->email}}
                                </p>

                                <p class="col-sm-12 text-center">
                                    <strong>
                                        Teléfono:
                                    </strong>
                                      {{$user->telefono}}
                                </p>

                                <p id="idRider" hidden>{{$rider->id}}</p>

                                <p id="stockRider" hidden>{{$rider->stock_rider}}</p>

                                <div class="col-sm-12 mb-3">
                                    <button type="button" class="btn btn-primary" id="editarPerfil">
                                        Editar
                                    </button>
                                </div>
                                <div class="col-sm-12">
                                    <a class="btn btn-danger" href="{{url('/logout')}}">
                                        Cerrar sesion
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-editar-perfil" id="modal-editar-perfil" style="display: none;">
            <div class="modal-content-perfil modal-lg">
                <div class="modal-content">
                    <div class="card" style="height: 455px;">
                        <div class="card-header">
                            <div class="text-end">
                                <span class="close" id="closeButtonEditarPerfil">&times;</span>
                            </div>
                            <div class="card-title text-center">
                                <h3>
                                    EDITAR PERFIL
                                </h3>
                                <p class="lead text-muted fw-light">
                                    Modifica tu información de rider.
                                </p>
                                <small id="mensajeValidacionFormularioActualizarRider"></small>
                            </div>
                        </div>
                        <div class="card-body" style="height: 300px; overflow-y: auto;">
                            <form class="row" action="{{action([App\Http\Controllers\UsuarioController::class,'update'],['usuario'=>$user->id,'tipo'=>$user->tipo,'tipoDeUsuarioQueEstaRealizandoLaEdicionDeRider'=>'rider'])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-sm-12 mb-3">
                                    @php
                                        $listaAvatares=json_encode($listaAvatares);
                                    @endphp
                                    <img src="{{asset('media/img/avatares')}}{{'/'.$rider->avatar}}" alt="imagen avatar" height="150vh" width="150vw" id="imagenAvatar" data-avatares="{{$listaAvatares}}" data-usuarioQueEditaAlRider="rider" style="border:2px solid #018780; box-shadow: 0 0 20px 2px #018780;" draggable="false">
                                </div>
                                <div hidden>
                                    <label for="avatar">
                                        Avatar
                                    </label>
                                    <input type="text" id="avatar" name="Avatar" value="{{$rider->avatar}}">
                                </div>

                                <label for="nickname" class="col-sm-3" style="display:flex; align-items: center; justify-content:center;">
                                    <strong>
                                        Nickname:
                                    </strong>
                                </label>
                                <div class="col-sm-9" style="display:flex; align-items: center; justify-content: center;">
                                    <input type="text" class="form-control" id="nickname" name="Nickname" value="{{$rider->nickname}}">
                                </div>
                                <div class="col-sm-3"></div>
                                <small id="mensajeValidacionNickname" class="col-sm-9 mb-3"></small>

                                <label for="nombre" class="col-sm-3" style="display:flex; align-items: center; justify-content:center;">
                                    <strong>
                                        Nombre:
                                    </strong>
                                </label>
                                <div class="col-sm-9" style="display:flex; align-items: center; justify-content: center;">
                                    <input type="text" class="form-control" id="nombre" name="Nombre" value="{{$user->nombre}}">
                                </div>
                                <div class="col-sm-3"></div>
                                <small id="mensajeValidacionNombre" class="col-sm-9 mb-3"></small>
                                
                                <label for="apellidos" class="col-sm-3" style="display:flex; align-items: center; justify-content:center;">
                                    <strong>
                                        Apellidos:
                                    </strong>
                                </label>
                                <div class="col-sm-9" style="display:flex; align-items: center; justify-content: center;">
                                    <input type="text" class="form-control" id="apellidos" name="Apellidos" value="{{$rider->apellidos}}">
                                </div>
                                <div class="col-sm-3"></div>
                                <small id="mensajeValidacionApellidos" class="col-sm-9 mb-3"></small>

                                <label for="email" class="col-sm-3" style="display:flex; align-items: center; justify-content:center;">
                                    <strong>
                                        Correo:
                                    </strong>
                                </label>
                                <div class="col-sm-9" style="display:flex; align-items: center; justify-content: center;">
                                    <input type="text" class="form-control" id="email" name="Email" value="{{$user->email}}">
                                </div>
                                <div class="col-sm-3"></div>
                                <small id="mensajeValidacionEmail" class="col-sm-9 mb-3"></small>

                                <label for="telefono" class="col-sm-3" style="display:flex; align-items: center; justify-content:center;">
                                    <strong>
                                        Teléfono:
                                    </strong>
                                </label>
                                <div class="col-sm-9" style="display:flex; align-items: center; justify-content: center;">
                                    <input type="text" class="form-control" id="telefono" name="Telefono" value="{{$user->telefono}}">
                                </div>
                                <div class="col-sm-3"></div>
                                <small id="mensajeValidacionTelefono" class="col-sm-9 mb-3"></small>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" id="aceptar">Guardar cambios</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- Modal Reservas -->
        <div id="modal-reservas" class="modal-reservas ">
            <div class="modal-content-reservas modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title ms-4">RESERVAS</h2>
                        <span class="close" id="closeButtonReservas">&times;</span>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive" style="display: flex; justify-content: center !important; align-items: center !important;">
                            <table class="table table-bordered">
                                <thead style="background-color: rgb(226, 43, 43); color: white;">
                                    <tr>
                                        <th><h5>PROVEEDOR</h5></th>
                                        <th><h5>RESERVAS</h5></th>
                                        <th><h5>RUTA</h5></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservas as $reserva)
                                        <tr>
                                            <td>{{ $reserva->nombre_proveedor }}</td>
                                            <td>{{ $reserva->cantidad }}</td>
                                            <td>
                                                <input type="button" class="btn btn-warning botonMarcarRuta" data-latitud="{{$reserva->latitud}}" data-longitud="{{$reserva->longitud}}" value="Marcar ruta">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
             
        {{-- MODAL HISTORIAL --}}
        <div class="modal-historial" id="modal-historial">
            <div class="modal-content-historial modal-lg mt-3">
                <div class="modal-content px-5 pt-3 pb-3">
                    <div class="row">
                        <div class="col-lg-12 contact-form">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="text-end">
                                    <span class="close" id="closeButtonHistorial">&times;</span>
                                    </div>
                                    <div class="card-title text-center pb-3">
                                        <h3>HISTORIAL</h3>
                                        <p class="lead text-muted fw-light">Descubre el historial de tus puas.</p>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <h4>PUAS CREADAS</h4>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <p class="lead m-0">12</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <h4>MENÚS ENTREGADOS</h4>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <p class="lead m-0">5</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <h4>RESERVAS ACTUALES</h4>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    {{-- <p class="lead m-0">{{ $num_reservas_activas }}</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <h4>RANKING</h4>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <p class="lead m-0">5</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        {{-- MODAL HISTORIAL REDONDO --}}
        <div class="modal fade" id="modalRounded" tabindex="-1" aria-labelledby="modalRoundedLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialogREDON">
                <div class="modal-content modal-contentREDON">
                    <div class="modal-header">
                        <h2 class="modal-titleREDON " id="modalRoundedLabel">HISTORIAL</h2>
                    </div>
                    <div class="modal-body modal-bodyREDON">
                        <div class="row">
                            <div class="col">
                                <h4 class="d-inline-block">PUAS CREADAS</h4>
                                <h2 class="d-inline-block ml-2">{{ $totalPuas }}</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h4 class="d-inline-block">RESERVAS</h4>
                                <h2 class="d-inline-block ml-2">{{ $totalReservas }}</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h4 class="d-inline-block">ENTREGAS</h4>
                                <h2 class="d-inline-block ml-2">{{ $totalEntregas }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer modal-footerREDON">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-avatares" class="modal-avatares">
            <div class="modal-content-avatares modal-lg">
                <div class="modal-content" style="height: 455px;">
                    <div class="card" style="height: 455px;">
                        <div class="card-header">
                            <div class="text-end">
                                <span class="close" id="closeButtonAvatares">&times;</span>
                            </div>
                            <div class="card-title text-center">
                                <h3 class="modal-title">
                                    AVATARES
                                </h3>
                                <p class="lead text-muted fw-light">
                                    Modifica tu información de rider.
                                </p>
                                <small id="mensajeValidacionFormularioActualizarRider"></small>
                            </div>
                        </div>
                        <div class="card-body" style="height: 300px; overflow-y: auto;">
                            <div class="row" id="contenedorAvatares"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <script src="{{asset('js/validacionesEditarRider.js')}}"></script>

    <script src="{{ asset('js/rider.js') }}"></script>

    <!-- JavaScript de Bootstrap (Requiere jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery (Necesario para el JavaScript de Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</html>