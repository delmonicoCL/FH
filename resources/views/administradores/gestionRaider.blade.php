@extends('layouts.principal1')

@section('contenido')
    <div class="container mt-5">
        <H2> RIDERS </H2>
    </div>

    <div class="container mt-2">

        <table class="table table-striped table-bordered">

            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NickName</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Borrar</th>
                    <th scope="col">Editar</th>

                </tr>
            </thead>

            <tbody>

                @for ($i = 0; $i < count($riders); $i++)
                    <tr>
                        <td>{{ $usuarios[$i]->id }}</td>
                        <td>{{ $riders[$i]->nickname }}</td>
                        <td>{{ $usuarios[$i]->nombre }}</td>
                        <td>{{ $riders[$i]->apellidos }}</td>
                        <td>{{ $usuarios[$i]->email }}</td>
                        <td>{{ $usuarios[$i]->telefono }}</td>
                        <td>{{ $riders[$i]->avatar }}</td>
                        <td>{{ $riders[$i]->stock_rider }}</td>

                        <td>

                            <form class="float-right ml-1"
                                action="{{ action([App\Http\Controllers\UsuarioController::class, 'destroy'], ['usuario' => $usuarios[$i]->id, 'tipo' => $usuarios[$i]->tipo]) }}"
                                method="POST" onsubmit="return confirmarBorrado()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"> <i class="fa fa-trash"
                                        aria-hidden="true"></i> Borrar </button>
                            </form>

                            <script>
                                function confirmarBorrado() {
                                    return confirm("¿Estás seguro de que deseas borrar este usuario?");
                                }
                            </script>
                        </td>
                        <td>


                            <form
                                action="{{ action([App\Http\Controllers\UsuarioController::class, 'edit'], ['usuario' => $usuarios[$i]->id, 'tipo' => $usuarios[$i]->tipo]) }}"
                                method="POST" class="float-right">
                                @method('GET')
                                <button type="submit" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit" aria-hidden="true"></i> Editar
                                </button>
                            </form>


                        </td>
                    </tr>
                @endfor
            </tbody>


        </table>

    </div>

    <div class="container mt-2">
        <a href="{{ route('usuarios.create', ['tipo' => 'rider']) }}" class="btn btn-primary">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Raider
        </a>
    </div>

    <div class="container mt-4">
        <H2> ESTADISTICAS </H2>
        <div class="container mt-3">
            <canvas id="graficoPorRaider" width="800" height="300"></canvas>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('graficoPorRaider').getContext('2d');
        var graficoPorRaider = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($datosEntregas)) !!},
                datasets: [{
                    label: 'Entregas',
                    data: {!! json_encode(array_values($datosEntregas)) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Reservas',
                    data: {!! json_encode(array_values($datosReservas)) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }, {
                    label: 'Puas',
                    data: {!! json_encode(array_values($datosPuas)) !!},
                    backgroundColor: 'rgba(255, 206, 86, 0.5)',
                    borderColor: 'rgba(255, 206, 86, 1)',
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
