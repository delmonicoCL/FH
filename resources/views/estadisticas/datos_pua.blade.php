@extends('layouts.principal1')

@section('contenido')
  
    <div class="container mt-5 mb-5">
         <H1>PUAS CREADAS POR RAIDER</H1>
    </div>
    
    <div class="container">
       
        <canvas id="datosPUA" width="400" height="400"></canvas>
    </div>

    <script>
    var ctx = document.getElementById('datosPUA').getContext('2d');
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