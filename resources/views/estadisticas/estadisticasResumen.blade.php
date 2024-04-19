@extends('layouts.principal1')

@section('contenido')
    <style>
        .chart-container {
            width: 300px;
            height: 300px;
        }

        .chart-container1 {
            width: 600px;
          
        }

        .chart-container2 {
            width: 150px;
            height: 150px;
        }

        .contenedor-padre {
            display: flex; /* Utilizamos flexbox para organizar los divs horizontalmente */
            justify-content: space-between; /* Distribuye los divs horizontalmente con espacio entre ellos */
            margin-top: 10px; /* Margen superior */
        }
            /* Estilo para el div contenedor */
        .contenedor {
            display: flex; /* Utilizamos flexbox para organizar las columnas */
                 
            border-radius: 8px; /* Bordes redondeados */                
            justify-content: space-evenly; /* Alineamos horizontalmente al centro */
            align-items: center; /* Alineamos verticalmente al centro */
        }

        /* Estilo para la primera columna */
        .columna-imagen {
            flex: 1; /* La primera columna ocupa el 50% del ancho del contenedor */
        }

        /* Estilo para la imagen */
        .imagen {
            width: 100%; /* La imagen ocupa todo el ancho de su contenedor */
            height: auto; /* La altura se ajusta automáticamente para mantener la proporción */
            display: block; /* Se muestra como un bloque para evitar espacios en blanco adicionales */
        }

        /* Estilo para la segunda columna */
        .columna-texto {
            flex: 1; /* La segunda columna ocupa el 50% del ancho del contenedor */
            padding: 20px; /* Espacio interno para separar el texto del borde */
            text-align: center; /* Centra el texto horizontalmente */

        }

        /* Estilo para el texto */
        .texto {
            font-size: 25px; /* Tamaño de fuente */
            font-family: "Luckiest Guy", sans-serif;
            
        }

        
    </style>


    <div class="container">
     
        <div class="container contenedor-padre">
            <!-- Primer div -->
            <div class="contenedor">
                <div class="columna-imagen">
                    <img src="{{ asset('img/icono.png') }}" alt="Icono">
                </div>
                <div class="columna-texto">
                    <p class="texto">{{ $totalPuas }} PUAS</p>
                    
                </div>
            </div>
            <!-- Segundo div -->
            <div class="contenedor">
                <div class="columna-imagen">
                    <img src="{{ asset('img/icono.png') }}" alt="Icono">
                </div>
                <div class="columna-texto">
                    <p class="texto">{{ $totalReservas }} RESERVAS</p>
                    
                </div>
            </div>
            <!-- Tercer div -->
            <div class="contenedor">
                <div class="columna-imagen">
                    <img src="{{ asset('img/icono1.png') }}" alt="Icono">
                </div>
                <div class="columna-texto">
                    <p class="texto">{{ $totalEntregas }} ENTREGAS</p>
                    
                </div>
            </div>
        </div>

        <div class="container contenedor-padre mt-5">
            <!-- Primer div -->
            <div class="contenedor">
                <div class="col-md-4 chart-container mb-4">
                     <h3>Tipos Usuarios</h3>
                    <canvas id="usuariosPorTipoChart"></canvas>
                </div>
            </div>
            <!-- Segundo div -->
            <div class="contenedor">
                <div class="col-md-4 chart-container mb-4">
                    <h3>Reservas Proveedor</h3>
                    <canvas id="ReservasPorProveedor"></canvas>
                </div>
            </div>
            <!-- Tercer div -->
            <div class="contenedor">
                <div class="col-md-4 chart-container mb-4">
                    <h3>Reservas Raider</h3>
                    <canvas id="reservasPorRaiderChart"></canvas>
                </div>
            </div>
        </div>

        <div class="container contenedor-padre mt-5">
            <!-- Primer div -->
            <div class="contenedor">
                <div class="col-md-4 chart-container1 mb-4">
                    <h3>Personas x Pua</h3>
                    <canvas id="puaCantidadPersonasChart"></canvas>
                </div>
            </div>
            <!-- Segundo div -->
            <div class="contenedor">
                <div class="col-md-4 chart-container mb-4">
                    <h3>Estados Reservas</h3>
                    <canvas id="histogramaReservasPorEstado"></canvas>
                </div>
            </div>
            <!-- Tercer div -->
            <div class="contenedor">
                <div class="col-md-4 chart-container mb-4">
                    <img src="{{ asset('img/caroteno.png') }}" alt="Logo" class="me-2" style="height: 350px;">
                </div>
            </div>
        </div> 
  
    </div>


    <script>
        // Datos para el gráfico de Cantidad de Personas por PUA
        var puaData = {!! json_encode($puaData) !!};
        var labelsPua = puaData.map(item => item.pua_id);
        var dataPua = puaData.map(item => item.cantidad_de_personas);

        // Configuración del gráfico de Cantidad de Personas por PUA
        var ctx1 = document.getElementById('puaCantidadPersonasChart').getContext('2d');
        var puaCantidadPersonasChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: labelsPua,
                datasets: [{
                    label: 'Cantidad de Personas por PUA',
                    data: dataPua,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Datos para el gráfico de Reservas por Proveedor
        var ctx2 = document.getElementById('ReservasPorProveedor').getContext('2d');
        var dataProveedor = @json($dataProveedor);

        var proveedores = Object.keys(dataProveedor);
        var estadosProveedor = Array.from(new Set(proveedores.flatMap(proveedor => Object.keys(dataProveedor[proveedor]))));
        var datasetsProveedor = [];

        estadosProveedor.forEach(estado => {
            var dataset = {
                label: estado,
                backgroundColor: 'rgb(' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() *
                    256) + ', ' + Math.floor(Math.random() * 256) + ')',
                stack: estado,
                data: proveedores.map(proveedor => dataProveedor[proveedor][estado] || 0)
            };
            datasetsProveedor.push(dataset);
        });

        var graficoReservasPorProveedorEstado = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: proveedores,
                datasets: datasetsProveedor
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true
                    }
                }
            }
        });

        // Datos para el gráfico de Reservas por Raider
        var ctx3 = document.getElementById('reservasPorRaiderChart').getContext('2d');
        var dataRaider = @json($dataRaider);

        var raiders = Object.keys(dataRaider);
        var estadosRaider = Array.from(new Set(raiders.flatMap(raider => Object.keys(dataRaider[raider]))));
        var datasetsRaider = [];

        estadosRaider.forEach(estado => {
            var dataset = {
                label: estado,
                backgroundColor: 'rgb(' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() *
                    256) + ', ' + Math.floor(Math.random() * 256) + ')',
                stack: estado,
                data: raiders.map(raider => dataRaider[raider][estado] || 0)
            };
            datasetsRaider.push(dataset);
        });

        var reservasPorRaiderChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: raiders,
                datasets: datasetsRaider
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true
                    }
                }
            }
        });

        // Datos para el gráfico de Usuarios por Tipo
        var ctx4 = document.getElementById('usuariosPorTipoChart').getContext('2d');
        var usuariosPorTipoChart = new Chart(ctx4, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($usuariosPorTipo->keys()) !!},
                datasets: [{
                    label: 'Usuarios por Tipo',
                    data: {!! json_encode($usuariosPorTipo->values()) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', // Color para el primer elemento
                        'rgba(54, 162, 235, 0.2)', // Color para el segundo elemento
                        'rgba(255, 206, 86, 0.2)' // Color para el tercer elemento
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)', // Borde para el primer elemento
                        'rgba(54, 162, 235, 1)', // Borde para el segundo elemento
                        'rgba(255, 206, 86, 1)' // Borde para el tercer elemento
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });


        // Obtener los datos para el gráfico
        var reservasPorEstado = {!! json_encode($reservasPorEstado) !!};

        // Preparar los datos para el gráfico
        var labels = Object.keys(reservasPorEstado);
        var data = Object.values(reservasPorEstado);

        // Configurar el gráfico
        var ctx = document.getElementById('histogramaReservasPorEstado').getContext('2d');
        var histogramaReservasPorEstado = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Reservas por Estado',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', // Color para la primera barra
                        'rgba(54, 162, 235, 0.2)', // Color para la segunda barra
                        'rgba(255, 205, 86, 0.2)', // Color para la tercera barra
                        // Puedes agregar más colores aquí si tienes más barras
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)', // Borde para la primera barra
                        'rgba(54, 162, 235, 1)', // Borde para la segunda barra
                        'rgba(255, 205, 86, 1)', // Borde para la tercera barra
                        // Puedes agregar más colores aquí si tienes más barras
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
