<?php
session_start()
?>

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
                    <a class="nav-link" href="pagina_principal.php#destacado">destacado</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="catalogo.php">catalogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../html/contacto.php">Contáctanos</a>
                </li>
                <?php
                if (isset($_SESSION["usuario"])) { ?>
                    <li class="nav-item">
                        <a class="text-decoration-none" href="admin/admin.php">
                            <button class="button-nav">
                                panel adm
                                <div class="arrow-wrapper">
                                    <div class="arrow"></div>
                                </div>
                            </button>
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="text-decoration-none" href="login.php">
                            <button class="button-nav">
                                iniciar sesion
                                <div class="arrow-wrapper">
                                    <div class="arrow"></div>
                                </div>
                            </button>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
