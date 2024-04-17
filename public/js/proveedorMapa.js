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
                addMarkerToMapProveedores(proveedor);
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

        var description = "<h2><p>Numero de personas: " + pua.cantidad_de_personas + "</p></h2>";

        var popup = new mapboxgl.Popup()
            .setHTML(description);

        marker.setPopup(popup);
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
            "<h2><p>Stock proveedor: " + proveedor.stock_proveedor + "</p></h2>";
    
        var popup = new mapboxgl.Popup()
            .setHTML(description);
    
        marker.setPopup(popup);
    
        popup.on('open', function() {
            var botonReservar = document.querySelector('.boton-reservar');
            var modalReservar = document.getElementById("modal-reservar");
    
            botonReservar.addEventListener('click', function (){
                modalReservar.style.display = "block";
                document.getElementById('proveedor').value = proveedor.id;
            });
    
            var closeButtonReservar = document.getElementById('closeButtonReservar');
    
            closeButtonReservar.addEventListener('click', function() {
                modalReservar.style.display = "none";
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