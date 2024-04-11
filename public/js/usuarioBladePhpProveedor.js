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
            let nombreEmpresa=document.getElementById("nombreEmpresa")
            let contrasenia=document.getElementById("contrasenia");
            let confirmarContrasenia=document.getElementById("confirmarContrasenia");
            let email=document.getElementById("email");
            let telefono=document.getElementById("telefono");
            let calle=document.getElementById("calle");
            let numero=document.getElementById("numero");
            let cp=document.getElementById("cp");
            let ciudad=document.getElementById("ciudad");

            let laTareaPasoTodasLasValidaciones=false;
            principal();
            function principal()
            {
                let validacionCampoVacioNombreEmpresa=false;
                let validacionLongitudNombreEmpresa=false;
                let campoNombreEmpresaPasoTodasLasValidaciones=false;
                validacionCampoVacioNombreEmpresa=verificarQueElCampoNoEsteVacio(validacionCampoVacioNombreEmpresa,nombreEmpresa);
                validacionLongitudNombreEmpresa=verificarLongitud(validacionLongitudNombreEmpresa,nombreEmpresa,2,30);

                let validacionCampoVacioContrasenia=false;
                let validacionLongitudContrasenia=false;
                let campoContraseniaPasoTodasLasValidaciones=false;
                validacionCampoVacioContrasenia=verificarQueElCampoNoEsteVacio(validacionCampoVacioContrasenia,contrasenia);
                validacionLongitudContrasenia=verificarLongitud(validacionLongitudContrasenia,contrasenia,8,16);

                let validacionCampoConfirmarContrasenia=false;
                let campoConfirmarContraseniaPasoTodasLasValidaciones=false;
                validacionCampoConfirmarContrasenia=verificarQueLosCamposCoincidan(validacionCampoConfirmarContrasenia,confirmarContrasenia,contrasenia);

                let validacionCorreoElectronico=false;
                let campoCorreoElectronicoPasoTodasLasValidaciones=false;
                validacionCorreoElectronico=verificarSintaxisCorreo(validacionCorreoElectronico,email);

                let validacionSoloNumerosTelefono=false;
                let validacionLongitudTelefono=false;
                let campoTelefonoPasoTodasLasValidaciones=false;
                validacionLongitudTelefono=verificarLongitud(validacionLongitudTelefono,telefono,9,9);
                validacionSoloNumerosTelefono=verificarQueElCampoSoloContengaNumeros(validacionSoloNumerosTelefono,telefono);

                let validacionCampoVacioCalle=false;
                let validacionLongitudCalle=false;
                let campoCallePasoTodasLasValidaciones=false;
                validacionCampoVacioCalle=verificarQueElCampoNoEsteVacio(validacionCampoVacioCalle,calle);
                validacionLongitudCalle=verificarLongitud(validacionLongitudCalle,calle,2,30);

                let validacionLongitudNumero=false;
                let campoNumeroPasoTodasLasValidaciones=false;
                validacionLongitudNumero=verificarLongitud(validacionLongitudNumero,numero,1,4);

                let validacionLongitudCp=false;
                let campoCpPasoTodasLasValidaciones=false;
                validacionLongitudCp=verificarLongitud(validacionLongitudCp,cp,5,5);

                let validacionCampoVacioCiudad=false;
                let validacionCaracteresExtraniosCiudad=false;
                let validacionLongitudCiudad=false;
                let campoCiudadPasoTodasLasValidaciones=false;
                validacionCampoVacioCiudad=verificarQueElCampoNoEsteVacio(validacionCampoVacioCiudad,ciudad);
                validacionCaracteresExtraniosCiudad=verificarQueElCampoNoContengaCaracteresExtranios(validacionCaracteresExtraniosCiudad,ciudad);
                validacionLongitudCiudad=verificarLongitud(validacionLongitudCiudad,ciudad,2,30);

                if(validacionCampoVacioNombreEmpresa&&validacionLongitudNombreEmpresa)
                {
                    let mensajeError = document.getElementById("mensajeValidacionNombreEmpresa");
                    mensajeError.textContent = "";
                    campoNombreEmpresaPasoTodasLasValidaciones=true;
                }

                if(validacionCampoVacioContrasenia&&validacionLongitudContrasenia)
                {
                    let mensajeError = document.getElementById("mensajeValidacionContrasenia");
                    mensajeError.textContent = "";
                    campoContraseniaPasoTodasLasValidaciones=true;
                }

                if(validacionCampoConfirmarContrasenia)
                {
                    let mensajeError = document.getElementById("mensajeValidacionConfirmarContrasenia");
                    mensajeError.textContent = "";
                    campoConfirmarContraseniaPasoTodasLasValidaciones=true;
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

                if(validacionCampoVacioCalle&&validacionLongitudCalle)
                {
                    let mensajeError = document.getElementById("mensajeValidacionCalle");
                    mensajeError.textContent = "";
                    campoCallePasoTodasLasValidaciones=true;
                }

                if(validacionLongitudNumero)
                {
                    let mensajeError = document.getElementById("mensajeValidacionNumero");
                    mensajeError.textContent = "";
                    campoNumeroPasoTodasLasValidaciones=true;
                }
                
                if(validacionLongitudCp)
                {
                    let mensajeError = document.getElementById("mensajeValidacionCp");
                    mensajeError.textContent = "";
                    campoCpPasoTodasLasValidaciones=true;
                }

                if(validacionCampoVacioCiudad&&validacionCaracteresExtraniosCiudad&&validacionLongitudCiudad)
                {
                    let mensajeError = document.getElementById("mensajeValidacionCiudad");
                    mensajeError.textContent = "";
                    campoCiudadPasoTodasLasValidaciones=true;
                }


                if(campoNombreEmpresaPasoTodasLasValidaciones&&campoContraseniaPasoTodasLasValidaciones&&campoConfirmarContraseniaPasoTodasLasValidaciones&&campoCorreoElectronicoPasoTodasLasValidaciones&&campoTelefonoPasoTodasLasValidaciones&&campoCallePasoTodasLasValidaciones&&campoNumeroPasoTodasLasValidaciones&&campoCpPasoTodasLasValidaciones&&campoCiudadPasoTodasLasValidaciones)
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

                    // Evita que el formulario se envíe
                    event.preventDefault();
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
                    // Evita que el formulario se envíe
                    event.preventDefault();
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

                    // Evita que el formulario se envíe
                    event.preventDefault();
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

                    // Evita que el formulario se envíe
                    event.preventDefault();
                }
                else
                {
                    validacionSintaxisCorreo=true;
                }
                return validacionSintaxisCorreo;
            }
            function verificarQueElCampoSoloContengaNumeros(validacionNumeros,elementoInput)
            {
                /*if(elementoInput.value==="")
                {
                    elementoInput.value=1;
                }*/
                if (!elementoInput.value.match(/^[0-9]+$/))
                {
                    const mensajeError = document.getElementById("mensajeValidacion"+elementoInput.name);
                    mensajeError.style.color = "red";
                    mensajeError.textContent = "Este campo solo puede contener numeros naturales.";
                    event.preventDefault();
                }
                else
                {
                    validacionNumeros=true;
                }
                return validacionNumeros; 
            }
            function verificarQueLosCamposCoincidan(losCamposCoinciden,elementoInputUno,elementoInputDos)
            {
                let valorElementoInputUno=elementoInputUno.value;
                let valorElementoInputDos=elementoInputDos.value;
                if (valorElementoInputUno!==valorElementoInputDos)
                {
                    // Muestra un mensaje de error
                    const mensajeError = document.getElementById("mensajeValidacion"+elementoInputUno.name);
                    mensajeError.style.color = "red";
                    mensajeError.textContent = "Las contraseñas no coinciden.";

                    // Evita que el formulario se envíe
                    event.preventDefault();
                }
                else
                {
                    losCamposCoinciden=true;
                }
                return losCamposCoinciden;
            }
            return laTareaPasoTodasLasValidaciones;
        }
    }

);