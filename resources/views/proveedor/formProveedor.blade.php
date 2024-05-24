@extends('layouts.proveedor.formProveedor')
    @section('titulo')
        Editar Proveedor
    @endsection
    @section('contenido')
        {{-- <pre>
                @php
                    print_r($usuario);
                @endphp
            </pre>
            <pre>
                @php
                    print_r($proveedor);
                @endphp
            </pre> --}}

        <div class="titulo">
            <h2>Edita tu información</h2>
        </div>

        <div class="contenidoBody">
            <div class="decoracion">
                <img src="{{ asset('img/superhero.png') }}" alt="superhero.png">
            </div>

            <div class="formulario">
                <div class="card" id="contenedorPrincipal">
                    <div class="card-body">
                        <div class="text-center">
                            <p id="mensajeValidacionFormularioActualizarProveedor"></p>
                        </div>
                        <form action="{{ action([App\Http\Controllers\UsuarioController::class, 'update'], ['usuario' => $usuario->id, 'tipo' => $usuario->tipo,'tipoDeUsuarioQueEstaRealizandoLaEdicionDeProveedor'=>'proveedor'])}}" id="formularioinscripcion" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
        
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
                        <div class="text-end">
                            <button type="button" class="btn btn-primary" id="falsoBotonSubmit">
                                Aceptar
                            </button>
                            <a href="{{ url('/proveedor2') }}" class="btn btn-danger">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{asset('js/validacionesEditarProveedor.js')}}"></script>
    @endsection