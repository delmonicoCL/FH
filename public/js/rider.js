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
    });

    var createMarkerButton = document.getElementById('createMarkerButton');
    createMarkerButton.addEventListener('click', function () {
        modoPua = !modoPua;
        updateButtonStyle();
        if (modoPua) {
            map.getCanvas().style.cursor = 'pointer';
        } else {
            map.getCanvas().style.cursor = '';
        }
    });

    map.on('click', function (e) {
        if (modoPua) {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
            document.getElementById("puaForm").reset();
            var closeButton = document.getElementById("closeButton");
            closeButton.onclick = function() {
                modal.style.display = "none";
            }
            var numpersonasInput = document.getElementById("numpersonas");
            var submitButton = document.getElementById("submitForm");
            submitButton.onclick = function () {
                var numpersonas = numpersonasInput.value;
                var latitud = e.lngLat.lat;
                var longitud = e.lngLat.lng;
                createPua(latitud, longitud, numpersonas);
                modal.style.display = "none";
            };
        }
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

    function addMarkerToMap(pua) {
        var lngLat = [pua.lng, pua.lat];
        var marker = new mapboxgl.Marker({
            color: "#fcba03",
            draggable: false
        })
        .setLngLat(lngLat)
        .addTo(map);

        var description = "<h3>" + pua.nombre + "</h3>" +
            "<p>Numero de personas: " + pua.cantidad_de_personas + "</p>";

        var popup = new mapboxgl.Popup()
            .setHTML(description);

        marker.setPopup(popup);
    }

    function createPua(latitud, longitud, numpersonas) {
        fetch('/FH/public/api/puas', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                numpersonas: numpersonas,
                lat: latitud,
                lng: longitud
            })
        })
        .then(response => {
            if (response.ok) {
                console.log('Pua creada exitosamente.');
                // Actualizar los marcadores en el mapa después de crear una nueva pua
                loadMarkers();
            } else {
                console.error('Error al crear la Pua:', response.statusText);
            }
        })
        .catch(error => console.error('Error en la solicitud fetch:', error));
    }
});
