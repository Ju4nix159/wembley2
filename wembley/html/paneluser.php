<?php
include 'header.php';

$db = new Database();
$con = $db->conectar();
$id_usuario =  $_SESSION['id_usuario'];

// Verificar si hay una sesión de usuario iniciada
if (isset($_SESSION['email']) && !empty($_SESSION['email']) && ($_SESSION['permisos'] == 1 || $_SESSION['permisos'] == 2)) {
    $email = $_SESSION['email'];

    /* INFORMACION DEL USUARIO */
    // Preparar y ejecutar la consulta SQL para obtener la información del usuario
    $sql_info_usuario = $con->prepare("SELECT i.*
        FROM info_usuario i
        WHERE i.id_usuario = :id_usuario");
    $sql_info_usuario->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $sql_info_usuario->execute();
    $resultado_info_usuario = $sql_info_usuario->fetch(PDO::FETCH_ASSOC);
    
    /* PEDIDOS DEL USUARIO */
    // Preparar y ejecutar la consulta SQL para obtener los pedidos del usuario
    $sql_pedidos = $con->prepare("SELECT id_pedido,fecha FROM pedidos WHERE id_usuario = :id_usuario");
    $sql_pedidos->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $sql_pedidos->execute();
    // Obtener todos los pedidos del usuario
    $resultado_pedidos = $sql_pedidos->fetchAll(PDO::FETCH_ASSOC);
    
    /* DOMICILIO DEL USUARIO */
    $sql_domicilio = $con->prepare("SELECT d.*
    FROM domicilio d
    INNER JOIN info_usuario i ON d.id_domicilio = i.id_domicilio
    WHERE i.id_usuario = :id_usuario");
    $sql_domicilio->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $sql_domicilio->execute();
    $resultado_domicilio_usuario = $sql_domicilio->fetch(PDO::FETCH_ASSOC);

}?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imagen/icono.ico" type="image/x-icon">
    <title>Panel usuario</title>
</head>

<body class="no_scroll_bar">
    <div class="panel_user">
        <h2 class="titulo centrar">Panel de usuario</h2>
        <h2>Bienvenido: <?php echo $email ?></h2>

        <div class="informacion"><!-- contenedor de toda la informacion -->

            <div class="informacion__usuario"> <!-- contenedor de la informacion del usuario -->

                <h3 class="titulo">Datos</h3>
                <div class="cuerpo_mis_compras">
                    <!-- informacion de usuario -->
                <?php if($resultado_info_usuario){?>
                    <div class="informacion__usuario__personal">
                    <h4>Mis Datos</h4>
                    <p>Nombre: <?php echo $resultado_info_usuario['nombre'] ?></p>
                    <p>Apellido: <?php echo $resultado_info_usuario['apellido'] ?></p>
                    <p>DNI: <?php echo $resultado_info_usuario['dni'] ?></p>
                    <p>Edad: <?php echo $resultado_info_usuario['edad'] ?></p>
                    <p>Sexo: <?php echo $resultado_info_usuario['id_sexo'] ?></p>
                    <p>Numero de Telefono: <?php echo $resultado_info_usuario['numtelefonico'] ?></p>
                    <button class=" boton_secundario boton_editar_informacion_personal">Editar</button>
                </div>
                <?php } else { ?>
                    <p class="centrar">No tienes información registrada.</p>
                    <p class="centrar">Para poder hacer una compra debe completar su informacion personal</p>
                    <div class="contenedor_boton centrar">
                        <a class="boton_secundario" href="añadir_info_personal.php">Completar informacion personal</a>
                    </div>

                    <?php };?>

                  
                <!-- FORMULARIO PARA EDITAR INFORMACION PERSONAL -->
                <div class="contenedor_formulario_informacion_personal hidden">
                    <form class="formulario" action="../html/admin/procesar_bd.php" method="POST">
                        <button class="boton_principal" type="submit" name="editar_informacion_personal">confirmar</button>
                    </form>
                    <div class="centrar">
                        <button class="boton_secundario boton_cancelar">cancelar</button>
                    </div>
                </div>

                
                <!-- Informacion del domiciolio del usuario -->
                <?php if($resultado_domicilio_usuario) { ?>
                    <div class="informacion__usuario__direcciones">
                        <h4>Mis Direcciones</h4>
                        <p>Provincia: <?php echo $resultado_domicilio_usuario['provincia'] ?></p>
                        <p>Localidad: <?php echo $resultado_domicilio_usuario['localidad'] ?></p>
                        <p>Barrio: <?php echo $resultado_domicilio_usuario['barrio'] ?></p>
                        <p>Calle: <?php echo $resultado_domicilio_usuario['calle'] ?></p>
                        <p>Numero: <?php echo $resultado_domicilio_usuario['numero'] ?></p>
                        <p>Codigo Postal: <?php echo $resultado_domicilio_usuario['cod_postal'] ?></p>
                        <button class="boton_secundario boton_editar_domicilio">Editar</button>
                    </div>
                <?php } else { ?>
                    <div class="completar_info">
                        <p class="centrar">No tienes información registrada.</p>
                        <p class="centrar">Para poder hacer una compra debe completar su informacion personal</p>
                        <div class="contenedor_boton centrar">
                            <a class="boton_secundario" href="añadir_domicilio.php">Completar informacion personal</a>
                        </div>
                    </div>
                <?php } ?>

                <!-- Contenedor para el formulario de edicion del domicio del usuario -->
                <div class="contenedor_formulario_domicilio hidden">
                    <form class="formulario" action="../html/admin/procesar_bd.php" method="POST">
                        
                        <input class="hidden" type="text" name="id_usuario" value="<?php echo $id_usuario ?>">

                        <p>Provincia: </p>
                        <input type="text" name="provincia" id="" value="<?php echo $resultado_domicilio_usuario['provincia']; ?>">

                        <p>Localidad: </p>
                        <input type="text" name="localidad" id="" value="<?php echo $resultado_domicilio_usuario['localidad']; ?>">

                        <p>Barrio: </p>
                        <input type="text" name="barrio" id="" value="<?php echo $resultado_domicilio_usuario['barrio']; ?>">

                        <p>Calle: </p>
                        <input type="text" name="calle" id="" value="<?php echo $resultado_domicilio_usuario['calle']; ?>">

                        <p>Numero: </p>
                        <input type="text" name="numero" id="" value="<?php echo $resultado_domicilio_usuario['numero']; ?>">

                        <p>Codigo Postal: </p>
                        <input type="text" name="cod_postal" id="" value="<?php echo $resultado_domicilio_usuario['cod_postal']; ?>">

                        <button class="boton_principal" type="submit" name="editar_domicilio">confirmar</button>
                    </form>

                    <div class="centrar">
                        <button class="boton_secundario boton_cancelar_dom">cancelar</button>
                    </div>
                </div>
            </div>
                </div>
                

            

            <div class="informacion__pedido">
                <h3 class="titulo">MIS COMPRAS</h3>

                <div class="cuerpo_mis_compras">
                    <?php
                    // Iterar a través de los pedidos e imprimir la información
                    foreach ($resultado_pedidos as $pedido) {
                        ?>
                        <div class="pedido">
                            <p>pedido n° = <?php echo $pedido['id_pedido']; ?></p>
                            <p><?php echo $pedido['fecha']; ?></p>
                            <a href="detalle_pedido.php?id=<?php echo $pedido['id_pedido']; ?>"><i class='bx bx-show icono_ojo'></i></a>
                            
                        </div>
                        <?php
                    }
                    ?>
                </div>


            </div>
        </div>
    </div>
    <script src="../js/pop_up.js"></script>
</body>

</html>

