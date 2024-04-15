document.addEventListener("DOMContentLoaded", function () {
    let menosBtn = document.getElementById("menosBtn");
    let masBtn = document.getElementById("masBtn");
    let crearBtn = document.getElementById("crearBtn");

    menosBtn.addEventListener("click", function () {
        decrementarCantidad();
    });

    function decrementarCantidad() {
        let cantidadMenu = document.querySelector("#menu .cantMenu");
        let cantidad = parseInt(cantidadMenu.textContent);
        if (cantidad >= 1) {
            cantidad--;
            cantidadMenu.textContent = cantidad;
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
        }
    }
});
