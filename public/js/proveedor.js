document.addEventListener("DOMContentLoaded", function () {
    let menosBtn = document.getElementById("menosBtn");
    let masBtn = document.getElementById("masBtn");
    // let crearBtn = document.getElementById("crearBtn");
    let cant = document.getElementById("cant");

    menosBtn.addEventListener("click", function () {
        decrementarCantidad();
    });

    function decrementarCantidad() {
        let cantidadMenu = document.querySelector("#menu .cantMenu");
        let cantidad = parseInt(cantidadMenu.textContent);
        if (cantidad >= 1) {
            cantidad--;
            cantidadMenu.textContent = cantidad;
            console.log(cantidad);
            cant.setAttribute("value", cantidad);
        }
    }

    masBtn.addEventListener("click", function () {
        incrementarCantidad();
    });

    function incrementarCantidad() {
        let cantidadMenu = document.querySelector("#menu .cantMenu");
        let cantidad = parseInt(cantidadMenu.textContent);
        if (cantidad <= 9) {
            cantidad++;
            cantidadMenu.textContent = cantidad;
            cant.setAttribute("value", cantidad);
        }
    }

    // Agregamos el nuevo código para el select
    let selectElement = document.getElementById("opciones");
    let inputElement = document.getElementById("riderName");

    selectElement.addEventListener("change", function () {
        let selectedName =
            selectElement.options[selectElement.selectedIndex].text;
        inputElement.value = selectedName;
    });
});
