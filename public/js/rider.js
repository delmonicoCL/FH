document.addEventListener('DOMContentLoaded', function () {

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
                createPua(latitud, longitud, cantidad_de_personas);
                modoPua = false;
                modal.style.display = "none";
            };
        }
    });

    var modalPerfil = document.getElementById("modal-perfil");
    var boton_perfil = document.getElementById('boton-perfil');

    boton_perfil.addEventListener('click', function (){
        modalPerfil.style.display = "block";
        var closeButtonPerfil = document.getElementById('closeButtonPerfil');

        closeButtonPerfil.addEventListener('click', function() {
            modalPerfil.style.display = "none";
        });
    });

    var modalReservas = document.getElementById("modal-reservas");
    var boton_reservas = document.getElementById('boton-reservas');

    boton_reservas.addEventListener('click', function (){
        modalReservas.style.display = "block";
        var closeButtonReservas = document.getElementById('closeButtonReservas');

        closeButtonReservas.addEventListener('click', function() {
            modalReservas.style.display = "none";
        });
    });


    var modalHistorial = document.getElementById("modal-historial");
    var boton_historial = document.getElementById('boton-historial');

    boton_historial.addEventListener('click', function (){
        modalHistorial.style.display = "block";
        var closeButtonHistorial = document.getElementById('closeButtonHistorial');

        closeButtonHistorial.addEventListener('click', function() {
            modalHistorial.style.display = "none";
        });
    });

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
                    addMarkerToMap(pua);
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
        "<button class='boton-entregar'>Entregar</button>";
    
        var popup = new mapboxgl.Popup()
            .setHTML(description);
    
        marker.setPopup(popup);
    
        popup.on('open', function() {
            var botonEntregar = document.querySelector('.boton-entregar');
    
            botonEntregar.addEventListener('click', function (){
                // Realizar una solicitud para entregar la PUA
                fetch(`/FH/public/api/puas`, {
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
            });
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
    
    function createPua(latitud, longitud, cantidad_de_personas) {
        fetch('/FH/public/api/puas', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                cantidad_de_personas: cantidad_de_personas,
                lat: latitud,
                lng: longitud
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
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////











      
      let etiquetaBody = document.getElementsByTagName("body")[0];
      
      let panelRutas = new MapboxDirections({
        accessToken: 'pk.eyJ1IjoiZG5lcml6IiwiYSI6ImNsdHJrN3ppZjAxYmsya3BqcWRsYzdkam8ifQ.gjTWrYyirEhh94V_agnuhQ'
      });
      
      let capaRuta; // Variable para almacenar la referencia a la capa de la ruta
      
      map.addControl(panelRutas, 'top-left');
      
      etiquetaBody.addEventListener("click", function (event) {
        if (event.target.id === "botonMarcarRuta") {
          event.target.setAttribute("value", "Desmarcar ruta");
          event.target.setAttribute("id", "botonDesmarcarRuta");
      
          navigator.geolocation.getCurrentPosition(function (position) {
            let latitudOrigen = position.coords.latitude;
            let longitudOrigen = position.coords.longitude;
      
            panelRutas.setOrigin([longitudOrigen, latitudOrigen]);
            panelRutas.setDestination([event.target.getAttribute("data-longitud"), event.target.getAttribute("data-latitud")]);
      
            panelRutas.on('route', function (e) {
              var route = e.route[0];
      
              capaRuta = map.addLayer({ // Almacena la referencia a la capa
                id: 'ruta',
                type: 'line',
                source: {
                  type: 'geojson',
                  data: {
                    type: 'Feature',
                    properties: {},
                    geometry: route.geometry
                  }
                },
                layout: {
                  'line-join': 'round',
                  'line-cap': 'round'
                },
                paint: {
                  'line-color': '#3887be',
                  'line-width': 8,
                  'line-opacity': 0.75
                }
              });
            });
          });
        } else if (event.target.id === "botonDesmarcarRuta") {
          // Elimina la capa existente
          if (capaRuta) {
            map.removeLayer(capaRuta.getId());
            map.removeSource(capaRuta.getId());
          }
      
          event.target.setAttribute("value", "Marcar ruta");
          event.target.setAttribute("id", "botonMarcarRuta");
        }
      });
});