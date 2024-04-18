@extends('layouts.principal1')

@section('contenido')

     <div class="container mt-5 mb-5">
        <H1>RAIDERS, PUAS Y PERSONAS</H1>
    </div>
    <div class="container mt-5">
     
        <canvas id="usuariosPorTipoChart" width="400" height="400"></canvas>
    </div>

    <div class="container">
        <canvas id="datosRiderPuasPersonas" width="400" height="400"></canvas>
    </div>

 <script>
    var ctx = document.getElementById('datosRiderPuasPersonas').getContext('2d');
    var puasPorRider = @json($puasPorRider);
    var promedioPersonasPorPua = @json($promedioPersonasPorPua);

    var riders = Object.keys(puasPorRider);
    var datosPUA = riders.map(rider => {
        return {
            rider: rider,
            total_puas: puasPorRider[rider],
            promedio_personas: promedioPersonasPorPua
        };
    });

    var datosPUAChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: riders,
            datasets: [{
                label: 'PUA creados por rider',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: datosPUA.map(item => item.total_puas)
            }, {
                label: 'Promedio de personas por PUA',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: datosPUA.map(item => item.promedio_personas)
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { stacked: true },
                y: { stacked: true }
            }
        }
    });
</script>



@endsection