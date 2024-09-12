<?php
include('header.php');

// Establece la conexión a la base de datos (reemplaza con tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sarmienspace_db_tienda_2";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir los datos enviados desde JavaScript

$data = json_decode(file_get_contents("php://input"), true);

$id_usuario = $_SESSION['id_usuario'];

// Calcula el total del pedido
$total_pedido = 0;
foreach ($data as $item) {
    $precio = $item['price'];
    $cantidad = $item['quantity'];
    $total_producto = $precio * $cantidad;
    $total_pedido += $total_producto;
}

// Inserta un nuevo pedido
$sql = "INSERT INTO pedidos (id_usuario, total) VALUES ($id_usuario, $total_pedido)";
if ($conn->query($sql) !== TRUE) {
    // Manejar el error según tus necesidades
    echo json_encode(['success' => false, 'error' => $conn->error]);
    $conn->close();
    exit;
}

// Obtiene el ID del pedido recién insertado
$id_pedido = $conn->insert_id;

foreach ($data as $item) {
    $id_producto = $item['id']; // Obtener el ID del producto
    $cantidad = $item['quantity']; // Obtener la cantidad del producto
    $precio = $item['price'];

    // Realizar la inserción en la tabla de pedidos
    $sql = "INSERT INTO pedido_productos (id_pedido, id_producto, cantidad, precio) VALUES ($id_pedido, $id_producto, $cantidad, $precio)";

    if ($conn->query($sql) !== TRUE) {
        // Manejar el error según tus necesidades
        echo json_encode(['success' => false, 'error' => $conn->error]);
        $conn->close();
        exit;
    }
}
// Cierra la conexión
$conn->close();

// Retorna una respuesta de éxito
echo json_encode(['success' => true]);
?>
