
<?php
  
  include '../admin/header.php';
  include '../admin/aside.php';
  include '../admin/footer.php';



  $id_pedido = $_GET['id_pedido'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel administrado</title>


</head>
<div class="wrapper">


  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Resumen de pedido</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">inicio</a></li>
              <li class="breadcrumb-item"><a href="pedidos.php">pedidos</a></li>
              <li class="breadcrumb-item active"><?php echo $id_pedido ?></li>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-8">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Resumen de pedido ID: <?php echo $id_pedido ?></h3>
              </div>
              <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>id_compra</th>
                    <th>id_pedido</th>
                    <th>id_producto</th>
                    <th>cantidad</th>
                    <th>precio</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    // Obtener datos del pedido
                    $sql_pedidos = $con->prepare("SELECT * FROM pedido_productos WHERE id_pedido = :id_pedido");
                    $sql_pedidos->bindParam(":id_pedido", $id_pedido);
                    $sql_pedidos->execute();
                    $pedidos = $sql_pedidos->fetchAll(PDO::FETCH_ASSOC);

                    foreach($pedidos as $pedido) { ?>
                        <tr>
                          <td> <?php echo $pedido['id_compra'] ?></td>
                          <td> <?php echo $pedido['id_pedido'] ?> </td>
                          <td> <?php echo $pedido['id_producto'] ?></td>
                          <td> <?php echo $pedido['cantidad'] ?> </td>
                          <td> <?php echo $pedido['precio'] ?> </td>
                        </tr>
                    <?php }?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>id_compra</th>
                    <th>id_pedido</th>
                    <th>id_producto</th>
                    <th>cantidad</th>
                    <th>precio</th>
                  </tr>

                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
</div>
<!-- ./wrapper -->
<script src="../admin/js/app.js"></script>

</body>
</html>
