@extends('layouts.proveedor.proveedor2')
@section('titulo')
    Datos del proveedor
@endsection
@section('contenido')
    @include('partials.mensajes')
    {{-- <pre>
            @php
                print_r($reservas)
            @endphp
        </pre> --}}
    <div class="contenedor col-lg-12">
        <div class="fila1 col-lg-12">
            <div class="infoProveedor col-lg-7">
                <div class="titulo">
                    <h2>Proveedor</h2>
                </div>
                <hr />
                <div class="row1">
                    <div class="nombre">
                        <h4>{{ $user['nombre'] }}</h4>
                    </div>
                    <div class="calle">
                        <h4>Calle: </h4>
                        <p>{{ $proveedor['calle'] }} {{ $proveedor['numero'] }}</p>
                    </div>
                </div>
                <div class="row2">
                    <div class="email">
                        <p>{{ $user['email'] }}</p>
                    </div>
                    <div class="ciudad">
                        <h4>Ciudad: </h4>
                        <p> {{ $proveedor['ciudad'] }} {{ $proveedor['cp'] }}</p>
                    </div>
                </div>
                <div class="row3">
                    <div class="telefono">
                        <p> {{ $user['telefono'] }}</p>
                    </div>
                    <div class="icono">
                        <form
                            action="{{ action([App\Http\Controllers\ProveedorController::class, 'edit'], ['proveedore' => $proveedor]) }}"
                            method="POST">
                            @method('GET')
                            <img src="{{ asset('img/Group.svg') }}" alt="svgEditar" class="svgEditar">
                            <button type="submit" class="btnEditar" id="btnEditar" title="Editar">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="estadisticas col-lg-4">
                <div class="titulo">
                    <h2>Estadisticas</h2>
                </div>
                <hr />
            </div>
        </div>

        <div class="fila2 col-lg-12">
            <div class="crearMenu col-lg-4" id="menu">
                <div class="titulo">
                    <h2>Crear Menu</h2>
                </div>
                <hr />
                <div class="cantidadMenu">
                    <div class="menosMenu">
                        <button class="menos" id="menosBtn">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </div>
                    <div class="cantMenu"> 0 </div>
                    <div class="masMenu">
                        <button class="mas" id="masBtn">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="btnCrear">
                    <button class="crear" id="crearBtn" type="submit" form="idForm">
                        Crear Menu(s)
                    </button>
                </div>
                <form id="idForm"
                    action="{{ action([App\Http\Controllers\ProveedorController::class, 'update'], ['proveedore' => $proveedor, 'tipoDeModificacion' => 'crearMenu']) }}"
                    method="POST" hidden>
                    @csrf
                    @method('PUT')
                    <label for="cant">cant</label>
                    <input type="text" id="cant" name="Cant">
                </form>
            </div>

            <div class="entregarMenu col-lg-7">
                <div class="titulo">
                    <h2>Entregar Menu</h2>
                </div>
                <hr />
                <div class="selectRider">
                    <label for="opciones">Select Rider:</label>
                    <select id="opciones" name="opciones">

                        <option value="opcion">-- Select --</option>
                        @foreach ($riders as $rider)
                            <option value="option">{{ $rider->nombre }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="btnConfirm">
                    <button class="confirm">
                        Confirmar
                    </button>
                </div>
            </div>
        </div>

        <div class="fila3 col-lg-12">
            <div class="stok col-lg-6">
                <div class="titulo">
                    <h2>Stock</h2>
                </div>
                <hr />
                <div class="stokDiv">
                    <div class="selectMenu container-fluid">
                        @yield('contenidoMenu')
                        <h4>Stok actual: </h4>
                        <p> {{ $proveedor['stock_proveedor'] }}</p>
                    </div>
                    <div class="selectHistorico container-fluid">
                        @yield('contenidoHistorico')
                        <h4>Historial Menus:</h4>
                        <p>{{ $proveedor['stock_proveedor'] }}</p>
                    </div>
                </div>
            </div>
            <div class="mapa col-lg-6">
                <div class="titulo">
                    <h2>Mapa</h2>
                </div>
                <hr />
                @yield('contenido')
                <div id="map">
                    das
                </div>
                <div class="divVolver">
                    <a class="aVolver" id="aVolver" href="{{ route('proveedor1') }}">
                        <button class="btnVolver">
                            <i class="fa-solid fa-circle-chevron-right"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/proveedor.js') }}"></script>
    <script src="{{ asset('js/rider.js') }}"></script>
@endsection
