
let allProducts = [];

document.addEventListener('DOMContentLoaded', (event) => {
    const icono = document.querySelector('.contenedor_icono_carrito');
    const contenedor_carrito = document.querySelector('.contenedor_carrito');
    const productos = document.querySelector('.contenedor_productos');
    const valorTotal = document.querySelector('.total_pagar');
    const contador_productos = document.querySelector('.contador_productos');
    const carrito = document.querySelector('#carrito');
    const carritoVacio = document.querySelector('#carritoVacio');

    


    icono.addEventListener('click', () => {
        contenedor_carrito.classList.toggle('hidden');
    });

    const showHTML = () => {

        if(allProducts.length === 0) {
            carritoVacio.classList.remove('hidden');
            carrito.classList.add('hidden');
        } else {
            carritoVacio.classList.add('hidden');
            carrito.classList.remove('hidden');
        }




        productos.innerHTML = '';

        let total = 0;
        let totalProductos = 0;

        
        allProducts.forEach(producto => {

            const totalPorProducto = producto.cantidad * parseFloat(producto.precio.replace(/[^0-9.-]+/g,""));

            const contenedorProductos = document.createElement('div');
            contenedorProductos.classList.add('producto_item');

            contenedorProductos.innerHTML = `
                <div class="row align-items-center">
            <div class="col">
                <h5 class="card-title">${producto.nombre}</h5>
                <p class="card-text">Cantidad: ${producto.cantidad} x $${producto.precio}</p>
            </div>
            <div class="col-auto">
                <span class="fw-bold me-3">$${totalPorProducto.toFixed(2)}</span>
                <button class="btn btn-outline-danger btn-sm btn_eliminar">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>
            `;

            const deleteButton = contenedorProductos.querySelector('.btn_eliminar');

            deleteButton.addEventListener('click', () => {
                eliminar_productos(producto.nombre);
            });

            productos.append(contenedorProductos);



            total = total + parseInt(producto.cantidad * parseFloat(producto.precio.replace(/[^0-9.-]+/g,"")));
            totalProductos = totalProductos + producto.cantidad;

        });

        valorTotal.innerText = `$${total.toFixed(2)}`;
        contador_productos.innerText = totalProductos;
    };


    const productosCarrito = () => {
        const productos = sessionStorage.getItem('productos');
        if (productos) {
            allProducts = JSON.parse(productos);
        } else {
            allProducts = [];
        }
        showHTML(); 
    };


    productosCarrito();

    const guardarProductosCarrito = () => {
        sessionStorage.setItem('productos', JSON.stringify(allProducts));
    }


    document.querySelectorAll('.btn_añadir').forEach(button => {
        button.addEventListener('click', event => {
            console.log("agregar");

            const productoId = event.target.getAttribute('data-producto-id');
            const productoNombre = event.target.getAttribute('data-producto-nombre');
            const productoPrecio = event.target.getAttribute('data-producto-precio');
            
            agregar_carrito(productoId, productoNombre, productoPrecio); 
        });
    });

    const agregar_carrito = (productoId, productoNombre, productoPrecio) => {

        const infoProducto = {
            id: productoId,
            cantidad: 1,
            nombre: productoNombre,
            precio: productoPrecio,
        };
    
        const existe = allProducts.some(product => product.nombre === infoProducto.nombre);
    
        if (existe) {
            const products = allProducts.map(product => {
                if (product.nombre === infoProducto.nombre) {
                    product.cantidad++;
                    return product;
                } else {
                    return product;
                }
            });
            allProducts = [...products];
        } else {
            allProducts = [...allProducts, infoProducto];
        }
    
        showHTML();
        console.log(allProducts);
        guardarProductosCarrito();
    };

    
    const eliminar_productos = (productoNombre) => {
        allProducts = allProducts.filter(producto => producto.nombre !== productoNombre);
        showHTML();
        guardarProductosCarrito();
    };

});

// Seleccionamos el botón de comprar carrito
document.querySelector('.comprar_carrito').addEventListener('click', () => {
    localStorage.setItem('productosParaCheckout', JSON.stringify(allProducts));
    window.location.href = 'checkout.php';
});


