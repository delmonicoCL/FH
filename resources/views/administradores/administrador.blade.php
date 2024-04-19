@extends('layouts.principal1')
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

<DIV class="container mt-5 d-flex ">
    
        <div class="container ">
               <div class="container d-flex justify-content-center align-items-center">
    <div>
        <img src="{{ asset('img/titulo.png') }}" alt="" srcset="">
    </div>
</div>
            <div id="resumen" class=" mt-5">
                <div class="row mt-5 mb-5">
                             <div class="col-4">
                    <img src="{{ asset('img/estadisticas/card_total_canceled.png') }}" alt="" srcset=""  style="width: 100%;">
                    </div>
                    <div class="col-4">
                    <img src="{{ asset('img/estadisticas/card_total_order.png') }}" alt="" srcset=""  style="width: 100%;">
                    </div>
                    <div class="col-4">
                    <img src="{{ asset('img/estadisticas/card_total_delivered.png') }}" alt="" srcset=""  style="width: 100%;">
                    </div>
                </div>
            </div>
            <div id="grafica1" class="my-5 mt-5 ">
                <div class="row">
                    <div class="col-12">
                    <img src="{{ asset('img/group2.png') }}" alt="" srcset=""  style="width: 100%;">
                    </div>
                 </div>
                 
            </div> 
        
        </div>

</DIV>

@endsection