<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mapa con Mapbox</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/rider.css') }}" />
    <script src='https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.css' rel='stylesheet' />
</head>
<body>
    @yield('contenido')
    <div id="map">
        <img src="{{ asset('img/superhero.png') }}" alt="" id="super">
        <div id="myModal" class="modal-pua">
            <div class="modal-content-pua">
                <span class="close" id="closeButton">&times;</span>
                <h2>Crear Pua</h2>
                <form id="puaForm" action="puas.php" method="post">
                    <label for="nombrePua">Nombre del Rider:</label><br>
                    <input type="text" id="nombrePua" name="nombrePua"><br><br>
                    <label for="numpersonas">Cuantas personas hay?:</label><br>
                    <input type="number" id="numpersonas" name="numpersonas"><br><br>
                    <button type="button" id="submitForm">Crear Pua</button>
                </form>
            </div>
        </div>

         <!-- Navbar Inferior -->
        <nav class="navbar-bottom">
            <div class="container text-center d-flex ">
                <div class="navbar-item">
                    <button id="boton-perfil">
                        <img src="{{ asset('img/perfil.png') }}" alt="Perfil" class="img-fluid" />
                    </button>
                </div>
                <div class="navbar-item">
                    <button id="createMarkerButton">
                        <img src="{{ asset('img/crear_pua.png') }}"alt="Crear Pua" class="img-fluid" />
                    </button>
                </div>
                <div class="navbar-item">
                    <button id="boton-reservas">
                        <img src="{{ asset('img/reservas.png') }}" alt="Reservar" class="img-fluid" />
                    </button>
                </div>
                <div class="navbar-item">
                    <button id="boton-historial">
                        <img src="{{ asset('img/historial.png') }}"alt="Historial" class="img-fluid" />
                    </button>
                </div>
            </div>
        </nav>
      
        <div id="modal-perfil" class="modal-perfil">
            <div class="modal-content-perfil modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">PERFIL</h5>
                        <span class="close" id="closeButtonPerfil">&times;</span>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>PROVEEDOR</th>
                                        <th>RESERVAS</th>
                                        <th>HORARIOS</th>
                                    </tr>
                                </thead>
                                <tbody>
                            
                                    <tr>
                                        <td>Pizzeria Rebebba</td>
                                        <td>4</td>
                                        <td>18:00 a 22:00</td>
                                    </tr>
                                    <tr>
                                        <td>BurgerKing</td>
                                        <td>2</td>
                                        <td>20:00 a 20:30</td>
                                    </tr>
                                    <tr>
                                        <td>365</td>
                                        <td>2</td>
                                        <td>12:00 a 24:00</td>
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div> 
            <!-- Modal Reservas -->
        <div id="modal-reservas" class="modal-reservas">
            <div class="modal-content-reservas modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">RESERVAS</h5>
                        <span class="close" id="closeButtonReservas">&times;</span>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>PROVEEDOR</th>
                                        <th>RESERVAS</th>
                                        <th>HORARIOS</th>
                                    </tr>
                                </thead>
                                <tbody>
                            
                                    <tr>
                                        <td>Pizzeria Rebebba</td>
                                        <td>4</td>
                                        <td>18:00 a 22:00</td>
                                    </tr>
                                    <tr>
                                        <td>BurgerKing</td>
                                        <td>2</td>
                                        <td>20:00 a 20:30</td>
                                    </tr>
                                    <tr>
                                        <td>365</td>
                                        <td>2</td>
                                        <td>12:00 a 24:00</td>
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div> 
        <div class="modal-historial" id="modal-historial">
            <div class="modal-content-historial modal-lg mt-3">
                <div class="modal-content px-5 pt-3 pb-3">
                    <div class="row">
                        <div class="col-lg-12 contact-form">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="text-end">
                                    <span class="close" id="closeButtonHistorial">&times;</span>
                                    </div>
                                    <div class="card-title text-center pb-3">
                                        <h3>HISTORIAL</h3>
                                        <p class="lead text-muted fw-light">Descubre el historial de tus puas.</p>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <h4>PUAS CREADAS</h4>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <p class="lead m-0">12</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <h4>MENÚS ENTREGADOS</h4>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <p class="lead m-0">5</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <h4>RESERVAS ACTUALES</h4>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <p class="lead m-0">3</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <h4>RANKING</h4>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <p class="lead m-0">5</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div> 
    <!-- Enlace al archivo JavaScript -->
    <script src="{{ asset('js/rider.js') }}"></script>
</body>
</html>
