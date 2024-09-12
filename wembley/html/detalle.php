<?php
include("../config/database.php");
include("navbar.php");

$id_producto = $_GET['id_producto'];
$sql_producto = $con->query("SELECT
    p.id_producto,
    p.nombre AS nombre_producto,
    p.descripcion,
    v.id_variante,
    v.color,
    v.precio,
    v.stock
FROM
    productos p
JOIN
    variante_producto vp ON p.id_producto = vp.id_producto
JOIN
    variantes v ON vp.id_variante = v.id_variante
WHERE
    p.id_producto = $id_producto  -- Reemplaza 'X' por el id_producto que desees
    AND v.id_variante = (
        SELECT MIN(vp2.id_variante)
        FROM variante_producto vp2
        WHERE vp2.id_producto = p.id_producto
    );
");
$sql_producto->execute();
$producto = $sql_producto->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto["nombre_producto"] ?></title>
    <style>

    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Columna combinada para Thumbnail y acordeón -->
            <div class="col-md-6">
                <div class="row">
                    <!-- Thumbnails -->
                    <div class="col-md-2">
                        <div class="thumbnail-container">
                            <img src="../imagen/noimagen.jpg" alt="Thumbnail 1" class="thumbnail">
                            <img src="../imagen/noimagen.jpg" alt="Thumbnail 2" class="thumbnail">
                            <img src="../imagen/noimagen.jpg" alt="Thumbnail 3" class="thumbnail">
                            <img src="../imagen/noimagen.jpg" alt="Thumbnail 4" class="thumbnail">
                            <img src="../imagen/noimagen.jpg" alt="Thumbnail 5" class="thumbnail">
                            <img src="../imagen/noimagen.jpg" alt="Thumbnail 6" class="thumbnail">
                        </div>
                    </div>
                    <!-- Imagen principal -->
                    <div class="col-md-10">
                        <div class="position-relative">
                            <img src="../imagen/noimagen.jpg" alt="Botines adidas Predator" class="img-fluid main-image">
                        </div>
                    </div>
                </div>
                <!-- Aquí moví los acordeones para que ocupen todo el ancho debajo de Thumbnails y la imagen -->
                <div class="accordion mt-4" id="productAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDescription">
                                DESCRIPCIÓN
                            </button>
                        </h2>
                        <div id="collapseDescription" class="accordion-collapse collapse show" data-bs-parent="#productAccordion">
                            <div class="accordion-body">
                                <?php echo $producto["descripcion"] ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSpecs">
                                ESPECIFICACIONES
                            </button>
                        </h2>
                        <div id="collapseSpecs" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                            <div class="accordion-body">
                                Especificaciones técnicas del producto...
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOpinions">
                                OPINIONES
                            </button>
                        </h2>
                        <div id="collapseOpinions" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                            <div class="accordion-body">
                                <div class="d-flex align-items-center mb-2">
                                    <h5 class="me-2 mb-0">0</h5>
                                    <div>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <span class="ms-2">(0)</span>
                                </div>
                                Opiniones de los clientes...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <h2 class="mt-3"><?php echo $producto["nombre_producto"] ?></h2>
                    <!-- <p class="text-muted">FÚTBOL</p> -->
                    <h2 class="mb-3"> <?php echo number_format($producto["precio"], 2, '.', ','); ?></h2>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">¡Aprovechá nuestras promociones bancarias!</h5>
                            <div class="d-flex gap-2 mb-2">
                                <img src="https://via.placeholder.com/30x20" alt="American Express" style="width: 30px; height: 20px;">
                                <img src="https://via.placeholder.com/30x20" alt="Visa" style="width: 30px; height: 20px;">
                                <img src="https://via.placeholder.com/30x20" alt="Mastercard" style="width: 30px; height: 20px;">
                                <img src="https://via.placeholder.com/30x20" alt="Mercado Pago" style="width: 30px; height: 20px;">
                            </div>
                            <p>3 cuotas sin interés de $38.333</p>
                            <p>6 cuotas sin interés de $19.166,5</p>
                            <p>12 cuotas fijas de $12.467,63</p>
                        </div>
                    </div>
                    <h5>Variantes</h5>
                    <div class="mb-3">
                        <button class="btn btn-outline-secondary size-button">26.5</button>
                        <button class="btn btn-outline-secondary size-button">27</button>
                        <button class="btn btn-outline-secondary size-button">27.5</button>
                        <button class="btn btn-outline-secondary size-button">28</button>
                    </div>
                    <h5>Talle Argentino</h5>
                    <div class="mb-3">
                        <button class="btn btn-outline-secondary size-button">26.5</button>
                        <button class="btn btn-outline-secondary size-button">27</button>
                        <button class="btn btn-outline-secondary size-button">27.5</button>
                        <button class="btn btn-outline-secondary size-button">28</button>
                    </div>
                    <a href="#" class="text-primary">¿Tu talle está agotado?</a>
                    <button class="btn btn-success btn-lg w-100 my-3">AGREGAR AL CARRITO</button>

                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>