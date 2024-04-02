@extends('layouts.principal')
@section('contenido')
    <div class="offset-lg-3 col-lg-6 mt-5">
        <div class="card">
            <div class="card-header bg-secondary  text-light text-center">Inscribirse</div>
            <div class="card-body">
            
                <div class="row mb-3">
                    {{-- <a href="{{url("usuarios/create")}}" class="btn btn-primary"> --}}
                    <a href="{{route('usuarios.create', ['tipo' =>'administrador'])}}" class="btn btn-primary">
                        Administrador
                    </a>
                </div>

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