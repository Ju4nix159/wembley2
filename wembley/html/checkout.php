<?php
    include('header.php');
    include('footer.php');

    $db = new Database();
    $con = $db->conectar();

    $usuario = $_SESSION["id_usuario"]; 
    $query_info_usuario = "SELECT * FROM info_usuario WHERE id_usuario = :usuario";
    $stmt_info_usuario = $con->prepare($query_info_usuario);
    $stmt_info_usuario->bindParam(':usuario', $usuario);
    $stmt_info_usuario->execute();
    $info_usuario = $stmt_info_usuario->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario tiene id_domicilio asociado en info_usuario
    $tiene_id_domicilio = !empty($info_usuario['id_domicilio']);

    // Comprobar si el usuario tiene información en id_domicilio
    $tiene_info_domicilio = $tiene_id_domicilio ? true : false; // Si tiene id_domicilio, entonces tiene info_domicilio

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
</head>
<body>
    <div class="contenedor_checkout">
        <h1 class="titulo centrar">Checkout - Detalles del Carrito</h1>

        <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Confirmar la compra</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Al terminar la compra se genera el pedido y se mandara un mail con el detalle de su compra</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <a  href="paneluser.php" type="button" class="btn btn-primary" id="finalizarCompra">Confirmar compra</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    
        <div class="tabla">
            <table>
                    <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio por unidad</th>
                        <th>Precio total</th>
                    </tr>
                    </thead>
    
                    <tbody class="cuerpo_tabla" id='table_body'>
    
                    </tbody>
                    <tfoot>
                    <tr id='columna_total'>
                        <td colspan="3">Total</td>
                        <td id='total_precio'>0</td>
                    </tr>
                    </tfoot>
            </table>
            
            <?php if ($tiene_info_domicilio): ?>
                <button type="button" data-toggle="modal" data-target="#modal-default" class="boton_principal" >Finalizar Compra</button>
            <?php else: ?>
                <a href="paneluser.php" class="boton_principal">Ir a Panel de Usuario para llenar la información</a>
            <?php endif; ?>
        </div>  
    </div>

    <script src="../js/script.js"></script>
    <script src="../js/carrito.js"></script>
</body>
</html>
