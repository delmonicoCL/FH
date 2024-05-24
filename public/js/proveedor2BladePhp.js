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
                            event.target.setAttribute("disabled","true");
                            obtenerStockRider(idRider.value)
                            .then
                            (
                                (stockRider) =>
                                {
                                    sumarMenusAlRider(idRider.value,cantidadDeMenusReservados.value,stockRider);
                                    pasarReservaAFinalizada(idReserva.value);
                                    crearEntrega(idRider.value);
                                    location.reload();
                                }
                            )
                            .catch
                            (
                                (error) => 
                                {
                                    console.error("Error al obtener el stock del rider:", error);
                                    // Haz algo si ocurre un error al obtener el stock del rider
                                }
                            );
                        }
                    }
                    if(event.target.id==="crearBtn")
                    {
                        event.target.setAttribute("disables","true");
                    }
                }
            );
        }
        function sumarMenusAlRider(idRider,cantidadDeMenusReservados,stockRider)
        {
            let agregarReservasAlStock;
            agregarReservasAlStock=Number(stockRider)+Number(cantidadDeMenusReservados);
            fetch
            (
                '/FH/public/api/riders/'+idRider,
                {
                    method: "PUT", // Utilizando el método PUT para actualizar recursos en el servidor
                    body: JSON.stringify
                    (
                        {
                            StockRider: agregarReservasAlStock
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
        function pasarReservaAFinalizada(idReserva)
        {
            fetch
            (
                '/FH/public/api/reservas/'+idReserva,
                {
                    method: "PUT", // Utilizando el método PUT para actualizar recursos en el servidor
                    body: JSON.stringify
                    (
                        {
                            Estado: "finalizada"
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
        function obtenerStockRider(idRider)
        {
            return fetch
            (
                '/FH/public/api/riders/'+idRider,
                {
                    method: "GET",
                    headers:
                    {
                        "Content-Type": "application/json",
                    },
                }
            )
            .then
            (
                (res) =>
                {
                    if (!res.ok)
                    {
                        throw new Error("Network response was not ok");
                    }
                    return res.json();
                }
            )
            .then
            (
                (data) =>
                {
                    console.log("Data received:");
                    let stockRider = data.stock_rider;
                    return stockRider;
                }
            )
            .catch
            (
                (error) =>
                {
                    console.error("Error:", error);
                    throw error; // Re-lanzamos el error para que pueda ser manejado externamente si es necesario
                }
            );
        }
        function crearEntrega(idRider)
        {
            fetch
            (
                '/FH/public/api/entregas',
                {
                    method: "POST", // Utilizando el método PUT para actualizar recursos en el servidor
                    body: JSON.stringify
                    (
                        {
                            Rider: idRider,
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
    }
);