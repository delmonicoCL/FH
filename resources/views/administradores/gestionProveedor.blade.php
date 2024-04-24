@extends('layouts.principal1')

@section('contenido')
    <div class="container mt-4">

        <script>
            console.log(@json($dataProveedor));
        </script>

        <H2> PROVEEDORES </H2>

    </div>

    <div class="container mt-4">

        <table class="table table-striped table-bordered">

            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Numero</th>
                    <th scope="col">CP</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Logo</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Borrar</th>
                    <th scope="col">Editar</th>

                </tr>
            </thead>

            <tbody>

                @for ($i = 0; $i < count($proveedores); $i++)
                    <tr>
                        <td>{{ $usuarios[$i]->id }}</td>
                        <td>{{ $usuarios[$i]->nombre }}</td>
                        <td>{{ $proveedores[$i]->calle }}</td>
                        <td>{{ $proveedores[$i]->numero }}</td>
                        <td>{{ $proveedores[$i]->cp }}</td>
                        <td>{{ $proveedores[$i]->ciudad }}</td>
                        <td>{{ $proveedores[$i]->logo }}</td>
                        <td>{{ $usuarios[$i]->email }}</td>
                        <td>{{ $usuarios[$i]->telefono }}</td>
                        <td>{{ $proveedores[$i]->stock_proveedor }}</td>

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
        <!-- Paginator para los usuarios -->
            {{ $usuarios->links() }}

    </div>

    <div class="container mt-3">
        <a href="{{ route('usuarios.create', ['tipo' => 'proveedor']) }}" class="btn btn-primary">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Proveedor
        </a>
    </div>


    <div class="container mt-5">

        <H2> RESERVAS </H2>

        <div class="container mt-4">

            <canvas id="ReservasPorProveedor" width="800" height="300"></canvas>
        </div>

    </div>


    <script>
        var ctx2 = document.getElementById('ReservasPorProveedor').getContext('2d');
        var dataProveedor = @json($dataProveedor);

        var proveedores = Object.keys(dataProveedor);
        var estadosProveedor = Array.from(new Set(proveedores.flatMap(proveedor => Object.keys(dataProveedor[proveedor]))));
        var datasetsProveedor = [];

        estadosProveedor.forEach(estado => {
            var dataset = {
                label: estado,
                backgroundColor: 'rgb(' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() *
                    256) + ', ' + Math.floor(Math.random() * 256) + ')',
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
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true
                    }
                }
            }
        });
    </script>
@endsection
