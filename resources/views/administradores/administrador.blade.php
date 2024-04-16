@extends('layouts.principal1')
@section('contenido')


<DIV class="container mt-5 mb-5 d-flex ">

   
  

<div class="container mt-5">
    <div id="resumen" class="my-5 mt-5">
        <div class="row mt-5 mb-5">
            <h2>RESUMEN</h2>
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
    <div id="grafica1" class="my-5 mt-5">
        <div class="row">
            <H2> GRAFICAS</H2>
            <div class="col-6">
               <img src="{{ asset('img/estadisticas/pieChart.png') }}" alt="" srcset=""  style="width: 100%;">
            </div>
            <div class="col-6">
                <img src="{{ asset('img/estadisticas/card_chart_order.png') }}" alt="" srcset=""  style="width: 100%;">
            </div>
        </div>
    </div>
   
</div>


</DIV>



@endsection