@if(Auth::check())
    @php
        header("Location:../public/home");
        exit();
    @endphp
@else
    @extends("layouts.principal")
    @section('contenido')
        @include('partials.mensajes')
        <div class="offset-lg-3 col-lg-6 mt-5">
            <div class="card">
                <div class="card-header text-light" style="background-color: #DA2427;">Iniciar Sesión</div>
                <div class="card-body">
                    <form action="{{action([App\Http\Controllers\UsuarioController::class,'login'])}}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="correoElectronico" class="col-sm-2 col-from-label">Correo Electronico</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="correoElectronico" name="CorreoElectronico" value="{{old("CorreoElectronico")}}" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="contrasenia" class="col-sm-2 col-form-label">Contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="contrasenia" name="Contrasenia" value="{{old('Contrasenia')}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 d-flex flex-row-reverse">
                                <a href="{{url('/')}}" class="btn btn-secondary float-right ms-1"><i class="fa fa-times" aria-hidden="true"></i>Cancelar</a>
                                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-check" aria-hidden="true"></i>Aceptar</button>
                            </div>
                        </div>

                        <div class="row" style="text-align: end;">
                            <p>
                                ¿No tienes cuenta? Crea una <a href="{{url("/registros/index")}}">aqui</a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endsection
@endif