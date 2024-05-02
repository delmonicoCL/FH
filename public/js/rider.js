document.addEventListener('DOMContentLoaded', function () {
    let idRider;
    let stockRider;
    idRider=document.getElementById("idRider").textContent;
    stockRider=Number(document.getElementById("stockRider").textContent);

    mapboxgl.accessToken = 'pk.eyJ1IjoiZG5lcml6IiwiYSI6ImNsdHJrN3ppZjAxYmsya3BqcWRsYzdkam8ifQ.gjTWrYyirEhh94V_agnuhQ';
    var modoPua = false;

    var removeAttributionControl = function () {
        var attribControl = document.querySelector('.mapboxgl-ctrl-attrib');
        if (attribControl) {
            attribControl.parentNode.removeChild(attribControl);
        }
    };

    var map = new mapboxgl.Map
    (
        {
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            /*center: [2.1734, 41.3851],
            zoom: 13*/
        }
    );

    // Obtener la posición actual usando la API de geolocalización
    navigator.geolocation.getCurrentPosition
    (
        function(position)
        {
            let latitud = position.coords.latitude;
            let longitud = position.coords.longitude;

            // Mostrar la ubicación en el mapa
            let marcador = new mapboxgl.Marker
            (
                {
                    color: "blue",
                    draggable: false
                }
            ).setLngLat([longitud, latitud]).addTo(map);

            let description = "<h2>Estás aquí</h2>";
    
            let popup = new mapboxgl.Popup().setHTML(description);

            marcador.setPopup(popup);

            /*map.addLayer
            (
                {
                    id: 'ubicacion-usuario',
                    type: 'symbol',
                    source:
                    {
                        type: 'geojson',
                        data:
                        {
                            type: 'FeatureCollection',
                            features:
                            [
                                {
                                    type: 'Feature',
                                    geometry:
                                    {
                                        type: 'Point',
                                        coordinates: [longitud, latitud],
                                    },
                                    properties:
                                    {
                                        title: 'Estás aquí',
                                    },
                                }
                            ],
                        },
                    },
                    layout:
                    {
                        'icon-image': 'marker-icon', // Reemplaza 'marker-icon' con la ID de tu icono personalizado
                    },
                }
            );*/

            // Centrar el mapa en la ubicación del usuario
            map.flyTo
            (
                {
                    center: [longitud, latitud],
                    zoom: 17,
                }
            );

            // Actualizar la posición del marcador cada segundo
            setInterval
            (
                () => 
                {
                    navigator.geolocation.getCurrentPosition
                    (
                        function(position)
                        {
                            const nuevaLatitud = position.coords.latitude;
                            const nuevaLongitud = position.coords.longitude;

                            if (nuevaLatitud !== latitud || nuevaLongitud !== longitud)
                            {
                                marcador.setLngLat([nuevaLongitud, nuevaLatitud]);
                            }
                        }
                    );
                },
                1000
            );
        }
    );

    map.on('load', function () {
        removeAttributionControl();
        loadMarkers();
        loadMarkersProveedores();
    });

    var createMarkerButton = document.getElementById('createMarkerButton');
    if (createMarkerButton) {
        createMarkerButton.addEventListener('click', function () {
            modoPua = !modoPua;
            updateButtonStyle();
            if (modoPua) {
                map.getCanvas().style.cursor = 'pointer';
            } else {
                map.getCanvas().style.cursor = '';
            }
        });
    }

    map.on('click', function (e) {
        if (modoPua) {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
            document.getElementById("puaForm").reset();
            var closeButton = document.getElementById("closeButton");
            closeButton.onclick = function() {
                modal.style.display = "none";
            }
            var cantidad_de_personasInput = document.getElementById("cantidad_de_personas");
            var submitButton = document.getElementById("submitForm");
            submitButton.onclick = function () {
                var cantidad_de_personas = cantidad_de_personasInput.value;
                var latitud = e.lngLat.lat;
                var longitud = e.lngLat.lng;
                var rider_creador= idRider;
                createPua(latitud, longitud, cantidad_de_personas, rider_creador);
                modoPua = false;
                modal.style.display = "none";
            };
        }
    });

    var modalPerfil = document.getElementById("modal-perfil");
    var boton_perfil = document.getElementById('boton-perfil');

    boton_perfil.addEventListener('click', function (){
        modalPerfil.style.display = "block";
    });

    var closeButtonPerfil = document.getElementById('closeButtonPerfil');

    closeButtonPerfil.addEventListener('click', function() {
        modalPerfil.style.display = "none";
    });

    var botonEditarPerfil = document.getElementById('editarPerfil');
    if (botonEditarPerfil) {
        botonEditarPerfil.addEventListener('click', function () {
            var modalEditarPerfil = document.getElementById("modal-editar-perfil");
            modalPerfil.style.display = "none";
            modalEditarPerfil.style.display = "block";
        });
    }

    var closeButtonEditarPerfil = document.getElementById('closeButtonEditarPerfil');
    if (closeButtonEditarPerfil) {
        closeButtonEditarPerfil.addEventListener('click', function () {
            var modalEditarPerfil = document.getElementById("modal-editar-perfil");
            modalEditarPerfil.style.display = "none";
        });
    }

    

    var modalReservas = document.getElementById("modal-reservas");
    var boton_reservas = document.getElementById('boton-reservas');

    boton_reservas.addEventListener('click', function (){
        modalReservas.style.display = "block";
        var closeButtonReservas = document.getElementById('closeButtonReservas');

        closeButtonReservas.addEventListener('click', function() {
            modalReservas.style.display = "none";
        });
    });


    // var modalHistorial = document.getElementById("modal-historial");
    // var boton_historial = document.getElementById('boton-historial');

    // boton_historial.addEventListener('click', function (){
    //     modalHistorial.style.display = "block";
    //     var closeButtonHistorial = document.getElementById('closeButtonHistorial');

    //     closeButtonHistorial.addEventListener('click', function() {
    //         modalHistorial.style.display = "none";
    //     });
    // });

    function updateButtonStyle() {
        if (modoPua) {
            createMarkerButton.classList.add('active');
        } else {
            createMarkerButton.classList.remove('active');
        }
    }

    map.on('mouseenter', function () {
        map.getCanvas().style.cursor = 'pointer';
    });

    map.on('mouseleave', function () {
        map.getCanvas().style.cursor = '';
    });

    function loadMarkers() {
        fetch('/FH/public/api/puas')
            .then(response => response.json())
            .then(data => {
                data.forEach(pua => {
                    if(stockRider>=pua.cantidad_de_personas)
                    {
                        addMarkerToMap(pua);
                    }
                });
            })
            .catch(error => console.error('Error fetching PUAs:', error));
    }

    function loadMarkersProveedores()
    {
        fetch('/FH/public/api/proveedores')
        .then(response => response.json())
        .then(data => {
            data.forEach(proveedor =>{
                if (proveedor.stock_proveedor !== 0) {
                    addMarkerToMapProveedores(proveedor);
                }
            });
        })
        .catch(error => console.error('Error fetching Proveedores:', error));   
    }

    function addMarkerToMap(pua) {
        var lngLat = [pua.lng, pua.lat];
        var marker = new mapboxgl.Marker({
            color: "#fcba03",
            draggable: false
        })
        .setLngLat(lngLat)
        .addTo(map);
    
        var description = "<h2><p>Numero de personas: " + pua.cantidad_de_personas + "</p></h2>" +
            "<div style='display:flex; align-items: center; justify-content: space-around'><input type='button' class='btn btn-success botonEntregar' data-idPua='"+pua.id+"' data-cantidadDePersonas='"+pua.cantidad_de_personas+"' value='Entregar'><input type='button' class='btn btn-warning botonMarcarRutaPua' data-latitud='"+pua.lat+"' data-longitud='"+pua.lng+"' value='Marcar ruta'></div>";
    
        var popup = new mapboxgl.Popup()
            .setHTML(description);
    
        marker.setPopup(popup);
    
        popup.on('open', function() {
            //var botonesEntregar = document.getElementsByClassName('btn btn-success botonEntregar');
    
            /*botonEntregar.addEventListener('click', function (){
                // Obtener la ID de la PUA
                var puaId = pua.id;
            
                // Realizar una solicitud para entregar la PUA
                try {
                    fetch(`/FH/public/api/puas/${puaId}/entregar`, { // Se agrega el endpoint correcto para entregar la PUA
                        method: 'POST'
                    })                
                    .then(response => response.json())
                    .then(data => {
                        // Actualizar la vista o mostrar un mensaje de éxito
                        alert(data.message);
                        // Actualizar los marcadores después de la entrega
                        loadMarkers();
                    })
                    .catch(error => {
                        console.error('Error entregando PUA:', error);
                        // Mostrar un mensaje de error si la entrega falla
                        alert('Error al entregar la PUA.');
                    });
                } catch (error) {
                    console.error('Error al realizar la solicitud POST:', error);
                    alert('Error al realizar la solicitud POST.');
                }
            });*/            
        });
    }    

    function addMarkerToMapProveedores(proveedor) {
        var lngLat = [proveedor.lng, proveedor.lat];
        var marker = new mapboxgl.Marker
        (
            {
                color: "red",
                draggable: false
            }
        ).setLngLat(lngLat).addTo(map);
    
        var description = "<h2>" + proveedor.logo + "</h2>" +
            "<h2><p>Stock proveedor: " + proveedor.stock_proveedor + "</p></h2>" +
            "<button class='boton-reservar'>Reservar</button>";
    
        var popup = new mapboxgl.Popup()
            .setHTML(description);
    
        marker.setPopup(popup);
    
        popup.on('open', function() {
            var botonReservar = document.querySelector('.boton-reservar');
            var modalReservar = document.getElementById("modal-reservar");
            var cantidadInput = document.getElementById('cantidad');
            var enviarReservaBtn = document.getElementById('enviarReserva'); // Cambiado a enviarReserva
        
            botonReservar.addEventListener('click', function (){
                // Obtener la cantidad de personas a reservar
                var cantidadReserva = parseInt(cantidadInput.value);
        
                // Verificar si la cantidad de personas a reservar supera el stock
                if (cantidadReserva > proveedor.stock_proveedor) {
                    // Mostrar una alerta en pantalla
                    alert("La cantidad de personas a reservar excede el stock disponible.");
                    return;
                }
        
                // Si la reserva es válida, mostrar el modal de reserva y establecer el ID del proveedor
                modalReservar.style.display = "block";
                document.getElementById('proveedor').value = proveedor.id;
            });
        
            var closeButtonReservar = document.getElementById('closeButtonReservar');
        
            closeButtonReservar.addEventListener('click', function() {
                modalReservar.style.display = "none";
            });
        
            // Desactivar el botón de enviar si la cantidad supera el stock
            cantidadInput.addEventListener('input', function() {
                var cantidadReserva = parseInt(cantidadInput.value);
        
                if (cantidadReserva > proveedor.stock_proveedor) {
                    enviarReservaBtn.disabled = true; // Desactivar el botón de enviar
                    // Cambiar el estilo del input para indicar que la cantidad es mayor que el stock
                    cantidadInput.style.backgroundColor = 'rgba(255, 0, 0, 0.2)'; // Fondo rojo claro
                    cantidadInput.style.borderColor = 'red'; // Borde rojo
                    cantidadInput.setCustomValidity('La cantidad ingresada es mayor que el stock disponible');
                } else {
                    enviarReservaBtn.disabled = false; // Activar el botón de enviar
                    // Restaurar el estilo del input
                    cantidadInput.style.backgroundColor = ''; // Restaurar el fondo
                    cantidadInput.style.borderColor = ''; // Restaurar el borde
                    cantidadInput.setCustomValidity(''); // Restaurar el mensaje de validación personalizado
                }
            });
        });
        
    }
    
    function createPua(latitud, longitud, cantidad_de_personas, rider_creador) {
        fetch('/FH/public/api/puas', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                cantidad_de_personas: cantidad_de_personas,
                lat: latitud,
                lng: longitud,
                rider_creador: rider_creador// Utilizando rider_creador como nombre de campo
            }) 
        })
        .then(response => {
            loadMarkers();
            modoPua = false;
    
            // Desactivar el modo Pua
            document.getElementById('createMarkerButton').classList.remove('active');
    
            // Actualizar los marcadores en el mapa
            updateButtonStyle();
        })
        .catch(error => console.error('Error creating PUA:', error));
    }
    
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////// Mostrar las rutas //////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    let etiquetaBody=document.getElementsByTagName("body")[0];
    var modalAvatares = document.getElementById("modal-avatares");

    let panelRutas;

    let numeroDeBotonesDesmarcarRutaPua=0;

    let botonDesmarcarRutaPuaSeleccionado;

    etiquetaBody.addEventListener
    (
        "click",
        function(event)
        {
            if(event.target.className==="btn btn-warning botonMarcarRuta")
            {
                event.target.setAttribute("class","btn btn-warning botonDesmarcarRuta");
                bloquearBotonesMarcarRuta();
                event.target.setAttribute("value","Desmarcar ruta");
                generarRuta(event.target);
            }
            else if(event.target.className==="btn btn-warning botonDesmarcarRuta")
            {
                map.removeControl(panelRutas);

                map.removeLayer("ruta");
                map.removeSource('ruta');

                desbloquearBotonesMarcarRuta();
                event.target.setAttribute("class","btn btn-warning botonMarcarRuta");
                event.target.setAttribute("value","Marcar ruta");
            }

            if(event.target.id==="imagenAvatar")
            {
                modalAvatares.style.display = "block";
            }
            if(event.target.id==="closeButtonAvatares")
            {
                modalAvatares.style.display = "none";
            }

            if(event.target.className==="btn btn-warning botonMarcarRutaPua")
            {
                if(verificarSiSeEstaMostrandoRutaParaProveedor())
                {
                    let botonDesmarcarRuta=document.getElementsByClassName("btn btn-warning botonDesmarcarRuta")[0];
                    botonDesmarcarRuta.click();

                    botonDesmarcarRutaPuaSeleccionado=event.target;
                    iniciarProcesoPrevioAGenerarRutaPua(event.target);
                    generarRuta(event.target);
                }
                else
                {
                    if(verificarSiSeEstaMostrandoRutaParaPua())
                    {
                        botonDesmarcarRutaPuaSeleccionado.setAttribute("class","btn btn-warning botonMarcarRutaPua");
                        botonDesmarcarRutaPuaSeleccionado.setAttribute("value","Marcar ruta");

                        map.removeControl(panelRutas);

                        map.removeLayer("ruta");
                        map.removeSource('ruta');

                        numeroDeBotonesDesmarcarRutaPua--;

                        botonDesmarcarRutaPuaSeleccionado=event.target;
                        iniciarProcesoPrevioAGenerarRutaPua(event.target);
                        generarRuta(event.target);
                    }
                    else
                    {
                        botonDesmarcarRutaPuaSeleccionado=event.target;
                        iniciarProcesoPrevioAGenerarRutaPua(event.target);
                        generarRuta(event.target);
                    }
                }
            }
            else if(event.target.className==="btn btn-warning botonDesmarcarRutaPua")
            {
                map.removeControl(panelRutas);

                map.removeLayer("ruta");
                map.removeSource('ruta');

                numeroDeBotonesDesmarcarRutaPua--;

                desbloquearBotonesMarcarRuta();
                event.target.setAttribute("class","btn btn-warning botonMarcarRutaPua");
                event.target.setAttribute("value","Marcar ruta");
            }

            if(event.target.className==="btn btn-success botonEntregar")
            {
                obtenerLosIdsDeLasEntregas()
                .then
                (
                    (idsDeLasEntregas) =>
                    {
                        let idPua;
                        idPua=event.target.getAttribute("data-idPua");
                        pasarEntregaAFinalizada(idsDeLasEntregas[0],idPua);
                        //restarLosMenusEntregadosDelStockDelRider();
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
    );

    function bloquearBotonesMarcarRuta()
    {
        let botonesMarcarRuta=document.getElementsByClassName("btn btn-warning botonMarcarRuta")
        for (let botonMarcarRuta of botonesMarcarRuta)
        {
            botonMarcarRuta.setAttribute("disabled","true");
        }
    }
    function desbloquearBotonesMarcarRuta()
    {
        let botonesMarcarRuta=document.getElementsByClassName("btn btn-warning botonMarcarRuta")
        for (let botonMarcarRuta of botonesMarcarRuta)
        {
            botonMarcarRuta.removeAttribute("disabled");
        }
    }
    function verificarSiSeEstaMostrandoRutaParaProveedor()
    {
        let botonesDesmarcarRuta=document.getElementsByClassName("btn btn-warning botonDesmarcarRuta");
        let seEstaMostrandoRutaParaProveedor=true;
        if(botonesDesmarcarRuta.length===0)
        {
            seEstaMostrandoRutaParaProveedor=false;
        }
        return seEstaMostrandoRutaParaProveedor;
    }
    function generarRuta(elementoTarget)
    {
        navigator.geolocation.getCurrentPosition
        (
            function(position)
            {
                panelRutas=new MapboxDirections(
                    {
                        accessToken: 'pk.eyJ1IjoiZG5lcml6IiwiYSI6ImNsdHJrN3ppZjAxYmsya3BqcWRsYzdkam8ifQ.gjTWrYyirEhh94V_agnuhQ',
                        interactive: false
                    }
                );

                map.addControl(
                    panelRutas,
                    'top-left'
                );

                let latitudOrigen = position.coords.latitude;
                let longitudOrigen = position.coords.longitude;

                panelRutas.setOrigin([longitudOrigen, latitudOrigen]);
                panelRutas.setDestination([elementoTarget.getAttribute("data-longitud"),elementoTarget.getAttribute("data-latitud")]);
                  
                panelRutas.on(
                    'route',
                    function(e)
                    {
                        var route = e.route[0];
                        // Puedes trabajar con la ruta aquí, por ejemplo, mostrarla en el mapa.
                        map.addLayer(
                            {
                                id: 'ruta',
                                type: 'line',
                                source:
                                {
                                    type: 'geojson',
                                    data:
                                    {
                                        type: 'Feature',
                                        properties: {},
                                        geometry: route.geometry
                                    }
                                },
                                layout:
                                {
                                    'line-join': 'round',
                                    'line-cap': 'round'
                                },
                                paint:
                                {
                                    'line-color': '#3887be',
                                    'line-width': 8,
                                    'line-opacity': 0.75
                                }
                            }
                        );
                    }
                );
            }
        );
    }
    function verificarSiSeEstaMostrandoRutaParaPua()
    {
        let seEstaMostrandoRutaParaPua=true;
        if(numeroDeBotonesDesmarcarRutaPua===0)
        {
            seEstaMostrandoRutaParaPua=false;
        }
        return seEstaMostrandoRutaParaPua;
    }
    function iniciarProcesoPrevioAGenerarRutaPua(elementoTarget)
    {
        elementoTarget.setAttribute("class","btn btn-warning botonDesmarcarRutaPua");
        bloquearBotonesMarcarRuta();
        elementoTarget.setAttribute("value","Desmarcar ruta");
        numeroDeBotonesDesmarcarRutaPua++;
    }
    function pasarEntregaAFinalizada(idEntrega,idPua)
    {
        fetch
        (
            '/FH/public/api/entregas/'+idEntrega,
            {
                method: "PUT", // Utilizando el método PUT para actualizar recursos en el servidor
                body: JSON.stringify
                (
                    {
                        Pua:idPua,
                        Estado:"entregado"
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
    function obtenerLosIdsDeLasEntregas()
    {
        return fetch
        (
            '/FH/public/api/entregas?EscalaDeConsulta=consultarLasEntregasDeUnRiderEnEspecifico&IdRider='+idRider,
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
                let idsDeLasEntregas=[];
                for (let i = 0; i < data.length; i++)
                {
                    idsDeLasEntregas.push(data[i].id);    
                }
                return idsDeLasEntregas;
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
});