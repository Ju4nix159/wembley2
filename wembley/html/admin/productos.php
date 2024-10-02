
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
            <h1 class="m-0">Gestion Productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gestion Productos</></li>
              
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
          <div class="col-13">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Productos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>N_Producto</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Categoria</th>
                    <th>acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql_productos = $con->prepare
                    ("SELECT p.*, c.nombre AS nombre_categoria
                    FROM productos AS p
                    LEFT JOIN categorias AS c ON p.id_categoria = c.id_categoria
                    ");
                    $sql_productos->execute();
                    $Productos = $sql_productos->fetchAll(PDO::FETCH_ASSOC);

                    foreach($Productos as $producto) { ?>
                        <tr>
                          <td> <?php echo $producto['id_producto'] ?></td>
                          <td> <?php echo $producto['n_producto'] ?></td>
                          <td> <?php echo $producto['nombre'] ?> </td>
                          <td> <?php echo $producto['descripcion'] ?></td>
                          <td> <?php echo $producto['nombre_categoria'] ?></td>
                          <td>
                              <a href="variantes.php?id_producto=<?php echo $producto['id_producto']; ?>" type="button" class="btn bg-orange btn-flat margin"> <i class="fas fa-user-edit"></i></a>
                            </td>
                        </tr>
                    <?php }?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>N_Producto</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Categoria</th>
                    <th>acciones</th>
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
