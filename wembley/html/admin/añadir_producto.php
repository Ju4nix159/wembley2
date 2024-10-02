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
  <link rel="stylesheet" href="css/app.css">
  <title>Añadir Producto</title>
</head>
<body>
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Añadir Producto</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Inicio</a></li>
              <li class="breadcrumb-item"><a href="productos.php">Productos</a></li>
              <li class="breadcrumb-item active">Añadir Producto</li>
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
                <h3 class="card-title">Añadir Producto</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="procesar_bd.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="n_producto" class="col-sm-3 col-form-label">N_producto</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="n_producto" name="n_producto" placeholder="Ingrese un número de producto único" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="nombre" class="col-sm-3 col-form-label">Nombre</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre del producto" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="descripcion" class="col-sm-3 col-form-label">Descripción</label>
                        <div class="col-sm-9">
                          <textarea id="descripcion" class="form-control" rows="3" name="descripcion" placeholder="Ingrese una descripción del producto"></textarea>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="id_categoria" class="col-sm-3 col-form-label">Categorías</label>
                        <div class="col-sm-9">
                          <?php 
                          $sql_nombre_categoria = $con->prepare("SELECT * FROM categorias");
                          $sql_nombre_categoria->execute();
                          $nombres_categoria = $sql_nombre_categoria->fetchAll();
                          ?>
                          <select class="form-control" name="id_categoria" required>
                            <option value="" disabled selected>Eliga una categoria</option>
                            <?php foreach ($nombres_categoria as $row) { ?>
                              <option value="<?php echo $row["id_categoria"] ?>"> <?php echo $row["nombre"] ?> </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="añadir_producto" class="btn btn-info">Guardar</button>
                  <a class="btn btn-default float-right" href="productos.php">Cancelar</a>
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
