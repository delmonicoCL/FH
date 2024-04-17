@extends("layouts.proveedor.formProveedor")
    @section("titulo")
    @endsection
    @section("contenido")
        <pre>
            @php
                print_r($user);
            @endphp
        </pre>
        <div class="formulario">
            <div class="card text-center">
                <div class="tituloForm">
                    <h2>Editar Proveedor</h2>
                </div>
                <hr />
                <form
                    action="{{ action([App\Http\Controllers\ProveedorController::class, 'update'], ['proveedore' => $proveedore],['user' => $user]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="logo mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        {{-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">{{ $user['nombre'] }}</h4> --}}
                    </div>


                </form>

            </div>
        </div>
        {{-- <form
            action="{{ action([App\Http\Controllers\ProveedorController::class, 'update'], ['proveedore' => $proveedore]) }}"
            method="POST">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form> --}}
    @endsection