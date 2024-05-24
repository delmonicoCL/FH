document.addEventListener
(
    "DOMContentLoaded",
    function()
    {
        let contenedorPrincipal=document.getElementById("contenedorPrincipal");
        principal();
        function principal()
        {
            contenedorPrincipal.addEventListener
            (
                "click",
                function(event)
                {
                    if(event.target.id==="aceptar")
                    {
                        if(!validaciones())
                        {
                            event.preventDefault();
                        }
                    }

                }
            );
        }
        function validaciones()
        {
            let mensajeValidacionFormulario=document.getElementById("mensajeValidacionFormularioCrearProveedor")
            let nombre=document.getElementById("nombre");
            let apellidos=document.getElementById("apellidos");
            let email=document.getElementById("email");
            let telefono=document.getElementById("telefono");

            let laTareaPasoTodasLasValidaciones=false;
            principal();
            function principal()
            {
                let validacionCampoVacioNombre=false;
                let validacionCaracteresExtraniosNombre=false;
                let validacionLongitudNombre=false;
                let campoNombrePasoTodasLasValidaciones=false;
                validacionCampoVacioNombre=verificarQueElCampoNoEsteVacio(validacionCampoVacioNombre,nombre);
                validacionCaracteresExtraniosNombre=verificarQueElCampoNoContengaCaracteresExtranios(validacionCaracteresExtraniosNombre,nombre);
                validacionLongitudNombre=verificarLongitud(validacionLongitudNombre,nombre,2,30);

                let validacionCampoVacioApellidos=false;
                let validacionCaracteresExtraniosApellidos=false;
                let validacionLongitudApellidos=false;
                let campoApellidosPasoTodasLasValidaciones=false;
                validacionCampoVacioApellidos=verificarQueElCampoNoEsteVacio(validacionCampoVacioApellidos,apellidos);
                validacionCaracteresExtraniosApellidos=verificarQueElCampoNoContengaCaracteresExtranios(validacionCaracteresExtraniosApellidos,apellidos);
                validacionLongitudApellidos=verificarLongitud(validacionLongitudApellidos,apellidos,2,30);

                let validacionCorreoElectronico=false;
                let campoCorreoElectronicoPasoTodasLasValidaciones=false;
                validacionCorreoElectronico=verificarSintaxisCorreo(validacionCorreoElectronico,email);

                let validacionSoloNumerosTelefono=false;
                let validacionLongitudTelefono=false;
                let campoTelefonoPasoTodasLasValidaciones=false;
                validacionLongitudTelefono=verificarLongitud(validacionLongitudTelefono,telefono,9,9);
                validacionSoloNumerosTelefono=verificarQueElCampoSoloContengaNumeros(validacionSoloNumerosTelefono,telefono);


                if(validacionCampoVacioNombre&&validacionCaracteresExtraniosNombre&&validacionLongitudNombre)
                {
                    let mensajeError = document.getElementById("mensajeValidacionNombre");
                    mensajeError.textContent = "";
                    campoNombrePasoTodasLasValidaciones=true;
                }

                if(validacionCampoVacioApellidos&&validacionCaracteresExtraniosApellidos&&validacionLongitudApellidos)
                {
                    let mensajeError = document.getElementById("mensajeValidacionApellidos");
                    mensajeError.textContent = "";
                    campoApellidosPasoTodasLasValidaciones=true;
                }

                if(validacionCorreoElectronico)
                {
                    let mensajeError = document.getElementById("mensajeValidacionEmail");
                    mensajeError.textContent = "";
                    campoCorreoElectronicoPasoTodasLasValidaciones=true;
                }

                if(validacionSoloNumerosTelefono&&validacionLongitudTelefono)
                {
                    let mensajeError = document.getElementById("mensajeValidacionTelefono");
                    mensajeError.textContent = "";
                    campoTelefonoPasoTodasLasValidaciones=true;
                }

                if(campoNombrePasoTodasLasValidaciones&&campoApellidosPasoTodasLasValidaciones&&campoCorreoElectronicoPasoTodasLasValidaciones&&campoTelefonoPasoTodasLasValidaciones)
                {
                    mensajeValidacionFormulario.textContent="";
                    laTareaPasoTodasLasValidaciones=true;
                }
                else
                {
                    mensajeValidacionFormulario.style.color="red";
                    mensajeValidacionFormulario.textContent="Por favor, complete el formulario correctamente.";  
                }
            }
            function verificarQueElCampoNoEsteVacio(validacionCampoVacio,elementoInput)
            {
                // Elimina los espacios en blanco del valor del elemento input
                let elementoInputSinEspacios = elementoInput.value.trim();

                // Verifica si el campo nombre está vacío
                if (elementoInputSinEspacios === "")
                {
                    // El campo nombre está vacío
                    // Muestra un mensaje de error
                    let mensajeError = document.getElementById("mensajeValidacion"+elementoInput.name);
                    mensajeError.style.color = "red";
                    mensajeError.textContent = "El campo '"+elementoInput.name+"' no puede quedar vacío.";
                }
                else
                {
                    validacionCampoVacio=true;
                }
                return validacionCampoVacio;
            }
            function verificarLongitud(validacionLongitud,elementoInput,longitudMinima,longitudMaxima)
            {
                // Verifica si la longitud del campo nombre es menor a 35
                longitudMaxima=longitudMaxima+1;
                let longitudMuyCorta=elementoInput.value.length < longitudMinima;
                let longitudMuyLarga=elementoInput.value.length >= longitudMaxima;

                // Si la longitud del campo nombre es mayor o igual a 35, muestra un mensaje de error
                if(longitudMuyCorta||longitudMuyLarga)
                {
                    // Muestra un mensaje de error
                    const mensajeError = document.getElementById("mensajeValidacion"+elementoInput.name);
                    mensajeError.style.color = "red";
                    longitudMaxima=longitudMaxima-1;
                    if(longitudMuyCorta)
                    {
                        mensajeError.textContent = "La longitud del campo no puede ser menor a "+longitudMinima+" caracter(es).";
                    }
                    else if(longitudMuyLarga)
                    {
                        mensajeError.textContent = "La longitud del campo no puede ser mayor a "+longitudMaxima+" caracteres.";
                    }
                }
                else
                {
                    validacionLongitud=true;
                }
                return validacionLongitud;
            }
            function verificarQueElCampoNoContengaCaracteresExtranios(validacionCaracteresExtranios,elementoInput)
            {
                // Verifica si el campo nombre tiene algún caracter que no sea una letra del alfabeto español
                const contieneCaracteresNoEspanoles = /[^a-záéíóúüññç\s]/i.test(elementoInput.value);

                // Si el campo nombre tiene algún caracter que no sea una letra del alfabeto español, muestra un mensaje de error
                if (contieneCaracteresNoEspanoles)
                {
                    // El campo nombre tiene algún caracter que no sea una letra del alfabeto español
                    // Muestra un mensaje de error
                    const mensajeError = document.getElementById("mensajeValidacion"+elementoInput.name);
                    mensajeError.style.color = "red";
                    mensajeError.textContent = "Este campo solo puede contener letras del alfabeto español.";
                }
                else
                {
                    validacionCaracteresExtranios=true;
                }
                return validacionCaracteresExtranios;
            }
            function verificarSintaxisCorreo(validacionSintaxisCorreo,correo)
            {
                // Verifica si el valor del input coincide con el patrón
                const coincideConElPatron = correo.value.match(/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/);

                // Si el valor del input no coincide con el patrón, muestra un mensaje de error
                if (!coincideConElPatron)
                {
                    // El valor del input no coincide con el patrón
                    // Muestra un mensaje de error
                    const mensajeError = document.getElementById("mensajeValidacion"+correo.name);
                    mensajeError.style.color = "red";
                    mensajeError.textContent = "El correo electrónico no es válido.";
                }
                else
                {
                    validacionSintaxisCorreo=true;
                }
                return validacionSintaxisCorreo;
            }
            function verificarQueElCampoSoloContengaNumeros(validacionNumeros,elementoInput)
            {
                if (!elementoInput.value.match(/^[0-9]+$/))
                {
                    const mensajeError = document.getElementById("mensajeValidacion"+elementoInput.name);
                    mensajeError.style.color = "red";
                    mensajeError.textContent = "Este campo solo puede contener numeros naturales.";
                }
                else
                {
                    validacionNumeros=true;
                }
                return validacionNumeros; 
            }
            return laTareaPasoTodasLasValidaciones;
        }
    }
);