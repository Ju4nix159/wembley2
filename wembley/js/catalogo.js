document.addEventListener('DOMContentLoaded', function () {
    var checkboxes = document.querySelectorAll('.categoria-checkbox');
    var gridContenedor = document.getElementById('gridContenedor');
    var ordenarPrecioBtn = document.getElementById('ordenarPrecio');
    var ordenarAlfabeticamenteBtn = document.getElementById('ordenarAlfabeticamente');
    var buscarProductoInput = document.getElementById('buscarProducto'); // Obtener el campo de búsqueda

    var ordenPrecioAscendente = true;
    var ordenAlfabeticoAscendente = true;

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            filtrarProductos();
        });
    });

    ordenarPrecioBtn.addEventListener('click', function () {
        ordenPrecioAscendente = !ordenPrecioAscendente;
        cambiarFlecha(ordenarPrecioBtn, ordenPrecioAscendente);
        ordenarProductosPorPrecio();
    });

    ordenarAlfabeticamenteBtn.addEventListener('click', function () {
        ordenAlfabeticoAscendente = !ordenAlfabeticoAscendente;
        cambiarFlecha(ordenarAlfabeticamenteBtn, ordenAlfabeticoAscendente);
        ordenarProductosAlfabeticamente();
    });

    // Escuchar eventos de entrada de texto en el campo de búsqueda
    buscarProductoInput.addEventListener('input', function () {
        filtrarProductosPorTexto();
    });

    function cambiarFlecha(btn, ascendente) {
        var icono = btn.querySelector('i');
        icono.className = ascendente ? 'bx bx-chevron-down' : 'bx bx-chevron-up';
    }

    function filtrarProductos() {
        var productos = gridContenedor.querySelectorAll('.carta');
        productos.forEach(function (producto) {
            var categoriaProducto = producto.getAttribute('data-categoria');
            var categoriasSeleccionadas = obtenerCategoriasSeleccionadas();
            if (categoriasSeleccionadas.length === 0 || categoriasSeleccionadas.includes(categoriaProducto)) {
                producto.style.display = 'block';
            } else {
                producto.style.display = 'none';
            }
        });
    }

    function filtrarProductosPorTexto() {
        var textoBusqueda = buscarProductoInput.value.toLowerCase(); // Obtener el texto de búsqueda en minúsculas
        var productos = gridContenedor.querySelectorAll('.carta');
        productos.forEach(function (producto) {
            var nombreProducto = producto.querySelector('.carta__titulo').innerText.toLowerCase(); // Obtener el nombre del producto en minúsculas
            if (nombreProducto.includes(textoBusqueda)) { // Verificar si el nombre del producto incluye el texto de búsqueda
                producto.style.display = 'block';
            } else {
                producto.style.display = 'none';
            }
        });
    }

    function ordenarProductosPorPrecio() {
        var productos = Array.from(gridContenedor.querySelectorAll('.carta'));
        productos.sort(function (a, b) {
            var precioA = parseFloat(a.querySelector('.carta__precio').innerText.replace(',', ''));
            var precioB = parseFloat(b.querySelector('.carta__precio').innerText.replace(',', ''));
            return ordenPrecioAscendente ? precioA - precioB : precioB - precioA;
        });
        gridContenedor.innerHTML = '';
        productos.forEach(function (producto) {
            gridContenedor.appendChild(producto);
        });
    }

    function ordenarProductosAlfabeticamente() {
        var productos = Array.from(gridContenedor.querySelectorAll('.carta'));
        productos.sort(function (a, b) {
            var nombreA = a.querySelector('.carta__titulo').innerText.toLowerCase();
            var nombreB = b.querySelector('.carta__titulo').innerText.toLowerCase();
            return ordenAlfabeticoAscendente ? nombreA.localeCompare(nombreB) : nombreB.localeCompare(nombreA);
        });
        gridContenedor.innerHTML = '';
        productos.forEach(function (producto) {
            gridContenedor.appendChild(producto);
        });
    }

    function obtenerCategoriasSeleccionadas() {
        var categoriasSeleccionadas = [];
        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                categoriasSeleccionadas.push(checkbox.value);
            }
        });
        return categoriasSeleccionadas;
    }

    
});

