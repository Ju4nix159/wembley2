<!-- GENERA EL FORMULARIO PARA AÑADIR INFORMACION PERSONAL -->


<?php
include 'header.php';

$db = new Database();
$con = $db->conectar();
$id_usuario = $_SESSION["id_usuario"];
/* AÑADIR INFORMACION PEROSNAL POR PRIMERA VEZ */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['añadir_domicilio'])) {
    // Obtener los datos del formulario
    $id_usuario = $_POST["id_usuario"];
    $provincia = $_POST["provincia"]; 
    $localidad = $_POST["localidad"];
    $barrio = $_POST["barrio"];
    $calle = $_POST["calle"];
    $numero = $_POST["numero"];
    $cod_postal = $_POST["cod_postal"];

    // Insertar el domicilio en la tabla domicilio
    $sql = $con->prepare("INSERT INTO domicilio (provincia, localidad, barrio, calle, numero, cod_postal) VALUES (:provincia, :localidad, :barrio, :calle, :numero, :cod_postal)");
    $sql->bindParam(':provincia', $provincia, PDO::PARAM_STR);
    $sql->bindParam(':localidad', $localidad, PDO::PARAM_STR);
    $sql->bindParam(':barrio', $barrio, PDO::PARAM_STR);
    $sql->bindParam(':calle', $calle, PDO::PARAM_STR);
    $sql->bindParam(':numero', $numero, PDO::PARAM_STR);
    $sql->bindParam(':cod_postal', $cod_postal, PDO::PARAM_INT);
    $sql->execute();

    // Obtener el id_domicilio insertado
    $id_domicilio = $con->lastInsertId();

    // Insertar el id_domicilio en la tabla info_usuario para el id_usuario actual de la sesión
    $sql_info_usuario = $con->prepare("UPDATE info_usuario SET id_domicilio = :id_domicilio WHERE id_usuario = :id_usuario");
    $sql_info_usuario->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT); // Asegúrate de tener el id_usuario de la sesión disponible
    $sql_info_usuario->bindParam(':id_domicilio', $id_domicilio, PDO::PARAM_INT);
    $sql_info_usuario->execute();

    echo '<script>';
    echo 'alert("Informacion de domicilio agregada  con exito");';
    echo 'window.location.href = "paneluser.php";';
    echo '</script>';
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir informacion personal</title>
</head>
<body class="no_scroll_bar">


     <!-- FORMULARIO PARA AÑADIR INFORMACION PERSONAL -->
     <<div class="contenedor_formulario_informacion_personal">
        <form class="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <input class="hidden" type="text" name="id_usuario" id="" value="<?php echo $id_usuario?>">

            <p>Provincia: </p>
            <input type="text" name="provincia" id="" >

            <p>Localidad: </p>
            <input type="text" name="localidad" id="" >

            <p>Barrio: </p>
            <input type="text" name="barrio" id="">

            <p>Calle: </p>
            <input type="text" name="calle" id="" >

            <p>Numero: </p>
            <input type="text" name="numero" id="" >

            <p>Codigo Postal: </p>
            <input type="text" name="cod_postal" id="" >

            <button class="boton_principal" type="submit" name="añadir_domicilio" >confirmar</button>
            <a class="boton_secundario" href="paneluser.php">Cancelar</a>
        </form>

        
    </div>
</body>
</html>