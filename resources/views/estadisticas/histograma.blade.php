@extends('layouts.principal1')

@section('contenido')
   
    <div class="container mt-5 mb-5">
        <H1>ESTADOS DE LAS RESERVAS</H1>
    </div>

    <div class="container">
        
        <canvas id="histogramaReservasPorEstado" width="400" height="400"></canvas>
    </div>

    
<script>
    var ctx = document.getElementById('histogramaReservasPorEstado').getContext('2d');
    var histogramaReservasPorEstado = new Chart(ctx, {
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
            responsive: true, // Permite que el gráfico sea responsivo
                 maintainAspectRatio: false, // No mantiene el aspecto del gráfico
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