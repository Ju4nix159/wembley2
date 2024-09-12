
<?php
  
  include '../admin/header.php';
  include '../admin/aside.php';
  include '../admin/footer.php';

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
            <h1 class="m-0">Gestion Pedidos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gestion Pedidos</></li>
              
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
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">pedidos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="pedidos" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id_pedido</th>
                    <th>Nombre</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    // Obtener datos de usuarios
                    $sql_pedidos = $con->prepare("SELECT pedidos.id_pedido, info_usuario.nombre, pedidos.total, pedidos.fecha FROM pedidos INNER JOIN info_usuario ON pedidos.id_usuario = info_usuario.id_usuario");
                    $sql_pedidos->execute();
                   $pedidos = $sql_pedidos->fetchAll(PDO::FETCH_ASSOC);

                    foreach($pedidos as $pedido) { ?>
                        <tr>
                          <td> <?php echo $pedido['id_pedido'] ?></td>
                          <td> <?php echo $pedido['nombre'] ?> </td>
                          <td> <?php echo $pedido['total'] ?></td>
                          <td> <?php echo $pedido['fecha'] ?></td>

                          
                          <td>
                              <a href="resumen_pedido.php?id_pedido=<?php echo $pedido['id_pedido']; ?>" type="button" class="btn bg-orange btn-flat margin"> <i class="fas fa-search"></i></i></a>
                              

                            </td>
                        </tr>
                    <?php }?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Id_pedido</th>
                    <th>Nombre</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                  </tr>

                  </tfoot>
                </table>

                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a class="btn btn-default float-right" href="usuarios.php">volver</a>
              </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">total gastado por usuario</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="gastos" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Total Comprado</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    // Obtener datos de usuarios
                    $sql_pedidos = $con->prepare("SELECT info_usuario.nombre, SUM(pedidos.total) AS total_pedidos FROM pedidos JOIN info_usuario ON pedidos.id_usuario = info_usuario.id_usuario GROUP BY info_usuario.nombre;");
                    $sql_pedidos->execute();
                   $pedidos = $sql_pedidos->fetchAll(PDO::FETCH_ASSOC);

                    foreach($pedidos as $pedido) { ?>
                        <tr>
                          <td> <?php echo $pedido['nombre'] ?> </td>
                          <td> <?php echo $pedido['total_pedidos'] ?></td>
                          
                        </tr>
                    <?php }?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Nombre</th>
                    <th>Total Comprado</th>
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
