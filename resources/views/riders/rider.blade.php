<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mapa con Mapbox</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/rider.css') }}" />
        <link href="https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.3.1/mapbox-gl-directions.css" type="text/css">
        <script src="https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.js"></script>
        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.3.1/mapbox-gl-directions.js"></script>
    </head>

    <style>

    /* Estilos personalizados para el modal redondo */
    .modal-contentREDON {
      border-radius: 50%;
      /* background-image: url('https://img.freepik.com/vector-gratis/fondo-marco-comico_79603-1916.jpg');
      background-size: contain;
      background:no-repeat; */
    }

    .modal-dialogREDON {
      width: 400px; /* Tamaño fijo para el modal */
      height: 400px; /* Tamaño fijo para el modal */
      margin: auto;
      border-radius: 50%;
    }

    .modal-bodyREDON {
      padding: 30px; /* Ajusta el relleno según sea necesario */
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .modal-titleREDON {
      margin-bottom: 20px;
    }

    .modal-footerREDON {
      display: flex;
      justify-content: center;
    }
   

  </style>
    <body>
        @yield('contenido')
        <div id="map">
            <img src="{{ asset('img/superhero.png') }}" alt="" id="super">
            <div id="myModal" class="modal-pua">
                <div class="modal-content-pua">
                    <span class="close" id="closeButton">&times;</span>
                    <h2>Crear Pua</h2>
                    <form id="puaForm">
                        <input type="hidden" id="lng" name="lng">
                        <input type="hidden" id="lat" name="lat">
                        <label for="cantidad_de_personas">Cuantas personas hay?:</label><br>
                        <input type="number" id="cantidad_de_personas" name="cantidad_de_personas"><br><br>
                        <div id="riderName"></div><br>
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

        <div id="stockRider">
            <h3>{{ $rider->stock_rider }} Menus</h3>    
        </div>

        <!-- Navbar Inferior -->
        <nav class="navbar-bottom">
            <div class="container text-center d-flex ">
                <div class="navbar-item">
                    <button id="boton-perfil">
                        <img src="{{ asset('img/perfil.png') }}" alt="Perfil" class="img-fluid" />
                    </button>
                </div>
                <div class="navbar-item">
                    <button id="createMarkerButton">
                        <img src="{{ asset('img/crear_pua.png') }}"alt="Crear Pua" class="img-fluid" />
                    </button>
                </div>
                <div class="navbar-item">
                    <button id="boton-reservas">
                        <img src="{{ asset('img/reservas.png') }}" alt="Reservar" class="img-fluid" />
                    </button>
                </div>
                <div class="navbar-item">
                    <button id="boton-historial">
                        <img src="{{ asset('img/historial.png') }}"alt="Historial" class="img-fluid" />
                    </button>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRounded">
                    Modal Redondo
                </button>
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
                        <input type="text" id="estado" name="estado" value="en_curso" hidden>
                        <button type="submit" id="enviarReserva" class="enviarReserva">Enviar Reserva</button>
                    </form>
                </div>
            </div>
            
            {{-- <div class="container text-center d-flex ">
                <div class="navbar-item">
                    <button id="boton-perfil">
                        <img src="{{ asset('img/perfil.png') }}" alt="Stock" class="img-fluid" />
                    </button>
                </div>
            </div> --}}

            {{-- Modal Perfil --}}
            <div class="modal-perfil" id="modal-perfil">
                <div class="modal-content-perfil modal-lg mt-3">
                    <div class="modal-content px-5 pt-3 pb-3">
                        <div class="row">
                            <div class="col-lg-12 contact-form">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <div class="text-end">
                                            <span class="close" id="closeButtonPerfil">&times;</span>
                                        </div>
                                        <div class="card-title text-center pb-3">
                                            <h3>PERFIL</h3>
                                            <p class="lead text-muted fw-light">Información de usuario.</p>
                                        </div>
                                        <form action="{{ action([App\Http\Controllers\UsuarioController::class, 'update'], ['usuario' => $user->id, 'tipo' => $user->tipo]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <h4>Nombre</h4>
                                                        <input type="text" class="form-control" name="nombre" value="{{ $user->nombre }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <h4>Correo</h4>
                                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <h4>Teléfono</h4>
                                                        <input type="text" class="form-control" name="telefono" value="{{ $user->telefono }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary" id="editarPerfil">Editar</button>
                                                <button type="submit" class="btn btn-primary" style="display:none;">Guardar cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form id="updateForm" action="{{ action([App\Http\Controllers\UsuarioController::class, 'update'], ['usuario' => $user->id, 'tipo' => $user->tipo]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="text-center">
                            <h4>Nombre</h4>
                            <input type="text" class="form-control" name="nombre" value="{{ $user->nombre }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center">
                            <h4>Correo</h4>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="text-center">
                            <h4>Teléfono</h4>
                            <input type="text" class="form-control" name="telefono" value="{{ $user->telefono }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-primary" id="editarPerfil">Editar</button>
                    <button type="submit" class="btn btn-primary" style="display:none;">Guardar cambios</button>
                </div>
            </form>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('editarPerfil').addEventListener('click', function() {
                        // Oculta el modal de perfil
                        document.getElementById('modal-perfil').style.display = 'none';
                        // Muestra el formulario de actualización
                        document.getElementById('updateForm').style.display = 'block';
                    });
                });
            </script>
            
           <!-- Modal Reservas -->
            <div id="modal-reservas" class="modal-reservas">
                <div class="modal-content-reservas modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">RESERVAS</h2>
                            <span class="close" id="closeButtonReservas">&times;</span>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive" style="display: flex; justify-content: center !important; align-items: center !important;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>PROVEEDOR</th>
                                            <th>RESERVAS</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @for ($i = 0; $i < count($reservas); $i++)
                                            <tr>
                                                <td>{{ $reservas[$i]->nombre }}</td>
                                                <td>{{ $reservas[$i]->cantidad }}</td>
                                            </tr>
                                        @endfor --}}
                                        @foreach ($reservas as $reserva)
                                            <tr>
                                                <td>{{ $reserva->nombre_proveedor }}</td>
                                                <td>{{ $reserva->cantidad }}</td>
                                                <td>
                                                    <input type="button" data-latitud="{{$reserva->latitud}}" data-longitud="{{$reserva->longitud}}" value="Marcar ruta" id="botonMarcarRuta">
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
            <!-- Modal Historial -->    
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
             <!-- Modal Redondo -->  

            <div class="modal fade" id="modalRounded" tabindex="-1" aria-labelledby="modalRoundedLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialogREDON">
                <div class="modal-content modal-contentREDON">
                <div class="modal-header">
                    <h2 class="modal-titleREDON " id="modalRoundedLabel">HISTORIAL</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-bodyREDON">
                    <h2>PUAS CREADAS</h2>
                    <p>2</p>
                    <p>¡Este es un modal redondo!</p>
                    <p>Aquí puedes agregar cualquier contenido que desees.</p>
                </div>
                <div class="modal-footer modal-footerREDON">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
            </div>


        </div> 



        <script src="{{ asset('js/rider.js') }}"></script>
        <!-- Bootstrap JS y dependencias -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    </body>
</html>
