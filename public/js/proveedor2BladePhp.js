document.addEventListener
(
    "DOMContentLoaded",
    function()
    {
        let contenedorPrincipal=document.getElementById("contenedorPrincipal");
        principal();
        function principal()
        {
            let idRider=document.getElementById("idRider");
            let cantidadDeMenusReservados=document.getElementById("cantidadDeMenusReservados");
            let idReserva=document.getElementById("idReserva");
            generarLogo();
            contenedorPrincipal.addEventListener
            (
                "click",
                function(event)
                {
                    if(event.target.id==="botonConfirmarEntrega")
                    {
                        if(idRider.value!=="")
                        {
                            /*console.log(idRider.value);
                            console.log(cantidadDeMenusReservados.value);*/
                            modificarRider(idRider.value,cantidadDeMenusReservados.value);
                            //pasarResevaAFinalizada();
                        }
                    }
                }
            );
        }
        function modificarRider(idRider,cantidadDeMenusReservados)
        {
            fetch
            (
                '/FH/public/api/riders/'+idRider,
                {
                    method: "PUT", // Utilizando el método PUT para actualizar recursos en el servidor
                    body: JSON.stringify
                    (
                        {
                            Stock_rider: cantidadDeMenusReservados
                        }
                    ), // Los datos que se enviarán al servidor, convertidos a JSON
                    headers:
                    {
                        "Content-Type": "application/json", // Especificando que el cuerpo de la solicitud está en formato JSON
                    },
                }
            )
            .then
            (
                (res) => res.json()
            ) // Convirtiendo la respuesta en JSON
            .catch
            (
                (error) => console.error
                (
                    "Error:",
                    error
                )
            ) // Manejando errores
            .then
            (
                (
                    response
                ) => console.log("Success:", response)
            ); // Manejando la respuesta exitosa  
        }
        function generarLogo()
        {
            let contenedorLogo=document.getElementById("contenedorLogo");
            let logo=document.createElement("img");
            logo.setAttribute("src","../storage/app/storage/logos/"+contenedorLogo.getAttribute("data-nombreDeLaImagen"));
            logo.setAttribute("alt","logo "+contenedorLogo.getAttribute("data-nombreDeLaImagen"));
            logo.setAttribute("height","225");
            logo.setAttribute("width","225");
            logo.setAttribute("class","logoProveedor");
            logo.setAttribute("id","logo"+contenedorLogo.getAttribute("data-nombreDeLaImagen"));
            logo.setAttribute("draggable","false");
            contenedorLogo.appendChild(logo);
        }
    }
);