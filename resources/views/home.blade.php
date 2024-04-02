@extends('layouts.principal')
@section('contenido')
    @switch($user["tipo"])
        @case("administrador")
            Administrador
            @break  
        @case("proveedor")
            Proveedor
            @break
        @case("rider")
            Rider
            @break
        @default
    @endswitch
@endsection