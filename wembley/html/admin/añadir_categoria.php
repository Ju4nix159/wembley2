
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
  <title>Añadir Categoria</title>


</head>
<div class="wrapper">


  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Añadir Categoria</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">inicio</a></li>
              <li class="breadcrumb-item"><a href="productos.php">Categoria</a></li>
              <li class="breadcrumb-item active">Añadir Categoria</></li>
              
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
                <h3 class="card-title">Añadir Categoria</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form class="form-horizontal" action="procesar_bd.php" method="POST">
                <div class="card-body">

                  <div class="form-group row">
                    <label for="categoria" class="col-sm-2 col-form-label">categoria</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="categoria" name="categoria" required>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="añadir_categoria" class="btn btn-info">Guardar</button>
                  <a class="btn btn-default float-right" href="categorias.php">Cancelar</a>
                </div>
                <!-- /.card-footer -->
              </form>


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
