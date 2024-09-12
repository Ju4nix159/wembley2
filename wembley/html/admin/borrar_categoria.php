<?php
require '../../config/database.php';

$db = new Database();
$con = $db->conectar();

// Verificar si se ha recibido el parámetro id_categoria
if (isset($_GET['id_categoria'])) {
    // Obtener el id_categoria
    $id_categoria = $_GET['id_categoria'];

    try {
        // Verificar si la categoría está asociada a algún producto
        $sql_verificar_producto_categoria = $con->prepare("SELECT COUNT(*) FROM productos WHERE id_categoria = :id_categoria");
        $sql_verificar_producto_categoria->bindParam(':id_categoria', $id_categoria);
        $sql_verificar_producto_categoria->execute();
        $num_productos_categoria = $sql_verificar_producto_categoria->fetchColumn();

        if ($num_productos_categoria > 0) {
            // Si la categoría está asociada a algún producto, mostrar un mensaje de error o redirigir a una página de error
            echo "<script>";
            echo "alert('No se puede eliminar esta categoría porque está asociada a uno o más productos.');";
            echo 'window.location.href = "categorias.php";';
            echo "</script>";
            exit();
        } else {
            // Mostrar cuadro de diálogo de confirmación
            echo 
            '<script>
                    var confirmacion = confirm("¿Está seguro de que desea eliminar esta categoría?");

                    if (confirmacion) {
                        // Si el usuario confirma, redirigir a esta misma página con el parámetro confirmado=true
                        window.location.href = "borrar_categoria.php?id_categoria=' . $id_categoria . '&confirmado=true";
                    } else {
                        // Si el usuario cancela, redirigir a categorias.php
                        window.location.href = "categorias.php";
                    }
                </script>';
        }
    } catch (PDOException $e) {
        echo "Error al verificar productos en la categoría: " . $e->getMessage();
    }
} else {
    // Si no se recibió el parámetro id_categoria, mostrar un mensaje de error o redirigir a una página de error
    echo "Error: No se proporcionó un ID de categoría.";
}

// Verificar si se ha confirmado la eliminación y realizar la eliminación
if (isset($_GET['confirmado']) && $_GET['confirmado'] === "true") {
    // Obtener el id_categoria
    $id_categoria = $_GET['id_categoria'];

    try {
        // Eliminar la categoría de la tabla categorias
        $sql_eliminar_categoria = $con->prepare("DELETE FROM categoria WHERE id_categoria = :id_categoria");
        $sql_eliminar_categoria->bindParam(':id_categoria', $id_categoria);
        $sql_eliminar_categoria->execute();

        header("Location: categorias.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al eliminar la categoría: " . $e->getMessage();
    }
}
