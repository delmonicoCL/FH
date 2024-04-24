@extends('layouts.principal1')

    @section('contenido')
        <div class="container mt-5">

            <H2>EDITAR RIDER</H2>

        </div>
        <div class="container mt-4" id="contenedorPrincipal">
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
            <div class="card-body" style="">
                <form action="{{action([App\Http\Controllers\UsuarioController::class,'update'],['usuario'=> $usuario->id,'tipo'=> $usuario->tipo])}}" id="formularioinscripcion" method="POST">
                    @csrf
                    @method('PUT')

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

                    <div class="form-group mt-2">
                        <label for="nombre">ID:</label>
                        <input type="text" class="form-control" id="id" name="Id" value="{{ $usuario->id }}" readonly>
                    </div>

                    <div class="form-group mt-2">
                        <label for="nickname">NickName:</label>
                        <input type="text" class="form-control" id="nickname" name="Nickname" value="{{ $rider->nickname }}">
                        <small id="mensajeValidacionNickname"></small>
                    </div>
                
                    <div class="form-group mt-2">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="Nombre" value="{{ $usuario->nombre }}">
                        <small id="mensajeValidacionNombre"></small>
                    </div>

                    <div class="form-group mt-2">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" id="apellidos" name="Apellidos" value="{{ $rider->apellidos }}">
                        <small id="mensajeValidacionApellidos"></small>
                    </div>

                    <div class="form-group mt-2">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="Email" value="{{ $usuario->email }}">
                        <small id="mensajeValidacionEmail"></small>
                    </div>
                    
                    <div class="form-group mt-2">
                        <label for="telefono">Telefono:</label>
                        <input type="text" class="form-control" id="telefono" name="Telefono" value="{{ $usuario->telefono }}">
                        <small id="mensajeValidacionTelefono"></small>
                    </div>

                    {{-- <div class="form-group mt-2">
                        <label for="telefono">Stock:</label>
                        <input type="text" class="form-control" id="stock" name="Stock" value="{{ $rider->stock_rider }}">
                        <small id="mensajeValidacionStock"></small>
                    </div> --}}

                </form>
            </div>
            <div class="card-footer text-end mt-5">
                <button type="submit" class="btn btn-primary" form="formularioinscripcion" id="aceptar">
                    Aceptar
                </button>
                <a href="{{ url("usuarios")}}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </div>
        <script src="{{asset('js/updateRIDERBladePhp.js')}}"></script>
    @endsection