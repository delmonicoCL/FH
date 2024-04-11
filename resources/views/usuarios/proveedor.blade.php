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

            <label for="logo">
                Logo
            </label>
            <div>
                <input type="text" id="logo" name="Logo" value="{{$logo}}" readonly>
            </div>

            <label for="latitud">
                Latitud
            </label>
            <div>
                <input type="text" id="latitud" name="Latitud" readonly>
            </div>

            <label for="longitud">
                Longitud
            </label>
            <div>
                <input type="text" id="longitud" name="Longitud" readonly>
            </div>
        
            <button type="submit">
                Aceptar
            </button>
        </form>
    </body>
    <script>

        let inputLatitud=document.getElementById("latitud");
        let inputLongitud=document.getElementById("longitud");

        // Definir la dirección a buscar
        let calle=document.getElementById("calle").value;
        let numero=document.getElementById("numero").value;
        let cp=document.getElementById("cp").value;
        let ciudad=document.getElementById("ciudad").value;
        let direccion=calle+", "+numero+", "+cp+", "+ciudad;

        // Configurar la URL de la API de geocodificación de Mapbox
        const url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${direccion}.json?access_token=pk.eyJ1Ijoib2FycmlhemEiLCJhIjoiY2x1cG9nc2hrMDZibzJqcGIzOGYzN3N3aiJ9.R8CTcgwHzP-_Isspx2S8lw`;

        // Función para obtener las coordenadas GPS
        async function obtenerCoordenadas(direccion)
        {
            const respuesta = await fetch(url);
            const datos = await respuesta.json();
            return datos.features[0].center;
        }

        // Obtener las coordenadas GPS
        obtenerCoordenadas(direccion).then
        (
            (coordenadas) =>
            {
                //Añadir las coordenadas al formulario
                /*console.log("Latitud: "+coordenadas[1]);
                console.log("Longitud: "+coordenadas[0]);*/
                
                /*inputLatitud.value=coordenadas[1];
                inputLongitud.value=coordenadas[0];*/

                inputLatitud.setAttribute("value",coordenadas[1]);
                inputLongitud.setAttribute("value",coordenadas[0]);

                let boton=document.getElementsByTagName("button")[0];
                boton.click();
            }
        );
    </script>
</html>