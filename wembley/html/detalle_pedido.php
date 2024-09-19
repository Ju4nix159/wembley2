<?php
include '../../config/database.php';



// archivo "detalle_pedido.php"
if (isset($_POST['id_pedido'])) {
    $id_pedido = $_POST['id_pedido'];
    
    // Aquí haces la consulta a la base de datos para obtener el detalle del pedido
    $sql_pedidos = $con->prepare("SELECT * FROM pedidos WHERE id_pedido = :id_pedido");    
    // Generas el HTML del detalle del pedido
    if ($detalle_pedido) {
        echo '<h5>Detalle del Pedido #' . $detalle_pedido["id_pedido"] . '</h5>';
        echo '<p>Fecha: ' . $detalle_pedido["fecha"] . '</p>';
        echo '<p>Total: ' . $detalle_pedido["total"] . '</p>';
        echo '<p>Estado: ' . $detalle_pedido["estado"] . '</p>';
        // Y otros detalles adicionales
    } else {
        echo '<p>No se encontró el detalle del pedido.</p>';
    }
}






$consulta_pedido = "
    SELECT pe.fecha, pp.id_compra, p.nombre AS nombre_producto, p.descripcion AS descripcion_producto, pp.cantidad, pp.precio
    FROM pedidos pe
    INNER JOIN pedido_productos pp ON pe.id_pedido = pp.id_pedido
    INNER JOIN productos p ON pp.id_producto = p.id_producto
    WHERE pe.id_usuario = :id_usuario
    AND pe.id_pedido = :id_pedido
";
$stmt_pedido = $con->prepare($consulta_pedido);
$stmt_pedido->bindParam(':id_usuario', $userid, PDO::PARAM_INT);
$stmt_pedido->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
$stmt_pedido->execute();
$pedido = $stmt_pedido->fetchAll(PDO::FETCH_ASSOC);



?>

<div class="card-body">
    <h5 class="card-title">Resumen de Pedido #<span id="orderNumber"></span></h5>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="orderProductsList">
        </tbody>
    </table>
    <div class="text-end">
        <strong>Total del Pedido: $<span id="orderTotal"></span></strong>
    </div>
    <button class="btn btn-secondary mt-3" onclick="hideOrderDetails()">Cerrar</button>
</div>