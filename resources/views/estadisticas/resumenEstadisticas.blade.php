@extends('layouts.principal1')

@section('contenido')

<style>
    /* Definimos un tamaño para los contenedores de los gráficos */
    .chart-container {
        width: 300px; /* ajusta el ancho como desees */
        height: 300px; /* ajusta la altura como desees */
    }
</style>

 <div class="container mt-5 mb-5">
    <h1>RESERVAS POR PROVEEDOR</h1>
    <canvas id="ReservasPorProveedor" width="300" height="300"></canvas>
</div> 

 <div class="container mt-5 mb-5">
    <h1>RESERVAS POR RAIDER</h1>
    <canvas id="reservasPorRaiderChart" width="300" height="300"></canvas>
</div> 

<div class="container mt-5 mb-5">
    <h1>ESTADOS DE LAS RESERVAS</h1>
    <canvas id="histogramaReservasPorEstado" width="300" height="300"></canvas>
</div>   





<script>
    var ctx1 = document.getElementById('histogramaReservasPorEstado').getContext('2d');
    var histogramaReservasPorEstado = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: {!! json_encode($reservasPorEstado->keys()) !!},
            datasets: [{
                label: 'Reservas por Estado',
                data: {!! json_encode($reservasPorEstado->values()) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            // width: 300, // ajusta el ancho del gráfico como desees
            // height: 300, // ajusta la altura del gráfico como desees
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

<script>

    var ctx2 = document.getElementById('ReservasPorProveedor').getContext('2d');
    var dataProveedor = @json($dataProveedor);

    var proveedores = Object.keys(dataProveedor);
    var estadosProveedor = Array.from(new Set(proveedores.flatMap(proveedor => Object.keys(dataProveedor[proveedor]))));
    var datasetsProveedor = [];

    estadosProveedor.forEach(estado => {
        var dataset = {
            label: estado,
            backgroundColor: 'rgb(' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ')',
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
            // width: 300, // ajusta el ancho del gráfico como desees
            // height: 300, // ajusta la altura del gráfico como desees
            scales: {
                x: { stacked: true },
                y: { stacked: true }
            }
        }
    });

</script>

<script>

    var ctx3 = document.getElementById('reservasPorRaiderChart').getContext('2d');
    var dataRaider = @json($dataRaider);

    var raiders = Object.keys(dataRaider);
    var estadosRaider = Array.from(new Set(raiders.flatMap(raider => Object.keys(dataRaider[raider]))));
    var datasetsRaider = [];

    estadosRaider.forEach(estado => {
        var dataset = {
            label: estado,
            backgroundColor: 'rgb(' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ')',
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
            // width: 300, // ajusta el ancho del gráfico como desees
            // height: 300, // ajusta la altura del gráfico como desees
            scales: {
                x: { stacked: true },
                y: { stacked: true }
            }
        }
    });
</script>


@endsection