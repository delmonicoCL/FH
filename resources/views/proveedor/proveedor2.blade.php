@extends('layouts.proveedor.proveedor2')
@section('titulo')
    Datos del proveedor
@endsection
@section('contenido')
    @include('partials.mensajes')
    {{-- <pre>
            @php
                print_r($reservas);
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
                        <h4>Teléfono: </h4>
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
                <div class="mostrarRanking">
                    <div class="ranking">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cant. Entregas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="fila2 col-lg-12">
            <div class="crearMenu col-lg-4" id="menu">
                <div class="titulo">
                    <h2>Crear Menú</h2>
                </div>
                <hr />
                <div class="menus">
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
                    <div class="imgFresa">
                        <img src="{{ asset('img/fresa.svg') }}" alt="imgFresa" class="imgFresa">
                    </div>
                </div>

                <div class="btnCrear">
                    <button class="crear" id="crearBtn" type="submit" form="idFormCrear">
                        Crear Menú(s)
                    </button>
                </div>
                <form id="idFormCrear"
                    action="{{ action([App\Http\Controllers\ProveedorController::class, 'update'], ['proveedore' => $proveedor, 'tipoDeModificacion' => 'crearMenu']) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <label for="cant">cant</label>
                    <input type="text" id="cant" name="Cant">
                </form>
            </div>

            <div class="entregarMenu col-lg-7">
                <div class="titulo">
                    <h2>Entregar Menú</h2>
                </div>
                <hr />
                <div class="entrega">
                    <div class="selectRider">
                        <label for="opciones">Select Rider:</label>
                        <select id="opciones" name="opciones">
                            <option value="opcion">-- Select --</option>
                            @foreach ($riders as $rider)
                                <option value="option">{{ $rider->nickname}},{{$rider->cantidad}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="explicacion">
                        <div class="texto">
                            <p class="textoExplicacion">Selecciona el nombre del rider que ha llegado y confirma la entrega
                            </p>
                        </div>
                        <img src="{{ asset('img/texto.svg') }}" alt="imgTexto" class="imgTexto">
                    </div>
                </div>
                <div class="btnConfirm">
                    <button class="confirmar" id="confirmarBtn" type="submit" form="idFormConfirmar">
                        Confirmar
                    </button>
                </div>
                {{-- action="{{ action([App\Http\Controllers\RiderController::class, 'update'], ['rider' => $rider]) }}" --}}
                <form id="idFormConfirmar"
                    
                    method="POST">
                    <form id="idFormConfirmar" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="riderName">riderNaem</label>
                        <input type="text" id="riderName" name="riderName">
                        <label for="cantidad">cantidad</label>
                        <input type="text" id="cantidad" name="cantidad">
                    </form>
            </div>
        </div>

        <div class="fila3 col-lg-12" style="margin-top: 20px">
            <div class="stock col-lg-5">
                <div class="titulo">
                    <h2>Stock</h2>
                </div>
                <hr />
                <div class="stockDiv">
                    <div class="selectMenu">
                        @yield('contenidoMenu')
                        <h4>Stock actual: </h4>
                        <p class="num"> {{ $proveedor['stock_proveedor'] }}</p>
                    </div>
                    <div class="selectHistorico">
                        @yield('contenidoHistorico')
                        <h4>Historial Menús entregados:</h4>
                        <p class="num">{{ $proveedor['stock_proveedor'] }}</p>
                    </div>
                </div>
            </div>
            <div class="mapa col-lg-5">
                <div class="titulo">
                    <h2>Mapa</h2>
                </div>
                <hr />
                @yield('contenido')
                <div id="map" class="map-container">
                    das
                </div>
                <div class="divVolver">
                    <a class="aVolver" id="aVolver" href="{{ route('proveedor1') }}" title="Volver al Mapa">
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
    <script src="{{ asset('js/proveedorMapa.js') }}"></script>
@endsection
