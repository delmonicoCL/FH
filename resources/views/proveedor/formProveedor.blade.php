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
            <div class="card">
                <div class="card-body">
                    <form
                        action="{{ action([App\Http\Controllers\UsuarioController::class, 'update'], ['usuario' => $usuario->id, 'tipo' => $usuario->tipo]) }}"
                        id="formularioinscripcion" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="labelID" class="form-label">ID:</label>
                            <input type="number" class="form-control" id="labelID" name="id"
                                value="{{ $proveedor->id }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="labelNombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="labelNombre" name="nombre"
                                value="{{ $usuario->nombre }}">
                        </div>

                        <div class="mb-3">
                            <label for="labelCalle" class="form-label">Calle:</label>
                            <input type="text" class="form-control" id="labelCalle" name="calle"
                                value="{{ $proveedor->calle }}">
                        </div>

                        <div class="mb-3">
                            <label for="labelNumero" class="form-label">Número:</label>
                            <input type="number" class="form-control" id="labelNumero" name="numero"
                                value="{{ $proveedor->numero }}">
                        </div>

                        <div class="mb-3">
                            <label for="labelCP" class="form-label">CP:</label>
                            <input type="number" class="form-control" id="labelCP" name="cp"
                                value="{{ $proveedor->cp }}">
                        </div>

                        <div class="mb-3">
                            <label for="labelCiudad" class="form-label">Ciudad:</label>
                            <input type="text" class="form-control" id="labelCiudad" name="ciudad"
                                value="{{ $proveedor->ciudad }}">
                        </div>

                        {{-- <div class="mb-3">
                            <label for="labelLogo" class="form-label">Logo:</label>
                            <input type="file" class="form-control" id="labelLogo" name="logo" readonly>
                        </div> --}}

                        <div class="mb-3">
                            <label for="labelEmail" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="labelEmail" name="email"
                                value="{{ $usuario->email }}">
                        </div>

                        <div class="mb-3">
                            <label for="labelTel" class="form-label">Teléfono:</label>
                            <input type="tel" class="form-control" id="labelTel" name="telefono"
                                value="{{ $usuario->telefono }}">
                        </div>

                        <div class="mb-3">
                            <label for="labelStok" class="form-label">Stok:</label>
                            <input type="number" class="form-control" id="labelStok" name="stock"
                                value="{{ $proveedor->stock_proveedor }}" readonly>
                        </div>

                        <div class="botones mb-3">
                            <button type="submit" class="btn btn-primary">Aceptar</button>
                            <a href="{{ url('proveedor2') }}" class="btn btn-danger">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
