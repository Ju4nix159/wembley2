
/* PRIMERA PARTE CONTROLA EL CARRUSEL DE LA PANTALLA PRINCIPAL */

const productContainers = [...document.querySelectorAll('.destacados__contenedor')];
const nxtBtn = [...document.querySelectorAll('.derecha_boton')];
const preBtn = [...document.querySelectorAll('.izquierda_boton')];

productContainers.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    nxtBtn[i].addEventListener('click', () => {
        if (item.scrollLeft + containerWidth >= item.scrollWidth) {
            item.scrollLeft = 0;
        } else {
            item.scrollLeft += containerWidth;
        }
    });

    preBtn[i].addEventListener('click', () => {
        if (item.scrollLeft <= 0) {
            item.scrollLeft = item.scrollWidth;
        } else {
            item.scrollLeft -= containerWidth;
        }
    });
});

/* MUESTRA EL CHECKOUT DEL PEDIDO CUANDO SE LE HACE CLICK EN FINALIZAR PEDIDO */
/* CHECKOUT */
function mostrarCarrito() {
    const productosParaCheckout = JSON.parse(localStorage.getItem('productosParaCheckout'));

    // Generar HTML para los productos del carrito
    const carritoHTML = productosParaCheckout.map(producto => `
        <tr>
            <td>${producto.title}</td>
            <td>${producto.quantity}</td>
            <td>${producto.price}</td>
            <td class="precioTotalProducto"></td>
        </tr>
    `).join('');

    // Actualizar la tabla en el DOM
    const carritoInfo = document.getElementById('table_body');
    carritoInfo.innerHTML = carritoHTML;

    // Llamar a la función para calcular los totales después de mostrar el carrito
    calcularTotales();
}

function calcularTotales() {
    const productosParaCheckout = JSON.parse(localStorage.getItem('productosParaCheckout'));

    // Calcular el precio total por producto y la suma total de los productos en el carrito
    let sumaTotal = 0;

    productosParaCheckout.forEach(producto => {
        const precioTotalPorProducto = producto.price * producto.quantity;
        sumaTotal += precioTotalPorProducto;

        const filaProducto = document.querySelector(`#table_body tr:nth-child(${productosParaCheckout.indexOf(producto) + 1})`);
        const celdaPrecioTotal = filaProducto.querySelector('.precioTotalProducto');
        celdaPrecioTotal.textContent = precioTotalPorProducto;
    });

    // Mostrar la suma total en la tabla
    const totalPrecioElement = document.getElementById('total_precio');
    totalPrecioElement.textContent = sumaTotal;
}


// Llama a la función para mostrar el carrito al cargar la página
mostrarCarrito();


