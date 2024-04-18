@extends('layouts.principal1')
@section('contenido')


<DIV class="container mt-5 mb-5 d-flex ">
    
        <div class="container mt-5">
                
            <div id="resumen" class="my-5 mt-5">
                <div class="row mt-5 mb-5">
                    <h2>RESUMEN</h2>
                    <div class="col-4">
                    <img src="{{ asset('img/estadisticas/card_total_canceled.png') }}" alt="" srcset=""  style="width: 100%;">
                    </div>
                    <div class="col-4">
                    <img src="{{ asset('img/estadisticas/card_total_order.png') }}" alt="" srcset=""  style="width: 100%;">
                    </div>
                    <div class="col-4">
                    <img src="{{ asset('img/estadisticas/card_total_delivered.png') }}" alt="" srcset=""  style="width: 100%;">
                    </div>
                </div>
            </div>
            <div id="grafica1" class="my-5 mt-5">
                <div class="row">
                    <H2> GRAFICAS</H2>
                    <div class="col-6">
                    <img src="{{ asset('img/estadisticas/pieChart.png') }}" alt="" srcset=""  style="width: 100%;">
                    </div>
                    <div class="col-6">
                        <img src="{{ asset('img/estadisticas/card_chart_order.png') }}" alt="" srcset=""  style="width: 100%;">
                    </div>
                </div>
            </div>
        
        </div>

</DIV>

{{-- <div class="container">
    <canvas id="usuariosPorTipoChart" width="400" height="400"></canvas>
</div>

<script>
    var ctx = document.getElementById('usuariosPorTipoChart').getContext('2d');
    var usuariosPorTipoChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($usuariosPorTipo->keys()) !!},
            datasets: [{
                label: 'Usuarios por Tipo',
                data: {!! json_encode($usuariosPorTipo->values()) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    // Agrega más colores si tienes más tipos de usuarios
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    // Agrega más colores si tienes más tipos de usuarios
                ],
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
</script> --}}



@endsection