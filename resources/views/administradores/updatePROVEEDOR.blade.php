@extends('layouts.principal1')

@section('contenido')
    <div class="container mt-5">

        <H2>EDITAR PROVEEDOR</H2>

    </div>

    <div class="container mt-4">

        <div class="card-body" style="">
            <form
                action="{{ action([App\Http\Controllers\UsuarioController::class, 'update'], ['usuario' => $usuario->id, 'tipo' => $usuario->tipo]) }}"
                id="formularioinscripcion" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mt-2">
                    <label for="nombre">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $usuario->id }}"
                        readonly>
                </div>

                <div class="form-group mt-2">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $usuario->nombre }}">
                </div>

                <div class="form-group mt-2">
                    <label for="apellido">Calle:</label>
                    <input type="text" class="form-control" id="calle" name="calle"
                        value="{{ $proveedor->calle }}">
                </div>

                <div class="form-group mt-2">
                    <label for="apellido">Numero:</label>
                    <input type="text" class="form-control" id="numero" name="numero"
                        value="{{ $proveedor->numero }}">
                </div>

                <div class="form-group mt-2">
                    <label for="apellido">CP:</label>
                    <input type="text" class="form-control" id="cp" name="cp" value="{{ $proveedor->cp }}">
                </div>

                <div class="form-group mt-2">
                    <label for="apellido">Ciudad:</label>
                    <input type="text" class="form-control" id="ciudad" name="ciudad"
                        value="{{ $proveedor->ciudad }}">
                </div>

                <div class="form-group mt-2">
                    <label for="apellido">Logo:</label>
                    <input type="text" class="form-control" id="logo" name="logo" value="{{ $proveedor->logo }}">
                </div>

                <div class="form-group mt-2">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}">
                </div>

                <div class="form-group mt-2">
                    <label for="telefono">Telefono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono"
                        value="{{ $usuario->telefono }}">
                </div>


                <div class="form-group mt-2">
                    <label for="telefono">Stock:</label>
                    <input type="text" class="form-control" id="stock" name="stock"
                        value="{{ $proveedor->stock_proveedor }}">
                </div>



            </form>
        </div>

        <div class="card-footer text-end mt-5">
            <button type="submit" class="btn btn-primary" form="formularioinscripcion" id="aceptar">
                Aceptar
            </button>
            <a href="{{ url('usuarios') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </div>


    </div>
@endsection
