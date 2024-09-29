<?php

include 'navbar.php';
include "../config/database.php";
$sql_productos = $con->query("SELECT
    p.id_producto,
    p.nombre AS nombre_producto,
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
    v.id_variante = (
        SELECT MIN(vp2.id_variante)
        FROM variante_producto vp2
        WHERE vp2.id_producto = p.id_producto
    );");
$sql_productos->execute();
$productos = $sql_productos->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>

</head>

<body>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="filter-sidebar">
                    <h4>Buscar</h4>
                    <input type="text" class="form-control mb-3" placeholder="Buscar productos...">

                    <h4>Filtrar por categoría</h4>
                    <div class="mb-3">
                        <button class="btn btn-sm btn-primary me-2 mb-2">Categoría 1</button>
                        <button class="btn btn-sm btn-primary me-2 mb-2">Categoría 2</button>
                        <button class="btn btn-sm btn-primary me-2 mb-2">Categoría 3</button>
                    </div>

                    <h4>Rango de precio</h4>
                    <input type="range" class="form-range mb-3" min="0" max="1000" step="10" id="priceRange">
                    <div class="d-flex justify-content-between">
                        <span>$0</span>
                        <span>$1000</span>
                    </div>

                    <button class="btn btn-success mt-3">Aplicar Filtros</button>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php foreach ($productos as $producto) { ?>
                        <div class="col">
                            <div class="card h-100 bg-dark text-white">
                                <img src="https://via.placeholder.com/300x300" class="card-img-top" alt="Producto de prueba">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $producto["nombre_producto"] ?></h5>
                                    <p class="card-text"><strong> <?php echo number_format($producto["precio"], 2, '.', ','); ?></strong></p>
                                    <div class="d-flex justify-content-between">
                                        <button 
                                            <?php if(!isset($_SESSION["usuario"])) {?>
                                                onclick="mostrarModal()"
                                            <?php } ?>
                                            class="btn btn-primary btn_añadir" 
                                            data-producto-id="<?php echo $producto['id_producto']; ?>" 
                                            data-producto-nombre="<?php echo $producto['nombre_producto']; ?>" 
                                            data-producto-precio="<?php echo $producto['precio']; ?>">
                                            Añadir
                                        </button>
                                        <a href="detalle.php?id_producto=<?php echo $producto['id_producto']; ?>" class="btn btn-secondary">Detalle</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="avisoModal" tabindex="-1" aria-labelledby="avisoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="avisoModalLabel">Aviso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Para agregar productos al carrito, es necesario iniciar sesión.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a href="pagina-de-inicio-sesion.html" class="btn btn-primary">Ir a Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <?php include("footer.php") ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function mostrarModal() {
            var myModal = new bootstrap.Modal(document.getElementById('avisoModal'))
            myModal.show()
        }
    </script>
    <script src="../js/catalogo.js"></script>

</body>

</html>