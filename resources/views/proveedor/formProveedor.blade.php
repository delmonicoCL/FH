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

    <div class="formulario">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edita tu información</h5>
                <form>
                    {{-- action="{{ action([App\Http\Controllers\ProveedorController::class, 'update'], ['proveedore' => $proveedore]) }}"
                    method="POST"> --}}
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="labelID" class="form-label">ID:</label>
                        <input type="number" class="form-control" id="labelID" name="labelID" value="{{ $proveedor->id }}"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label for="labelNombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="labelNombre" name="labelNombre"
                            value="{{ $usuario->nombre }}">
                    </div>

                    <div class="mb-3">
                        <label for="labelCalle" class="form-label">Calle:</label>
                        <input type="text" class="form-control" id="labelCalle" name="labelCalle"
                            value="{{ $proveedor->calle }}">
                    </div>

                    <div class="mb-3">
                        <label for="labelNumero" class="form-label">Número:</label>
                        <input type="number" class="form-control" id="labelNumero" name="labelNumero"
                            value="{{ $proveedor->numero }}">
                    </div>

                    <div class="mb-3">
                        <label for="labelCP" class="form-label">CP:</label>
                        <input type="number" class="form-control" id="labelCP" name="labelCP"
                            value="{{ $proveedor->cp }}">
                    </div>

                    <div class="mb-3">
                        <label for="labelCiudad" class="form-label">Ciudad:</label>
                        <input type="text" class="form-control" id="labelCiudad" name="labelCiudad"
                            value="{{ $proveedor->ciudad }}">
                    </div>

                    <div class="mb-3">
                        <label for="labelLogo" class="form-label">Logo:</label>
                        <input type="text" class="form-control" id="labelLogo" >
                    </div>

                    <div class="mb-3">
                        <label for="labelEmail" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="labelEmail">
                    </div>

                    <div class="mb-3">
                        <label for="labelTel" class="form-label">Teléfono:</label>
                        <input type="tel" class="form-control" id="labelTel">
                    </div>

                    <div class="mb-3">
                        <label for="labelStok" class="form-label">Stok:</label>
                        <input type="number" class="form-control" id="labelStok">
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
