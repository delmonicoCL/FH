@extends('layouts.principal1')
    @section("titulo")
        Editar Proveedor
    @endsection
    @section("apellidos")
        {{$administrador->apellidos}}
    @endsection
    @section("editarAdministrador")
        <form action="{{action([App\Http\Controllers\UsuarioController::class,'edit'],['usuario'=>Auth::user(),'tipo'=>Auth::user()->tipo,"idAdministrador"=>$administrador->id])}}"  method="POST">
            @method('GET')
            <input class="dropdown-item" type="submit" value="Actualizar perfil">
        </form>
    @endsection
    @section('contenido')
        <div class="container mt-4" id="contenedorPrincipal">
            <div class="card-header">
                <H2>EDITAR PROVEEDOR</H2>
                <small id="mensajeValidacionFormularioActualizarProveedor"></small>
            </div>
            <div class="card-body">
                <form action="{{ action([App\Http\Controllers\UsuarioController::class, 'update'], ['usuario' => $usuario->id, 'tipo' => $usuario->tipo,'tipoDeUsuarioQueEstaRealizandoLaEdicionDeProveedor'=>'administrador']) }}" id="formularioinscripcion" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mt-2">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" id="id" name="Id" value="{{ $usuario->id }}" readonly>
                    </div>

                    <div class="form-group mt-2">
                        <label for="nombreEmpresa">Nombre Empresa:</label>
                        <input type="text" class="form-control" id="nombreEmpresa" name="NombreEmpresa" value="{{ $usuario->nombre }}" autofocus>
                        <small id="mensajeValidacionNombreEmpresa"></small>
                    </div>

                    <div class="form-group mt-2">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="Email" value="{{ $usuario->email }}" autocomplete="true">
                        <small id="mensajeValidacionEmail"></small>
                    </div>

                    <div class="form-group mt-2">
                        <label for="telefono">Telefono:</label>
                        <input type="tel" class="form-control" id="telefono" name="Telefono" value="{{ $usuario->telefono }}">
                        <small id="mensajeValidacionTelefono"></small>
                    </div>

                    <div class="form-group mt-2">
                        <label for="calle">Calle:</label>
                        <input type="text" class="form-control" id="calle" name="Calle" value="{{ $proveedor->calle }}">
                        <small id="mensajeValidacionCalle"></small>
                    </div>

                    <div class="form-group mt-2">
                        <label for="numero">Numero:</label>
                        <input type="number" class="form-control" id="numero" name="Numero" value="{{ $proveedor->numero }}">
                        <small id="mensajeValidacionNumero"></small>
                    </div>

                    <div class="form-group mt-2">
                        <label for="cp">CP:</label>
                        <input type="number" class="form-control" id="cp" name="Cp" @if(strlen($proveedor->cp)===4) value="{{'0'.$proveedor->cp}}" @else value="{{$proveedor->cp}}" @endif>
                        <small id="mensajeValidacionCp"></small>
                    </div>

                    <div class="form-group mt-2">
                        <label for="ciudad">Ciudad:</label>
                        <input type="text" class="form-control" id="ciudad" name="Ciudad" value="{{ $proveedor->ciudad }}">
                        <small id="mensajeValidacionCiudad"></small>
                    </div>

                    <div class="form-group mt-2">
                        <label for="logo">Logo:</label>
                        <input type="file" id="logo" class="form-control" name="Logo">
                    </div>

                    <div hidden>
                        <label for="latitud">
                            Latitud
                        </label>
                        <div>
                            <input type="text" id="latitud" name="Latitud" readonly>
                        </div>
            
                        <label for="longitud">
                            Longitud
                        </label>
                        <div>
                            <input type="text" id="longitud" name="Longitud" readonly>
                        </div>
                    </div>

                    <input type="submit" id="verdaderoBotonSubmit" hidden>
                </form>
            </div>
            <div class="card-footer text-end mt-5">
                <button type="button" class="btn btn-primary" id="falsoBotonSubmit">
                    Aceptar
                </button>
                <a href="{{ url('/administradores/gestionProveedor') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </div>
        <script src="{{asset('js/validacionesEditarProveedor.js')}}"></script>
    @endsection