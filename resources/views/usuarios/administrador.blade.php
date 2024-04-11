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
        <form action="{{action([App\Http\Controllers\AdministradorController::class,'store'])}}" class="row" method="POST" hidden>   
            @csrf
        
            <label for="id">
                id
            </label>
            <div>
                <input type="text" id="id" name="Id" value="{{$id}}" readonly>
            </div>
        
            <label for="apellidos">
                Apellidos
            </label>
            <div>
                <input type="text" id="apellidos" name="Apellidos" value="{{$apellidos}}" readonly>
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