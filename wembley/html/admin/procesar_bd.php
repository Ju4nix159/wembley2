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
    $precioProducto = $_POST["precio"];
    $destacadoProducto = $_POST["destacado"];
    $nuevaCategoria = $_POST["id_categoria"];
    $stock = $_POST["stock"];

    // Insertar el producto en la tabla de productos
    $rutaImagenes = array(); // Array para almacenar las rutas de las imágenes



    // Insertar el producto en la tabla de productos
    $sql = $con->prepare("INSERT INTO productos (n_producto, nombre, descripcion, precio, destacado, id_categoria, stock) 
    VALUES (:n_producto, :nombre, :descripcion, :precio, :destacado, :id_categoria, :stock)");
    $sql->bindParam(':n_producto', $n_producto, PDO::PARAM_INT);
    $sql->bindParam(':nombre', $nombreProducto, PDO::PARAM_STR);
    $sql->bindParam(':descripcion', $descripcionProducto, PDO::PARAM_STR);
    $sql->bindParam(':precio', $precioProducto, PDO::PARAM_STR);
    $sql->bindParam(':destacado', $destacadoProducto, PDO::PARAM_INT);
    $sql->bindParam(':id_categoria', $nuevaCategoria, PDO::PARAM_INT);
    $sql->bindParam(':stock', $stock, PDO::PARAM_INT);
    $sql->execute();

    // Obtener el ID del producto recién insertado
    $id_producto = $con->lastInsertId();

    // Ruta donde se almacenarán las imágenes
    $rutaCarpeta = "../../imagen/botines/$id_producto/";

    // Verificar si la carpeta no existe y crearla si es necesario
    if (!file_exists($rutaCarpeta)) {
        mkdir($rutaCarpeta, 0777, true); // Crear carpeta recursivamente
    }


    if (isset($_FILES['referencia_imagen'])) {
        // Ruta donde se almacenarán las imágenes
        $rutaCarpeta = "../../imagen/botines/$id_producto/";

        // Subir cada imagen y guardar su ruta en el array
        // Subir cada imagen y guardar su ruta en el array
        foreach ($_FILES['referencia_imagen']['tmp_name'] as $key => $tmp_name) {
            $nombreArchivo = $_FILES['referencia_imagen']['name'][$key];
            $rutaDestino = $rutaCarpeta . $nombreArchivo;
            move_uploaded_file($_FILES['referencia_imagen']['tmp_name'][$key], $rutaDestino);
            $rutaImagenes[] = $nombreArchivo; // Agregar la ruta al array
        }
    }

    // Insertar las imágenes en la tabla de imágenes
    $id_imagen = 1;
    foreach ($rutaImagenes as $ruta) {

        $sql_imagen = $con->prepare("INSERT INTO imagenes (id_imagen, id_producto, nombre_imagen) VALUES (:id_imagen, :id_producto, :nombre_imagen)");
        $sql_imagen->bindParam(':id_imagen', $id_imagen, PDO::PARAM_INT);
        $sql_imagen->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $sql_imagen->bindParam(':nombre_imagen', $ruta, PDO::PARAM_STR);
        $sql_imagen->execute();
        $id_imagen++;
    }



    // Redirigir a la página de productos después de realizar los cambios
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
