document.addEventListener("DOMContentLoaded", function () {
    mapboxgl.accessToken =
        "pk.eyJ1IjoiZG5lcml6IiwiYSI6ImNsdHJrN3ppZjAxYmsya3BqcWRsYzdkam8ifQ.gjTWrYyirEhh94V_agnuhQ";
    var modoPua = false;

    var removeAttributionControl = function () {
        var attribControl = document.querySelector(".mapboxgl-ctrl-attrib");
        if (attribControl) {
            attribControl.parentNode.removeChild(attribControl);
        }
    };

    var map = new mapboxgl.Map({
        container: "map",
        style: "mapbox://styles/mapbox/streets-v11",
        center: [2.1734, 41.3851],
        zoom: 13,
    });

    map.on("load", function () {
        removeAttributionControl();
        loadMarkers();
        loadMarkersProveedores();
    });

    var createMarkerButton = document.getElementById("createMarkerButton");
    if (createMarkerButton) {
        createMarkerButton.addEventListener("click", function () {
            modoPua = !modoPua;
            updateButtonStyle();
            if (modoPua) {
                map.getCanvas().style.cursor = "pointer";
            } else {
                map.getCanvas().style.cursor = "";
            }
        });
    }

    function updateButtonStyle() {
        if (modoPua) {
            createMarkerButton.classList.add("active");
        } else {
            createMarkerButton.classList.remove("active");
        }
    }

    map.on("mouseenter", function () {
        map.getCanvas().style.cursor = "pointer";
    });

    map.on("mouseleave", function () {
        map.getCanvas().style.cursor = "";
    });

    function loadMarkers() {
        fetch("/FH/public/api/puas")
            .then((response) => response.json())
            .then((data) => {
                data.forEach((pua) => {
                    addMarkerToMap(pua);
                });
            })
            .catch((error) => console.error("Error fetching PUAs:", error));
    }

    function loadMarkersProveedores() {
        fetch("/FH/public/api/proveedores")
            .then((response) => response.json())
            .then((data) => {
                data.forEach((proveedor) => {
                    addMarkerToMapProveedores(proveedor);
                });
            })
            .catch((error) =>
                console.error("Error fetching Proveedores:", error)
            );
    }

    function addMarkerToMap(pua) {
        var lngLat = [pua.lng, pua.lat];
        var marker = new mapboxgl.Marker({
            color: "#fcba03",
            draggable: false,
        })
            .setLngLat(lngLat)
            .addTo(map);

        var description =
            "<h2><p>Numero de personas: " +
            pua.cantidad_de_personas +
            "</p></h2>";

        var popup = new mapboxgl.Popup().setHTML(description);

        marker.setPopup(popup);
    }

    function addMarkerToMapProveedores(proveedor) {
        var lngLat = [proveedor.lng, proveedor.lat];
        var marker = new mapboxgl.Marker({
            color: "red",
            draggable: false,
        })
            .setLngLat(lngLat)
            .addTo(map);

        var description =
            "<h2>" +
            proveedor.logo +
            "</h2>" +
            "<h2><p>Stock proveedor: " +
            proveedor.stock_proveedor +
            "</p></h2>";

        var popup = new mapboxgl.Popup().setHTML(description);

        marker.setPopup(popup);

        popup.on("open", function () {
            var modalReservar = document.getElementById("modal-reservar");

            var closeButtonReservar = document.getElementById(
                "closeButtonReservar"
            );

            closeButtonReservar.addEventListener("click", function () {
                modalReservar.style.display = "none";
            });
        });
    }
});
