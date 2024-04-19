@extends('layouts.principal1')

@section('contenido')
    <style>
        .chart-container {
            width: 400px;
            height: 400px;
        }

        .chart-container1 {
            width: 700px;
            height: 700px;
        }
    </style>


    <div class="container mt-2">

        <h1>Estadisticas/Graficos</h1>


        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-6 chart-container">
                    <h3>Reservas Raider</h3>
                    <canvas id="reservasPorRaiderChart"></canvas>
                </div>
                <div class="col-6 chart-container">
                    <h3>Reservas Proveedor</h3>
                    <canvas id="ReservasPorProveedor"></canvas>
                </div>
                <div class="col-6 chart-container">
                    <h3>Estados Reservas</h3>
                    <canvas id="histogramaReservasPorEstado"></canvas>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-8 chart-container1">
                    <h3>Cantidad de personas x Pua</h3>
                    <canvas id="puaCantidadPersonasChart"></canvas>
                </div>
                <div class="col-4 chart-container justify-content-center align-items">
                    <h3>Tipos Usuarios</h3>
                    <div class="d-flex justify-content-center align-items">
                        <canvas id="usuariosPorTipoChart"></canvas>
                    </div>
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
    </script>
@endsection
