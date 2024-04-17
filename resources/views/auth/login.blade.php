@if(Auth::check())
    @php
        header("Location:../public/home");
        exit();
    @endphp
@else
    @extends("layouts.principal")
    @section('contenido')
        @include('partials.mensajes')
        <div class="row mt-5" style="display:flex; align-items: center; justify-content: center;">
            <!--<div style="display:flex; align-items: center; justify-content: center;">-->
            <div class="col-sm-6" style="display:flex; justify-content: flex-end">
                <img src="{{asset('media/img/zanahoria.png')}}" alt="imagen reloj" height="700vh" width="700vw" draggable="false">
            </div>
            <div class="col-sm-6" style="display:flex; align-items: center; justify-content: flex-start">
                <div class="card">
                    <div class="card-body">
                        <form action="{{action([App\Http\Controllers\UsuarioController::class,'login'])}}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-sm-8">
                                    <p class="h6">
                                        Bienvenidos a Food Hero
                                    </p>
                                    <p class="h1">
                                        Iniciar Sesión
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <small>
                                        ¿No tienes cuenta? Crea una 
                                    </small>
                                    <small>
                                        <a href="{{url("/registros/index")}}">
                                            aqui
                                        </a>
                                    </small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="correoElectronico" class="col-sm-2 col-from-label" hidden>
                                    Correo Electronico
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="correoElectronico" name="CorreoElectronico" value="{{old("CorreoElectronico")}}" placeholder="Correo Electrónico" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="contrasenia" class="col-sm-2 col-form-label" hidden>
                                    Contraseña
                                </label>
                                <div class="col-sm-12">
                                    <input type="password" class="form-control" id="contrasenia" name="Contrasenia" value="{{old('Contrasenia')}}" placeholder="Contraseña">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary float-right col-sm-12" style="background-color: #00AEEF;">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        Iniciar Sesión
                                    </button>
                                </div>
                            </div>

                            {{--<div class="row" style="text-align: end;">
                                <p>
                                    ¿No tienes cuenta? Crea una <a href="{{url("/registros/index")}}">aqui</a>
                                </p>
                            </div>--}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif