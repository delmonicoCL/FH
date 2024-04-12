@extends('layouts.principal1')

@section('contenido')




<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">NickName</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Email</th>
        <th scope="col">Telefono</th>
        <th scope="col">Stock</th>
        
      </tr>
    </thead>
    <tbody>
     

@for ($i = 0; $i < count($riders); $i++)

<tr>
    <td>{{ $usuarios[$i]->id}}</td>
    <td>{{ $riders[$i]->nickname }}</td>
    <td>{{ $usuarios[$i]->nombre}}</td>
    <td>{{ $riders[$i]->apellidos }}</td>
    <td>{{ $usuarios[$i]->email }}</td>
    <td>{{ $usuarios[$i]->telefono }}</td>
    <td>{{ $riders[$i]->stock_rider }}</td>
    
   <td>
    {{-- <form> --}}
        <form class="float-right ml-1" action="{{action([App\Http\Controllers\UsuarioController::class,'destroy'], ['usuario'=> $usuarios[$i]->id] )}}" method="POST"> 
            {{-- <form class="float-right ml-1" action="{{action([App\Http\Controllers\CicleController::class,'destroy'], ['cicle'=> $cicle->id] )}}" method="POST">  --}}
       
           @csrf 
           @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"> <i class="fa fa-trash" 
                aria-hidden="true"></i> Borrar </button>
        </form>
         <form action="" class="float-right">
            <button type="submit" class="btn btn-sm btn-warning"> <i class="fa fa-edit" 
                aria-hidden="true"></i> Editar </button>
        </form>
    </td>  
</tr>

@endfor

    </tbody>
  </table>
    
  {{-- {{ $riders->links() }} --}}

{{-- <a href="{{ url('cicles/create')}}" class="btn btn-primary btn-float-afegir"><i class="fa fa-plus-circle" aria-hidden="true"></i>Nuevo Ciclo</a> --}}


@endsection