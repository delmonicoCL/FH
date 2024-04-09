document.addEventListener('DOMContentLoaded', function () {
    mapboxgl.accessToken = 'pk.eyJ1IjoiZG5lcml6IiwiYSI6ImNsdHJrN3ppZjAxYmsya3BqcWRsYzdkam8ifQ.gjTWrYyirEhh94V_agnuhQ';
    var modoPua = false;
    var markersData = []; // Array para almacenar datos de las marcas
    var puaNames = {}; // Objeto para almacenar los nombres de las puas

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
    });

    var createMarkerButton = document.getElementById('createMarkerButton');

    createMarkerButton.addEventListener('click', function () {
        // Cambiar el estado del modoPua
        modoPua = !modoPua;

        // Actualizar el estilo del botón
        updateButtonStyle();

        // Cambiar el cursor del mapa según el estado de modoPua
        if (modoPua) {
            map.getCanvas().style.cursor = 'pointer';
        } else {
            map.getCanvas().style.cursor = '';
        }
    });


    map.on('click', function (e) {
        if (modoPua) {
            // Mostrar modal para preguntas
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
            document.getElementById("puaForm").reset();
            var closeButton = document.getElementById("closeButton");
            
            closeButton.onclick = function() {
                modal.style.display = "none";
            }
            // Obtener elementos del modal
            var nombrePuaInput = document.getElementById("nombrePua");
            var numpersonasInput = document.getElementById("numpersonas");
            var submitButton = document.getElementById("submitForm");

            // Definir evento de clic para el botón de envío del formulario
            submitButton.onclick = function () {
                var nombrePua = nombrePuaInput.value;
                var numpersonas = numpersonasInput.value;

                // Validar que el nombre de la pua no esté vacío
                if (nombrePua.trim() === '') {
                    alert("El nombre de la pua no puede estar vacío.");
                    return;
                }

                // Crear la pua en el mapa
                const nuevaPuaId = markersData.length + 1;

                // Guardar los datos de la pua para su uso posterior
                markersData.push({
                    id: nuevaPuaId,
                    coordinates: e.lngLat,
                    nombre: nombrePua,
                    numpersonas: numpersonas,
                });

                // Actualizar el mapa con el nuevo popup de la pua
                var description = "<h3>" + nombrePua + "</h3>" +
                    "<p>Numero de personas: " + numpersonas + "</p>";

                new mapboxgl.Marker({
                    color: "#fcba03",
                    draggable: false
                })
                .setLngLat(e.lngLat)
                .setPopup(new mapboxgl.Popup().setHTML(description))
                .addTo(map);

                // Reiniciar el modoPua
                modoPua = false;
                updateButtonStyle();
                map.getCanvas().style.cursor = '';

                // Cerrar el modal
                modal.style.display = "none";
            };
        }
    });

    var modalPerfil = document.getElementById("modal-perfil"); // Agregamos la referencia al modal de reservas
    var boton_perfil = document.getElementById('boton-perfil');

    boton_perfil.addEventListener('click', function (){
        modalPerfil.style.display = "block";
        var closeButtonReservas = document.getElementById('closeButtonPerfil');

        // Agrega un evento de clic al botón de cierre
        closeButtonPerfil.addEventListener('click', function() {
            // Oculta el modal de reservas
            modalPerfil.style.display = "none";
        });
    });


    var modalReservas = document.getElementById("modal-reservas"); // Agregamos la referencia al modal de reservas
    var boton_reservas = document.getElementById('boton-reservas');

    boton_reservas.addEventListener('click', function (){
        modalReservas.style.display = "block";
        var closeButtonReservas = document.getElementById('closeButtonReservas');

        // Agrega un evento de clic al botón de cierre
        closeButtonReservas.addEventListener('click', function() {
            // Oculta el modal de reservas
            modalReservas.style.display = "none";
        });
    });
    
    var modalHistorial = document.getElementById("modal-historial"); // Agregamos la referencia al modal de reservas
    var boton_historial = document.getElementById('boton-historial');

    boton_historial.addEventListener('click', function (){
        modalHistorial.style.display = "block";
        var closeButtonHistorial = document.getElementById('closeButtonHistorial');

        // Agrega un evento de clic al botón de cierre
        closeButtonHistorial.addEventListener('click', function() {
            // Oculta el modal de reservas
            modalHistorial.style.display = "none";
        });
    });

    function updateButtonStyle() {
        // Actualizar el estilo del botón según el estado de modoPua
        if (modoPua) {
            createMarkerButton.classList.add('active');
        } else {
            createMarkerButton.classList.remove('active');
        }
    }

    // Cambiar el cursor al pasar sobre una pua
    map.on('mouseenter', function () {
        map.getCanvas().style.cursor = 'pointer';
    });

    map.on('mouseleave', function () {
        map.getCanvas().style.cursor = '';
    });
    
    // Obtener la lista de Riders desde la base de datos y llenar el select
    fetch('/api/riders')
        .then(response => response.json())
        .then(data => {
            const selectRider = document.getElementById('rider');
            data.forEach(rider => {
                const option = document.createElement('option');
                option.value = rider.id;
                option.text = rider.nombre; // Suponiendo que 'nombre' es el campo que contiene el nombre del Rider
                selectRider.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching Riders:', error));

    // Escuchar el evento de clic en el botón de envío del formulario
    document.getElementById('submitForm').addEventListener('click', function () {
        const riderId = document.getElementById('rider').value;
        const numpersonas = document.getElementById('numpersonas').value;

        // Crear la Pua en la base de datos usando los datos del formulario
        fetch('/api/puas/store-from-form', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                rider_id: riderId,
                cantidad_de_personas: numpersonas
            })
        })
        .then(response => {
            if (response.ok) {
                // La Pua se creó correctamente
                console.log('Pua creada exitosamente.');
                // Aquí podrías realizar alguna acción adicional, como cerrar el modal o actualizar la lista de PUAs en el mapa
            } else {
                // Hubo un error al crear la Pua
                console.error('Error al crear la Pua:', response.statusText);
            }
        })
        .catch(error => console.error('Error en la solicitud fetch:', error));
    });


});
