<div class="contenedor col-lg-12">
    <div class="fila1 col-lg-12">
        <div class="infoProveedor col-lg-7 col-sm-12">
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
                    <form action="{{action([App\Http\Controllers\ProveedorController::class, 'edit'], ['proveedore'=>$proveedor['id']])}}" method="GET">
                        <button type="submit" class="btnVolver" id="btnVolver">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="estadisticas col-lg-4 col-sm-12">
            <div class="titulo">
                <h2>Estadisticas</h2>
            </div>
        </div>
    </div>

    <div class="fila2 col-lg-12">
        <div class="crearMenu col-lg-4 col-sm-12">
            <div class="titulo">
                <h2>Crear Menu</h2>
            </div>
            <hr />
            <div class="cantidadMenu">
                <div class="menosMenu">
                    <button class="menos">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
                <div class="cantMenu"> 3 </div>
                <div class="masMenu">
                    <button class="mas">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="btnCrear">
                <button class="crear">
                    Crear Menu(s)
                </button>
            </div>
        </div>
        <div class="entregarMenu col-lg-7 col-sm-12">
            <div class="titulo">
                <h2>Entregar Menu</h2>
            </div>
            <hr />
            <div class="selectRider">
                <label for="opciones">Select Rider:</label>
                <select id="opciones" name="opciones">
                    <option value="opcion4">-- Select --</option>
                    <option value="opcion1">Opción 1</option>
                    <option value="opcion2">Opción 2</option>
                    <option value="opcion3">Opción 3</option>
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
        <div class="stok col-lg-5 col-sm-12">
            <div class="titulo">
                <h2>Stok</h2>
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
        <div class="mapa col-lg-5">
            <div class="titulo">
                <h2>Mapa</h2>
            </div>
            <hr />
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
