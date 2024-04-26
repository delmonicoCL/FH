document.addEventListener
(
    "DOMContentLoaded",
    function()
    {
        principal();
        function principal()
        {
            generarLogos();
        }
        function generarLogos()
        {
            let contenedoresLogo=document.getElementsByClassName("contenedorLogo");
            for (let contenedorLogo of contenedoresLogo)
            {
                let logo=document.createElement("img");
                logo.setAttribute("src","../../storage/app/storage/logos/"+contenedorLogo.getAttribute("data-imagenDentro"));
                logo.setAttribute("alt","logo "+contenedorLogo.getAttribute("data-imagenDentro"));
                logo.setAttribute("height","50");
                logo.setAttribute("width","50");
                logo.setAttribute("class","logoProveedor");
                logo.setAttribute("id","logo"+contenedorLogo.getAttribute("data-imagenDentro"));
                logo.setAttribute("draggable","false");
                contenedorLogo.appendChild(logo);
            }
        }
    }
);