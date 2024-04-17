@extends('layouts.principal1')

@section('contenido')
  

    <div class="container">
        <canvas id="ReservasPorProveedor" width="400" height="400"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('ReservasPorProveedor').getContext('2d');
        var data = @json($data);

        var proveedores = Object.keys(data);
        var estados = Array.from(new Set(proveedores.flatMap(proveedor => Object.keys(data[proveedor]))));
        var datasets = [];

        estados.forEach(estado => {
            var dataset = {
                label: estado,
                backgroundColor: 'rgb(' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ')',
                stack: estado,
                data: proveedores.map(proveedor => data[proveedor][estado] || 0)
            };
            datasets.push(dataset);
        });

        var graficoReservasPorProveedorEstado = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: proveedores,
                datasets: datasets
            },
            options: {
                responsive: true, // Permite que el gráfico sea responsivo
                 maintainAspectRatio: false, // No mantiene el aspecto del gráfico
                scales: {
                    x: { stacked: true },
                    y: { stacked: true }
                }
            }
        });
    </script>



@endsection