@extends('layouts.principal1')

@section('contenido')
  
    <div class="container mt-5 mb-5">
         <H1>ENTREGAS X TIPO DE PUA</H1>
    </div>
    
    <div class="container">
       
        <canvas id="entregasPorTipoPua" width="400" height="400"></canvas>
    </div>

<script>
    var ctx = document.getElementById('entregasPorTipoPua').getContext('2d');
    var data = @json($data);

    var puas = Object.keys(data);
    var estados = Array.from(new Set(puas.flatMap(pua => Object.keys(data[pua]))));
    var datasets = [];

    estados.forEach(estado => {
        var dataset = {
            label: estado,
            backgroundColor: 'rgb(' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ')',
            stack: estado,
            data: puas.map(pua => data[pua][estado] || 0)
        };
        datasets.push(dataset);
    });

    var entregasPorTipoPuaChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: puas,
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