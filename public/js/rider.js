document.addEventListener('DOMContentLoaded', function () {
    mapboxgl.accessToken = 'pk.eyJ1IjoiZG5lcml6IiwiYSI6ImNsdHJrN3ppZjAxYmsya3BqcWRsYzdkam8ifQ.gjTWrYyirEhh94V_agnuhQ';
    var modoPua = false;

    var removeAttributionControl = function () {
        var attribControl = document.querySelector('.mapboxgl-ctrl-attrib');
        if (attribControl) {
            attribControl.parentNode.removeChild(attribControl);
        }
    };

    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [2.1734, 41.3851],
        zoom: 13
    });

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
        var marker = new mapboxgl.Marker({
            color: "red",
            draggable: false
        })
        .setLngLat(lngLat)
        .addTo(map);
    
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


});