<?php
// Incluir archivos necesarios
include 'header.php';



// Obtener el id_pedido desde la URL
$id_pedido = isset($_GET['id']) ? $_GET['id'] : null;

// Verificar si se proporcionó un id_pedido válido
if (!$id_pedido) {
    // Redireccionar al usuario a alguna página de error o página de inicio
    header("Location: error.php");
    exit;
}

// Conexión a la base de datos
$db = new Database();
$con = $db->conectar();

// Obtener el email del usuario de la sesión
$email = $_SESSION['email'];

$userid = $_SESSION['id_usuario'];

// Consultar la base de datos para obtener información del pedido
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Pedido</title>
</head>
<body>
    <div class="contenedor_resumen_pedido">
        <h2 class="titulo centrar">Resumen Pedido</h2>
        <div class="contenedor_resumen_pedido__texto">
            <p>pedido n°: <?php echo $id_pedido; ?></p>
            <p>Fecha: <?php echo date("d/m/Y", strtotime($pedido[0]['fecha'])); ?></p>


        </div>

        <div class="tabla">
            <table>
                <thead>
                    <tr>
                        <th>Producto ID</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio/U</th>
                        <th>Precio total</th>
                    </tr>
                </thead>
                <tbody class="cuerpo_tabla" id='table_body'>
                    <?php
                    // Iterar a través de los productos del pedido
                    $precio_total_pedido = 0;
                    foreach ($pedido as $producto) {
                        $precio_total_producto = $producto['precio'] * $producto['cantidad'];
                        $precio_total_pedido += $precio_total_producto;
                        echo "<tr>";
                        echo "<td>{$producto['id_compra']}</td>";
                        echo "<td>{$producto['nombre_producto']}</td>";
                        echo "<td>{$producto['cantidad']}</td>";
                        echo "<td>{$producto['precio']}</td>";
                        echo "<td>$precio_total_producto</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr id='columna_total'>
                        <td colspan="4">Total</td>
                        <td id='total_precio'><?php echo $precio_total_pedido; ?></td>
                    </tr>
                </tfoot>
            </table>
            <a class="boton_principal" href="paneluser.php">Cerrar</a>
        </div>  
    </div>
</body>
</html>

