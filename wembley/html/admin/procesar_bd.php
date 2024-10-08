<?php
session_start();
include '../../config/database.php';

$db = new Database();
$con = $db->conectar();

$id_usuario = $_SESSION["id_usuario"];

// Procesar el formulario de edición de productos si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['añadir_producto'])) {
    // Obtener el ID, nombre, descripción, precio, destacado y la nueva referencia de imagen del formulario de edición de productos
    $n_producto = $_POST["n_producto"];
    $nombreProducto = $_POST["nombre"];
    $descripcionProducto = $_POST["descripcion"];
    $nuevaCategoria = $_POST["id_categoria"];

    $sql = $con->prepare("INSERT INTO productos (n_producto, nombre, descripcion, id_categoria) 
    VALUES (:n_producto, :nombre, :descripcion, :id_categoria)");
    $sql->bindParam(':n_producto', $n_producto, PDO::PARAM_INT);
    $sql->bindParam(':nombre', $nombreProducto, PDO::PARAM_STR);
    $sql->bindParam(':descripcion', $descripcionProducto, PDO::PARAM_STR);
    $sql->bindParam(':id_categoria', $nuevaCategoria, PDO::PARAM_INT);
    $sql->execute();

    $id_producto = $con->lastInsertId();


    echo '<script>';
    echo 'alert("Cambios realizados");';
    echo 'window.location.href = "productos.php";';
    echo '</script>';
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['añadir_categoria'])) {
    $nuevaCategoria = $_POST["categoria"];


    $sql = $con->prepare("INSERT INTO categoria (nombre_categoria) 
        VALUES (:nombre_categoria)");
    $sql->bindParam(':nombre_categoria', $nuevaCategoria, PDO::PARAM_STR);
    $sql->execute();
    echo '<script>';
    echo 'alert("Cambios realizados");';
    echo 'window.location.href = "categorias.php";';
    echo '</script>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar_informacion_personal'])) {
    // Validar y actualizar la información del usuario en la base de datos
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $dni = $_POST['dni'];
    $sexo = $_POST['sexo'];

    $updateUsuario = $con->prepare("UPDATE info_usuarios SET nombre = :nombre, apellido = :apellido, dni = :dni, fecha_nacimiento = :fecha_nacimiento, id_sexo = :sexo, telefono = :telefono WHERE id_usuario = :id_usuario");
    $updateUsuario->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $updateUsuario->bindParam(':apellido', $apellido, PDO::PARAM_STR);
    $updateUsuario->bindParam(':dni', $dni, PDO::PARAM_STR);
    $updateUsuario->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $updateUsuario->bindParam(':sexo', $sexo, PDO::PARAM_STR);
    $updateUsuario->bindParam(':telefono', $telefono, PDO::PARAM_STR);
    $updateUsuario->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);

    $updateUsuario->execute();

    // Puedes agregar manejo de erroresultado_info_usuario aquí

    // Recargar la página para reflejar los cambios
    echo '<script>';
    echo 'alert("Cambios realizados");';
    echo 'window.location.href = "../paneluser.php";';
    echo '</script>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar_domicilio'])) {
    $id_usuario = $_POST['id_usuario'];
    $provincia = $_POST['provincia'];
    $localidad = $_POST['localidad'];
    $barrio = $_POST['barrio'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $cod_postal = $_POST['cod_postal'];

    $updateDom = $con->prepare(" UPDATE domicilio SET provincia = :provincia, localidad = :localidad, barrio = :barrio, calle = :calle,  numero = :numero, cod_postal = :cod_postal  WHERE id_domicilio = (SELECT id_domicilio  FROM info_usuario WHERE id_usuario = :id_usuario ) ");

    $updateDom->bindParam(':provincia', $provincia);
    $updateDom->bindParam(':localidad', $localidad);
    $updateDom->bindParam(':barrio', $barrio);
    $updateDom->bindParam(':calle', $calle);
    $updateDom->bindParam(':numero', $numero);
    $updateDom->bindParam(':cod_postal', $cod_postal);
    $updateDom->bindParam(':id_usuario', $id_usuario);

    $updateDom->execute();

    echo '<script>';
    echo 'alert("Cambios realizados");';
    echo 'window.location.href = "../paneluser.php";';
    echo '</script>';
}
