<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proveedor2</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c7334dda94.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/png" href="{{ asset('img/logo-02.png') }}">
    <link rel="stylesheet" href="{{ asset('css/proveedor2.css') }}">
</head>

<body>
    <div class="contenedor col-lg-12">
        <div class="fila1 col-lg-12">
            <div class="infoProveedor col-lg-7 col-sm-12">
                <div class="titulo">
                    <h2>Proveedor</h2>
                </div>
                <h5>Calle: </h5>
                <p>C/ Mallorca 283</p>
                <h5>Ciudad: </h5>
                <p>Barcelona</p>
                <h5>CP: </h5>
                <p>08037</p>
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
                    </div>
                    <div class="selectHistorico container-fluid">
                        @yield('contenidoHistorico')
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
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
