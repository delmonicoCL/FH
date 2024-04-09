<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>cargando...</title>
    </head>
    <body>
        <div style="display:flex; align-items: center; justify-content: center;">
            <img src="{{asset('media/img/iconos/reloj_de_arena.gif')}}" alt="imagen reloj" height="600vh" width="600vw">
        </div>
        <form action="{{action([App\Http\Controllers\ProveedorController::class,'store'])}}" class="row" method="POST" hidden>   
            @csrf
        
            <label for="id">
                id
            </label>
            <div>
                <input type="text" id="id" name="Id" value="{{$id}}" readonly>
            </div>
        
            <label for="calle">
                Calle
            </label>
            <div>
                <input type="text" id="calle" name="Calle" value="{{$calle}}" readonly>
            </div>
        
            <label for="numero">
                Numero
            </label>
            <div>
                <input type="text" id="numero" name="Numero" value="{{$numero}}" readonly>
            </div>
        
            <label for="cp">
                Cp
            </label>
            <div>
                <input type="text" id="cp" name="Cp" value="{{$cp}}" readonly>
            </div>
        
            <label for="ciudad">
                Ciudad
            </label>
            <div>
                <input type="text" id="ciudad" name="Ciudad" value="{{$ciudad}}" readonly>
            </div>
        
            <label for="logp">
                Logo
            </label>
            <div>
                <input type="text" id="logo" name="Logo" value="{{$logo}}" readonly>
            </div>
        
            <button type="submit">
                Aceptar
            </button>
        </form>
    </body>
    <script>
        let boton=document.getElementsByTagName("button")[0];
        boton.click();
    </script>
</html>