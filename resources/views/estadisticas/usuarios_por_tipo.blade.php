@extends('layouts.principal1')

@section('contenido')

     <div class="container mt-5 mb-5">
        <H1>TIPOS DE USUARIO</H1>
    </div>
    <div class="container mt-5">
     
        <canvas id="usuariosPorTipoChart" width="400" height="400"></canvas>
    </div>

    <div class="container">
        <canvas id="histogramaReservasPorEstado" width="400" height="400"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('usuariosPorTipoChart').getContext('2d');
        var usuariosPorTipoChart = new Chart(ctx, {
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