@extends('layouts.principal1')

@section('contenido')


<div class="container mt-5">

    <H2>EDITAR RIDER</H2>

</div>

<div class="container mt-4">

    <div class="card-body" style="">
        <form action="{{action([App\Http\Controllers\UsuarioController::class,'update'],['usuario'=> $usuario->id,'tipo'=> $usuario->tipo])}}" id="formularioinscripcion" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mt-2">
            <label for="nombre">ID:</label>
            <input type="text" class="form-control" id="id" name="id" value="{{ $usuario->id }}" readonly>
            </div>

            <div class="form-group mt-2">
            <label for="nickname">NickName:</label>
            <input type="text" class="form-control" id="nickname" name="nickname" value="{{ $rider->nickname }}">
            </div>
        
            <div class="form-group mt-2">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $usuario->nombre }}">
            </div>

            <div class="form-group mt-2">
            <label for="apellido">Apellido:</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $rider->apellidos }}">
            </div>

              <div class="form-group mt-2">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}">
             </div>
            
             <div class="form-group mt-2">
                <label for="telefono">Telefono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $usuario->telefono }}">
                </div>
             
            <div class="form-group mt-2">
            <label for="telefono">Avatar:</label>
            <input type="text" class="form-control" id="avatar" name="avatar" value="{{ $rider->avatar }}">
            </div>

            <div class="form-group mt-2">
                <label for="telefono">Stock:</label>
                <input type="text" class="form-control" id="stock" name="stock" value="{{ $rider->stock_rider }}">
            </div>

            

</form>
    </div>
    <div class="card-footer text-end mt-5">
        <button type="submit" class="btn btn-primary" form="formularioinscripcion" id="aceptar">
            Aceptar
        </button>
        <a href="{{ url("usuarios")}}" class="btn btn-secondary">
            Cancelar
        </a>
    </div>


</div>

@endsection 


{{-- @extends('layouts.principal1')

@section('content')
<div class="container">
    <h2>Editar Usuario</h2>
    <form action="{{ route('RutaPrueba', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

      
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $usuario->nombre }}">
        </div>

     
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}">
        </div>

       
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ $usuario->telefono }}">
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>
@endsection --}}
