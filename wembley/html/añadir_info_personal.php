<!-- FORMULARIO PARA AÑADIR INFORMACION PERSONAL DEL USUARIO -->

<?php
include 'header.php';

$db = new Database();
$con = $db->conectar();
$id_usuario = $_SESSION["id_usuario"];
/* AÑADIR INFORMACION PEROSNAL POR PRIMERA VEZ */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['añadir_informacion_personal'])) {
    // Obtener el ID, nombre, descripción, precio, destacado y la nueva referencia de imagen del formulario de edición de productos
        $id_usuario = $_POST["id_usuario"]; 
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $dni = $_POST["dni"];
        $edad = $_POST["edad"];
        $sexo = $_POST["id_sexo"];
        $numero_telefono = $_POST["numtelefonico"];
    
        $sql = $con->prepare("INSERT INTO info_usuario (id_usuario, nombre,apellido, dni,edad,id_sexo,numtelefonico) VALUES (:id_usuario, :nombre, :apellido, :dni, :edad, :id_sexo, :numtelefonico)");
        
        $sql->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
        $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $sql->bindParam(':apellido', $apellido, PDO::PARAM_INT);
        $sql->bindParam(':dni', $dni, PDO::PARAM_STR);
        $sql->bindParam(':edad', $edad, PDO::PARAM_STR);
        $sql->bindParam(':id_sexo', $id_sexo, PDO::PARAM_INT);
        $sql->bindParam(':numtelefonico', $numero_telefono, PDO::PARAM_STR);
        $sql->execute();

        echo '<script>';
        echo 'alert("Informacion Personal agregada  con exito");';
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
    <h2 class="titulo centrar">Agregar Información Personal</h2>
     <!-- FORMULARIO PARA AÑADIR INFORMACION PERSONAL -->
     <div class="contenedor_formulario_informacion_personal">
                    <form class="formulario" action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
                        <div class="entradas">
                            <input class="hidden" type="" name="id_usuario" value="<?php  echo $id_usuario ?>"/>
    
                            <p>Nombre: </p>
                            <input type="text" name="nombre" require>
    
                            <p>Apellido: </p>
                            <input type="text" name="apellido" require>
    
                            <p>DNI: </p>
                            <input type="text" name="dni" require>
    
                            <p>Edad: </p>
                            <input type="text" name="edad" require>
    
                            <p>Sexo: </p>
                            <?php 
                                $sql_nombre_sexo = $con->prepare("SELECT * FROM sexo");
                                $sql_nombre_sexo -> execute();
                                $nombres_sexo = $sql_nombre_sexo->fetchAll();
                            ?>
                            <select class="" name="id_sexo">
                                <?php foreach ($nombres_sexo as $row) {
                                $selected = ($row["id_sexo"] == $id_usuario["id_sexo"]) ? "selected" : "";
                                echo '<option value="' . $row["id_sexo"] . '" ' . $selected . '>' . $row["nombre"] . '</option>';
                                } ?>
                            </select>
    
                            <p>Numero de Telefono: </p>
                            <input type="text" name="numtelefonico" require>
                        </div>
                        <div class="botones_entradas">
                            <button class="boton_principal" type="submit" name="añadir_informacion_personal" >confirmar</button>
                            <a class="boton_secundario" href="paneluser.php">Cancelar</a>
                        </div>

                    </form>
                </div>
</body>
</html>