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
});

document.addEventListener("DOMContentLoaded", function () {
    let selectElement = document.getElementById("opciones");
    let inputName = document.getElementById("riderName");
    let inputCantidad = document.getElementById("cantidad");

    selectElement.addEventListener("change", function () {
        let selectedOption = selectElement.options[selectElement.selectedIndex].value;
        let [name, cantidad] = selectedOption.split(",");
        inputName.value = name.trim();
        inputCantidad.value = cantidad.trim();
    });
});
