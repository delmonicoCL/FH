@extends('layouts.principal')
@section('contenido')
    <div class="offset-lg-3 col-lg-6 mt-5">
        <div class="card">
            <div class="card-header text-light text-center" style="background-color: #DA2427;">Inscribirse</div>
            <div class="card-body">

                <div class="row mb-3">
                    <a href="{{route('usuarios.create', ['tipo' =>'proveedor'])}}" class="btn btn-primary">
                        Proveedor
                    </a>
                </div>

                <div class="row mb-3">
                    <a href="{{route('usuarios.create', ['tipo' =>'rider'])}}" class="btn btn-primary">
                        Rider
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection