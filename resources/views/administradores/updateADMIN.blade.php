@extends('layouts.principal1')

@section('contenido')


<div class="container mt-5">

    <H2>EDITAR ADMIN</H2>

</div>

<div class="container mt-4">
    <div class="card-body" style="">
        <form  action="{{ action([App\Http\Controllers\UsuarioController::class, 'update'], ['usuario' => Auth::user()->id, 'tipo' =>"administrador"]) }}"        
        id="formularioinscripcion" method="POST">
            @csrf
            @method('PUT')

           <!-- Campos del formulario con valores predeterminados del usuario autenticado -->
            <div class="form-group mt-2">
                <label for="id">ID:</label>
                <input type="text" class="form-control" id="id" name="id" value="{{ Auth::user()->id }}" readonly>
            </div>

            <div class="form-group mt-2">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ Auth::user()->nombre }}">
            </div>

            <div class="form-group mt-2">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
            </div>

            <div class="form-group mt-2">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ Auth::user()->telefono }}">
            </div>

      {{-- <div class="form-group mt-2">
                <label for="contraseña">Contraseña:</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña"value="{{ Auth::user()->contrasenia }}">
            </div>  --}}

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


@endsection 

