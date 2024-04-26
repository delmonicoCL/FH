@extends('layouts.principal1')
    @section("titulo")
        Pagina principal administración
    @endsection
    @section("apellidos")
        {{$administrador->apellidos}}
    @endsection
    @section("editarAdministrador")
        <form action="{{action([App\Http\Controllers\UsuarioController::class,'edit'],['usuario'=>$usuario,'tipo'=>$usuario->tipo,"idAdministrador"=>$administrador->id])}}"  method="POST">
            @method('GET')
            <input class="dropdown-item" type="submit" value="Actualizar perfil">
        </form>
    @endsection
    @section('contenido')
        <style>
            body {
                /* background-image: url('{{ asset('img/nosotros.png') }}'); */
                /* background-color: #f0f0f0; Cambia #f0f0f0 por el color que desees */
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
        </style>

        <DIV class="d-flex ">



            <div class="col-12">
                <img src="{{ asset('img/group4.png') }}" alt="" srcset="" style="width: 100%;">
            </div>






        </DIV>
    @endsection