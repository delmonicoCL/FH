@extends('layouts.principal1')

@section('contenido')


<div class="container mt-5">

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
                <td>{{ $usuarios[$i]->id}}</td>
                <td>{{ $usuarios[$i]->nombre}}</td>
                <td>{{ $proveedores[$i]->calle }}</td>
                <td>{{ $proveedores[$i]->numero }}</td>
                <td>{{ $usuarios[$i]->email }}</td>
                <td>{{ $usuarios[$i]->telefono }}</td>
                <td>{{ $proveedores[$i]->stock_proveedor }}</td>
                
              <td>
              
             <form class="float-right ml-1" action="{{action([App\Http\Controllers\UsuarioController::class,'destroy'], ['usuario'=> $usuarios[$i]->id] )}}" method="POST" onsubmit="return confirmarBorrado()">
                  @csrf 
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i> Borrar </button>
              </form>

              <script>
                  function confirmarBorrado() {
                      return confirm("¿Estás seguro de que deseas borrar este usuario?");
                  }
              </script>
              </td>  
              <td>

                <form action="" class="float-right">
                        <button type="submit" class="btn btn-sm btn-warning"> <i class="fa fa-edit" 
                            aria-hidden="true"></i> Editar </button>
                    </form>

              </td>
            </tr>
            @endfor
        </tbody>


    </table>

</div>

<div class="container mt-4">
  <a href="{{ route('registros.index') }}" class="btn btn-primary btn-float-afegir">
    <i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Proveedor
</a>
</div>

<div class="container mt-5">

  <H2> ESTADISTICAS </H2>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('img/estadisticas.png') }}" alt="" srcset=""  style="width: 100%;">
            </div>
            <div class="col-md-6">
                <img src="{{ asset('img/estadisticas.png') }}" alt="" srcset=""  style="width: 100%;">
            </div>
        </div>
    </div>

</div>

    
  {{-- {{ $riders->links() }} --}}

{{-- <a href="{{ url('cicles/create')}}" class="btn btn-primary btn-float-afegir"><i class="fa fa-plus-circle" aria-hidden="true"></i>Nuevo Ciclo</a> --}}


@endsection