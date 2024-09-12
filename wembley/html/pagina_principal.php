<?php
include("navbar.php");
include("../config/database.php");


$sql_testimonios = $con->prepare("SELECT * FROM testimonios");
$sql_testimonios->execute();
$testimonios = $sql_testimonios->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto de Formación de Operadores</title>


</head>

<body>

    <section class="hero">
        <div class="hero-content">
            <h1 class="display-1 mb-4">WEMBLEY</h1>
            <h2 class="display-5 mb-4">Somos un emprendimiento de venta de botines de fútbol</h2>
            <a href="#" class="btn btn-primary btn-lg">Ver catálogo</a>
        </div>
    </section>
    <div class="container my-5">
        <section id="nosotros" class="mb-5 text-white">
            <h2 class="text-center mb-4">Sobre Nosotros</h2>
            <div class="row d-flex align-items-center">
                <div class="col-md-6 d-flex justify-content-center">
                    <img src="../../imagenes/4182129_MO_EU_Onsite_Football_Main_Pack2_SS_24_IWP_Predator_PLP_Image_Collection_4_d_112915afbb.avif" alt="Nuestra tienda" class="img-fluid img-thumbnail rounded" style="max-width: 300px;">
                </div>
                <div class="col-md-6">
                    <p>Somos una tienda especializada en botines de fútbol, dedicada a proporcionar a nuestros clientes los mejores productos para mejorar su rendimiento en el campo.</p>
                    <p>Con años de experiencia en el mercado, nos enorgullecemos de ofrecer una amplia selección de las mejores marcas y modelos, asegurando que cada jugador encuentre el botín perfecto para su estilo de juego.</p>
                    <p>Nuestro equipo está formado por apasionados del fútbol que entienden las necesidades de los jugadores y pueden brindar asesoramiento experto para ayudarte a elegir el botín ideal.</p>
                </div>
            </div>
        </section>


        <section id="destacado" class="destacado">
            <h2 class="text-center mb-4 text-white">Productos Destacados</h2>
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1511886929837-354d827aae26?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1064&q=80" class="card-img-top" alt="Botín 1">
                                    <div class="card-body">
                                        <h5 class="card-title">Botín Veloz</h5>
                                        <p class="card-text">Botín de fútbol de alta velocidad para jugadores ágiles.</p>
                                        <a href="#" class="btn btn-primary">Ver detalles</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1543326727-cf6c39e8f84c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top" alt="Botín 2">
                                    <div class="card-body">
                                        <h5 class="card-title">Botín Potente</h5>
                                        <p class="card-text">Diseñado para jugadores que buscan máxima potencia en sus tiros.</p>
                                        <a href="#" class="btn btn-primary">Ver detalles</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1579298245158-33e8f568f7d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top" alt="Botín 3">
                                    <div class="card-body">
                                        <h5 class="card-title">Botín Control</h5>
                                        <p class="card-text">Perfecto para jugadores que priorizan el control del balón.</p>
                                        <a href="#" class="btn btn-primary">Ver detalles</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1579298245158-33e8f568f7d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top" alt="Botín 4">
                                    <div class="card-body">
                                        <h5 class="card-title">Botín Precisión</h5>
                                        <p class="card-text">Ideal para jugadores que necesitan precisión en sus pases y tiros.</p>
                                        <a href="#" class="btn btn-primary">Ver detalles</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1511886929837-354d827aae26?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1064&q=80" class="card-img-top" alt="Botín 1">
                                    <div class="card-body">
                                        <h5 class="card-title">Botín Veloz</h5>
                                        <p class="card-text">Botín de fútbol de alta velocidad para jugadores ágiles.</p>
                                        <a href="#" class="btn btn-primary">Ver detalles</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1543326727-cf6c39e8f84c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top" alt="Botín 2">
                                    <div class="card-body">
                                        <h5 class="card-title">Botín Potente</h5>
                                        <p class="card-text">Diseñado para jugadores que buscan máxima potencia en sus tiros.</p>
                                        <a href="#" class="btn btn-primary">Ver detalles</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="https://images.unsplash.com/photo-1579298245158-33e8f568f7d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top" alt="Botín 3">
                                    <div class="card-body">
                                        <h5 class="card-title">Botín Control</h5>
                                        <p class="card-text">Perfecto para jugadores que priorizan el control del balón.</p>
                                        <a href="#" class="btn btn-primary">Ver detalles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </section>
        <section id="testimonio" class="testimonios">
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000" data-bs-wrap="true">
                <div class="carousel-inner">
                    <?php
                    // Preparar la consulta
                    $sql_testimonios = $con->prepare("SELECT * FROM testimonios");
                    $sql_testimonios->execute();

                    // Obtener los datos de los testimonios
                    $testimonios = $sql_testimonios->fetchAll(PDO::FETCH_ASSOC);

                    // Variable para identificar el primer testimonio como "active"
                    $isActive = true;

                    // Recorrer los testimonios
                    foreach ($testimonios as $testimonio) {
                        // Extraer datos del testimonio
                        $usuario = $testimonio['usuario_testimonio'];
                        $descripcion = $testimonio['descripcion_testimonio'];
                        $estrellas = $testimonio['estrellas_testimonio'];
                    ?>
                        <div class="carousel-item <?php if ($isActive) {
                                                        echo 'active';
                                                        $isActive = false;
                                                    } ?>">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="testimonio_card">
                                        <div class="header_testimonio_card">
                                            <div class="image_testimonio_card"></div>
                                            <div>
                                                <div class="stars_testimonio_card">
                                                    <?php
                                                    // Mostrar estrellas dinámicamente
                                                    for ($i = 0; $i < $estrellas; $i++) {
                                                        echo '<svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>';
                                                    }
                                                    ?>
                                                </div>
                                                <p class="name_testimonio_card"><?php echo htmlspecialchars($usuario); ?></p>
                                            </div>
                                        </div>
                                        <p class="message_testimonio_card">
                                            <?php echo htmlspecialchars($descripcion); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

    </div>



    <button class="button" onclick="scrollToTop()">
        <svg class="svgIcon" viewBox="0 0 384 512">
            <path
                d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"></path>
        </svg>
    </button>

    <?php include("footer.php") ?>
    <!-- Script personalizado para el desplazamiento automático -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myCarousel = document.getElementById('productCarousel');
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 3000, // Cambia de slide cada 3 segundos
                wrap: true // Permite que el carrusel vuelva al principio cuando llega al final
            });
        });



        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>