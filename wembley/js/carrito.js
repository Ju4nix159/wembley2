let allProducts = [];

document.addEventListener('DOMContentLoaded', () => {
    const containerCartProducts = document.querySelector('.contenedor_carrito');
    const btnCart = document.querySelector('.contenedor_icono_carrito');
    const rowProduct = document.querySelector('.contenedor_carrito__productos');
    const valorTotal = document.querySelector('.total_pagar');
    const countProducts = document.querySelector('.contador_productos');
    const cartEmpty = document.querySelector('.contenedor_carrito__carro_vacio');
    const cartTotal = document.querySelector('.contenedor_carrito__total');
    const comprarCarrito = document.querySelector('.comprar_carrito');

    const getCartProductsFromLocalStorage = () => {
        const cartProducts = localStorage.getItem('cartProducts');
        if (cartProducts) {
            allProducts = JSON.parse(cartProducts);
            showHTML();
        }
    };

    const saveCartProductsToLocalStorage = () => {
        localStorage.setItem('cartProducts', JSON.stringify(allProducts));
    };

 
    const showHTML = () => {
        if (allProducts.length === 0) {
            cartEmpty.classList.remove('hidden');
            rowProduct.classList.add('hidden');
            cartTotal.classList.add('hidden');
            comprarCarrito.classList.add('hidden');
        } else {
            cartEmpty.classList.add('hidden');
            rowProduct.classList.remove('hidden');
            cartTotal.classList.remove('hidden');
            comprarCarrito.classList.remove('hidden');
        }

        rowProduct.innerHTML = '';

        let total = 0;
        let totalOfProducts = 0;

        allProducts.forEach(product => {
            const containerProduct = document.createElement('div');
            containerProduct.classList.add('productos_carrito');

            containerProduct.innerHTML = `
                <div class="productos__informacion">
                    <span class="productos__cantidad">${product.quantity}</span>
                    <p class="productos__titulo">${product.title}</p>
                    <span class="productos__precio">${product.price}</span>
                    <button class="productos__eliminar"><i class='bx bxs-trash'></i></button>
                </div>
            `;

            const deleteButton = containerProduct.querySelector('.productos__eliminar');

            deleteButton.addEventListener('click', () => {
                removeProduct(product.title);
            });

            rowProduct.append(containerProduct);

            total = total + parseInt(product.quantity * parseFloat(product.price.replace(/[^0-9.-]+/g,"")));
            totalOfProducts = totalOfProducts + product.quantity;
        });

        valorTotal.innerText = `$${total.toFixed(2)}`;
        countProducts.innerText = totalOfProducts;
    };

    const addToCart = (productId, productName, productPrice) => {

        const infoProduct = {
            id: productId,
            quantity: 1,
            title: productName,
            price: productPrice,
        };
    
        const exists = allProducts.some(product => product.title === infoProduct.title);
    
        if (exists) {
            const products = allProducts.map(product => {
                if (product.title === infoProduct.title) {
                    product.quantity++;
                    return product;
                } else {
                    return product;
                }
            });
            allProducts = [...products];
        } else {
            allProducts = [...allProducts, infoProduct];
        }
    
        showHTML();
        console.log(allProducts);
        saveCartProductsToLocalStorage();
    };

    const removeProduct = (productName) => {
        allProducts = allProducts.filter(product => product.title !== productName);
        showHTML();
        saveCartProductsToLocalStorage();
    };

    document.querySelectorAll('.boton__agregar').forEach(button => {
        button.addEventListener('click', event => {
            console.log("agregar");

            const productId = event.target.getAttribute('data-producto-id'); // Obtener el ID del producto
            const productName = event.target.getAttribute('data-producto-nombre');
            const productPrice = event.target.getAttribute('data-producto-precio');
            
            addToCart(productId, productName, productPrice); 
        });
    });

    btnCart.addEventListener('click', () => {
        console.log("click");
        containerCartProducts.classList.toggle('hidden');
    });

    // Al cargar la página, obtener los productos del carrito desde localStorage si existen
    getCartProductsFromLocalStorage();

    // Función para enviar la información del carrito a la base de datos al hacer clic en el botón finalizarCompra
    const botonFinalizarCompra = document.getElementById('finalizarCompra');

    // Agregar evento click al botón de finalizar compra
    botonFinalizarCompra.addEventListener('click', function() {
        console.log("click finalizar compra");
        // Obtener la información del carrito desde localStorage
        const cartProducts = localStorage.getItem('productosParaCheckout');

        if (cartProducts) {
            // Parsear los productos del carrito
            const carrito = JSON.parse(cartProducts);

            // Enviar la información del carrito a la base de datos
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "guardar_pedido.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    localStorage.removeItem('cartProducts');
                    localStorage.removeItem('productosParaCheckout');
                    comprarCarrito.classList.add('hidden');

                }
            };

            xhr.send(JSON.stringify(carrito));
            console.log(carrito);

        } else {
            console.log("No hay productos en el carrito para finalizar la compra.");
        }
    });

});


const comprarCarrito = document.querySelector('.comprar_carrito');

// Función para enviar la información del carrito a la página de checkout
const enviarInformacionACheckout = () => {
    localStorage.setItem('productosParaCheckout', JSON.stringify(allProducts));

    window.location.href = 'checkout.php'; 

// Función que se ejecuta cuando se hace clic en el botón comprarCarrito
const handleCompraCarritoClick = () => {
    enviarInformacionACheckout();
};

// Agregar evento clic al botón comprarCarrito
comprarCarrito.addEventListener('click', handleCompraCarritoClick);
};
