@extends('layouts.principal1')
    @section("titulo")
    Editar Administrador
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
        <div class="container mt-4">
            <div class="card-header">
                <H2>EDITAR ADMIN</H2>
            </div>
            <div class="card-body" style="">
                <form  action="{{ action([App\Http\Controllers\UsuarioController::class, 'update'], ['usuario' => $usuario->id, 'tipo' =>$usuario->tipo]) }}"        
                id="formularioinscripcion" method="POST">
                    @csrf
                    @method('PUT')

                <!-- Campos del formulario con valores predeterminados del usuario autenticado -->
                    <div class="form-group mt-2">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{$usuario->id}}" readonly>
                    </div>

                    <div class="form-group mt-2">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="Nombre" value="{{$usuario->nombre}}" autofocus>
                    </div>

                    <div class="form-group mt-2">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" name="Apellidos" value="{{$administrador->apellidos}}">
                    </div>

                    <div class="form-group mt-2">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="Email" value="{{$usuario->email}}" autocomplete="true">
                    </div>

                    <div class="form-group mt-2">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" class="form-control" id="telefono" name="Telefono" value="{{$usuario->telefono}}">
                    </div>

                </form>
            </div>
            <div class="card-footer text-end mt-5">
                <button type="submit" class="btn btn-primary" form="formularioinscripcion" id="aceptar">
                    Aceptar
                </button>
                <a href="{{ url('home') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </div>


    @endsection