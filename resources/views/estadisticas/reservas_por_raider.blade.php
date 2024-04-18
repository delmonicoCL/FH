@extends('layouts.principal1')

@section('contenido')
  
    <div class="container mt-5 mb-5">
         <H1>RESERVAS POR RAIDER</H1>
    </div>
    
    <div class="container">
        <canvas id="reservasPorRaiderChart" width="400" height="400"></canvas>
    </div>

  <script>
    var ctx = document.getElementById('reservasPorRaiderChart').getContext('2d');
    var data = @json($data);

    var raiders = Object.keys(data);
    var estados = Array.from(new Set(raiders.flatMap(raider => Object.keys(data[raider]))));
    var datasets = [];

    estados.forEach(estado => {
        var dataset = {
            label: estado,
            backgroundColor: 'rgb(' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ')',
            stack: estado,
            data: raiders.map(raider => data[raider][estado] || 0)
        };
        datasets.push(dataset);
    });

    var reservasPorRaiderChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: raiders,
            datasets: datasets
        },
        options: {
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