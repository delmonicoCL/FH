@if($tipo!=="rider"&&$tipo!=="proveedor")
    @php
        header("Location:../registros/elige_tipo_de_usuario");
        exit(); 
    @endphp
@else
    @extends('layouts.principal')
        @section("titulo")
            Inscribir {{$tipo}}
        @endsection
        @section("paginaAnterior")
            {{url("/registros/elige_tipo_de_usuario")}}
        @endsection
        @section('contenido')
            <div class="col-sm-12 col-md-6" id="contenedorPrincipal" style="display:flex; align-items: center; justify-content: center;">
                @if($tipo==="rider")
                    <div class="modal fade" tabindex="-1" id="modalCambiarAvatar">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header" style="display:flex; justify-content: center;">
                                    <div class="row" style="text-align: center;">
                                        <h5 class="modal-title" id="tituloModalMostrarFollowing" style="font-weight: bold;">Elige un avatar</h5>
                                    </div>
                                </div>
                                <div class="modal-body" style="height: 350px; overflow-y: auto;">
                                    <div class="row" id="contenedorAvatares"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card w-75 rounded-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="h6">
                                    Bienvenidos a Food Hero
                                </p>
                                <p class="h1">
                                    Inscribir {{$tipo}}
                                </p>
                            </div>
                        </div>
                        @if($tipo==="proveedor") <small id="mensajeValidacionFormularioCrearProveedor"></small> @else <small id="mensajeValidacionFormularioCrearRider"></small> @endif
                    </div>
                    <div class="card-body" style="height: 455px; overflow-y: auto;">
                        <form action="{{action([App\Http\Controllers\UsuarioController::class,'store'])}}" class="row" method="POST" id="formularioinscripcion" enctype="multipart/form-data">  
                            @csrf

                            @if($tipo==="rider")
                                @php
                                    $listaAvatares=json_encode($listaAvatares);
                                @endphp
                                <div class="col-sm-12 mb-3 text-center">
                                    <img src="{{asset('media/img/avatares/avatar1.png')}}" alt="imagen avatar" height="150vh" width="150vw" id="imagenAvatar" data-avatares="{{$listaAvatares}}" data-bs-toggle="modal" data-bs-target="#modalCambiarAvatar" style="border:2px solid #018780; box-shadow: 0 0 20px 2px #018780;">
                                </div>

                                <div hidden>
                                    <label for="avatar">
                                        Avatar
                                    </label>
                                    <input type="text" id="avatar" name="Avatar" readonly>
                                </div>

                                <label for="nickname" class="col-sm-2 col-form-label" hidden>
                                    Nickname
                                </label>
                                <div class="col-sm-12 mb-3">
                                    <input type="text" id="nickname" class="form-control" name="Nickname" placeholder="Nickname" autofocus>
                                    <small id="mensajeValidacionNickname"></small>
                                </div>

                            @endif


                            <label @if($tipo==="proveedor") for="nombreEmpresa" @else for="nombre" @endif class="col-sm-2 col-form-label" hidden>
                                Nombre @if($tipo==="proveedor") {{"empresa"}} @endif
                            </label>
                            <div class="col-sm-12 mb-3">
                                <input type="text" @if($tipo==="proveedor") id="nombreEmpresa" @else id="nombre" @endif class="form-control" @if($tipo==="proveedor") name="NombreEmpresa" @else name="Nombre" @endif @if($tipo!=="rider") autofocus @endif @if($tipo==="proveedor") placeholder="Nombre empresa" @else placeholder="Nombre" @endif>
                                @if($tipo==="proveedor") <small id="mensajeValidacionNombreEmpresa"></small> @else <small id="mensajeValidacionNombre"></small> @endif 
                            </div>


                            @if ($tipo==="rider")
                                <label for="apellidos" class="col-sm-2 col-form-label" hidden>
                                    Apellidos
                                </label>
                                <div class="col-sm-12 mb-3">
                                    <input type="text" id="apellidos" class="form-control" name="Apellidos" placeholder="Apellidos">
                                    <small id="mensajeValidacionApellidos"></small>
                                </div>
                            @endif


                            <label for="contrasenia" class="col-sm-2 col-form-label" hidden>
                                Contraseña
                            </label>
                            <div class="col-sm-12 mb-3">
                                <input type="password" id="contrasenia" class="form-control" name="Contrasenia" placeholder="Contraseña">
                                <small id="mensajeValidacionContrasenia"></small>
                            </div>


                            <label for="contrasenia" class="col-sm-2 col-form-label" hidden>
                                Confirmar contraseña
                            </label>
                            <div class="col-sm-12 mb-3">
                                <input type="password" id="confirmarContrasenia" class="form-control" name="ConfirmarContrasenia" placeholder="Confirmar contraseña">
                                <small id="mensajeValidacionConfirmarContrasenia"></small>
                            </div>


                            <label for="email" class="col-sm-2 col-form-label" hidden>
                                Email
                            </label>
                            <div class="col-sm-12 mb-3">
                                <input type="email" id="email" class="form-control" name="Email" placeholder="Email">
                                <small id="mensajeValidacionEmail"></small>
                            </div>


                            <div hidden>
                                <label for="tipo">
                                    Tipo
                                </label>
                                <div class="col-sm-12 mb-3">
                                    <input type="text" id="tipo" name="Tipo" value="{{$tipo}}" readonly>
                                </div>
                            </div>


                            <label for="telefono" class="col-sm-2 col-form-label" hidden>
                                Teléfono
                            </label>
                            <div @if($tipo==="rider") class="col-sm-12" @else class="col-sm-12 mb-3" @endif>
                                <input type="tel" id="telefono" class="form-control" name="Telefono" placeholder="Teléfono">
                                <small id="mensajeValidacionTelefono"></small>
                            </div>

                            @if ($tipo==="proveedor")


                                <label for="calle" class="col-sm-2 col-form-label" hidden>
                                    Calle
                                </label>
                                <div class="col-sm-12 mb-3">
                                    <input type="text" id="calle" class="form-control" name="Calle" placeholder="Calle">
                                    <small id="mensajeValidacionCalle"></small>
                                </div>


                                <label for="numero" class="col-sm-2 col-form-label" hidden>
                                    Edificio (Numero)
                                </label>
                                <div class="col-sm-12 mb-3">
                                    <input type="number" id="numero" class="form-control" name="Numero" placeholder="Edificio (Numero)">
                                    <small id="mensajeValidacionNumero"></small>
                                </div>


                                <label for="cp" class="col-sm-2 col-form-label" hidden>
                                    Cp
                                </label>
                                <div class="col-sm-12 mb-3">
                                    <input type="number" id="cp" class="form-control" name="Cp" placeholder="Cp">
                                    <small id="mensajeValidacionCp"></small>
                                </div>


                                <label for="ciudad" class="col-sm-2 col-form-label" hidden>
                                    Ciudad
                                </label>
                                <div class="col-sm-12 mb-3">
                                    <input type="text" id="ciudad" class="form-control" name="Ciudad" placeholder="Ciudad">
                                    <small id="mensajeValidacionCiudad"></small>
                                </div>


                                <label for="logo" class="col-sm-2 col-form-label" hidden>
                                    Logo
                                </label>
                                <div class="col-sm-12 mb-3">
                                    <small style="color:red;">
                                        Seleccione un logo
                                    </small>
                                    <input type="file" id="logo" class="form-control" name="Logo" required>
                                </div>


                            @endif
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="row mb-3 mt-3 text-end">
                            <div class="col-sm-12">
                                <button type="submit" class="btn float-right col-sm-12 text-light" form="formularioinscripcion" id="aceptar" style="background-color: #00AEEF; box-shadow: 0 0 10px 2px #868b8d;">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    Inscribir {{$tipo}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($tipo==="rider")
                <script src="{{asset('js/usuarioBladePhpRider.js')}}"></script>
            @elseif($tipo==="proveedor")
                <script src="{{asset('js/usuarioBladePhpProveedor.js')}}"></script>
            @endif
        @endsection
@endif