<?php session_start(); ?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
        <a class="navbar-brand" href="pagina_principal.php">
            <img src="../imagen/logo.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="pagina_principal.php#nosotros">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pagina_principal.php#destacado">Destacado</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="catalogo.php">Catálogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../html/contacto.php">Contáctanos</a>
                </li>
                <?php
                if (isset($_SESSION["usuario"])) {
                    if ($_SESSION["permiso"] == 1) { ?>
                        <li>
                            <span><?php echo "admin" ?></span>
                        </li>
                    <?php } else { ?>
                        <li>
                            <span class="text-white p-5"><?php echo $_SESSION["usuario"]; ?></span>
                        </li>
                    <?php } ?>
                <?php }; ?>

                <label class="popup">
                    <input type="checkbox" />
                    <div tabindex="0" class="burger">
                        <svg
                            viewBox="0 0 24 24"
                            fill="white"
                            height="20"
                            width="20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 2c2.757 0 5 2.243 5 5.001 0 2.756-2.243 5-5 5s-5-2.244-5-5c0-2.758 2.243-5.001 5-5.001zm0-2c-3.866 0-7 3.134-7 7.001 0 3.865 3.134 7 7 7s7-3.135 7-7c0-3.867-3.134-7.001-7-7.001zm6.369 13.353c-.497.498-1.057.931-1.658 1.302 2.872 1.874 4.378 5.083 4.972 7.346h-19.387c.572-2.29 2.058-5.503 4.973-7.358-.603-.374-1.162-.811-1.658-1.312-4.258 3.072-5.611 8.506-5.611 10.669h24c0-2.142-1.44-7.557-5.631-10.647z"></path>
                        </svg>
                    </div>
                    <nav class="popup-window">
                        <legend>sesion</legend>
                        <ul>
                            <li>
                                <button>
                                    <svg
                                        width="14"
                                        height="14"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.2"
                                        stroke-linecap="round"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19 4v6.406l-3.753 3.741-6.463-6.462 3.7-3.685h6.516zm2-2h-12.388l1.497 1.5-4.171 4.167 9.291 9.291 4.161-4.193 1.61 1.623v-12.388zm-5 4c.552 0 1 .449 1 1s-.448 1-1 1-1-.449-1-1 .448-1 1-1zm0-1c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm6.708.292l-.708.708v3.097l2-2.065-1.292-1.74zm-12.675 9.294l-1.414 1.414h-2.619v2h-2v2h-2v-2.17l5.636-5.626-1.417-1.407-6.219 6.203v5h6v-2h2v-2h2l1.729-1.729-1.696-1.685z"></path>
                                    </svg>
                                    <?php if (isset($_SESSION["usuario"])) {
                                        if ($_SESSION["permiso"] == 1) { ?>
                                            <a href="../html/paneladmin.php" class="btn">Panel Admin</a>
                                        <?php } else { ?>
                                            <a href="../html/paneluser.php" class="btn">Panel Usuario</a>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <a href="../html/login.php" class="btn">Inicar sesion</a>
                                    <?php }; ?>
                                </button>
                            </li>
                            <li>
                                <button>
                                    <svg
                                        width="14"
                                        height="14"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1"
                                        stroke-linecap="round"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2.598 9h-1.055c1.482-4.638 5.83-8 10.957-8 6.347 0 11.5 5.153 11.5 11.5s-5.153 11.5-11.5 11.5c-5.127 0-9.475-3.362-10.957-8h1.055c1.443 4.076 5.334 7 9.902 7 5.795 0 10.5-4.705 10.5-10.5s-4.705-10.5-10.5-10.5c-4.568 0-8.459 2.923-9.902 7zm12.228 3l-4.604-3.747.666-.753 6.112 5-6.101 5-.679-.737 4.608-3.763h-14.828v-1h14.826z"></path>
                                    </svg>
                                    <?php if (!isset($_SESSION["usuario"])) { ?>
                                        <a href="../html/registro.php" class="btn">Registrarse</a>
                                    <?php } else { ?>
                                        <a href="../html/logout.php" class="btn">Cerrar Sesion</a>
                                    <?php } ?>
                                </button>
                            </li>
                        </ul>
                    </nav>
                </label>
            </ul>

        </div>
    </div>
    <div class="contenedor_icono">
        <div class="contenedor_icono_carrito">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="icono_carrito">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
            <div class="contador_productos">
                <span>0</span>
            </div>
        </div>

        <div class="container my-5 contenedor_carrito hidden">
            <h3 class="mb-4 text-black text-center">Carrito de Compras</h3>
            <div id="carrito" class="card">
                <div class="card-body contenedor_productos"></div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fs-5 fw-bold">Total:</span>
                        <span class="fs-4 fw-bold total_pagar"></span>
                    </div>
                    <button class="btn btn-primary w-100 comprar_carrito">Comprar</button>
                </div>
            </div>
            <div id="carritoVacio" class="container hidden">
                <div class="cart-container">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Carrito de Compras</h5>
                        </div>
                        <div class="card-body">
                            <div class="empty-cart-message">
                                <div class="empty-cart-icon">🛒</div>
                                <p class="lead">Tu carrito está vacío</p>
                                <p>¿Por qué no agregas algunos productos increíbles?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<script src="../js/carrito2.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>