@extends('layouts.principal')
    @section("titulo")
        Elige el tipo de usuario
    @endsection
    @section("paginaAnterior")
        {{url("/login")}}
    @endsection
    @section('contenido')
        <div class="col-sm-12 col-md-6" style="display:flex; align-items: center; justify-content: center;">
            <div class="card w-75 rounded-4">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <p class="h6">
                                Bienvenidos a Food Hero
                            </p>
                            <p class="h1">
                                Inscribirse
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 mt-3" style="display:flex; align-items: center; justify-content: center;">
                            <a href="{{route('usuarios.create', ['tipo' =>'rider'])}}" class="btn col-12" style="background-color: #018780; box-shadow: 0 0 10px 2px #868b8d;">
                                <div class="row">
                                    <div class="col-sm-4" style="display:flex; align-items: center; justify-content: center;">
                                        <img src="{{asset('media/img/iconos/icono_rider.png')}}" alt="Icono de Google" height="30vh" width="30vw" draggable="false">
                                    </div>
                                    <div class="col-sm-8" style="display:flex; align-items: center; justify-content: center;">
                                        <p class="h1" style="color:white; font-family: 'Luckiest Guy', sans-serif;">
                                            Rider
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 mt-3" style="display:flex; align-items: center; justify-content: center;">
                            <a href="{{route('usuarios.create', ['tipo' =>'proveedor'])}}" class="btn col-12" style="background-color: #F47D20; box-shadow: 0 0 10px 2px #868b8d;">
                                <div class="row">
                                    <div class="col-sm-4" style="display:flex; align-items: center; justify-content: center;">
                                        <img src="{{asset('media/img/iconos/icono_proveedor.png')}}" alt="Icono de Google" height="30vh" width="30vw" draggable="false">
                                    </div>
                                    <div class="col-sm-8" style="display:flex; align-items: center; justify-content: center;">
                                        <p class="h1" style="color:white; font-family: 'Luckiest Guy', sans-serif;">
                                            Proveedor
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection