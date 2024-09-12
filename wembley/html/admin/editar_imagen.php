
<?php
  
  include '../admin/header.php';
  include '../admin/aside.php';
  include '../admin/footer.php';



  $id_imagen = $_GET['id_imagen'];

  $sql_informacion_imagen = $con->prepare("SELECT * FROM imagenes WHERE id_imagen = :id_imagen");
  $sql_informacion_imagen->bindParam(':id_imagen', $id_imagen, PDO::PARAM_INT);
  $sql_informacion_imagen->execute();
  $informacion_imagen = $sql_informacion_imagen->fetch(PDO::FETCH_ASSOC);
  
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_imagen'])) {
      // Obtener datos del formulario
      $nombre_imagen = $_POST["nombre_imagen"];
      
      // Validar y actualizar la información en la base de datos para imágenes
      $sql_actualizar_imagen = $con->prepare("UPDATE imagenes SET nombre_imagen = :nombre_imagen WHERE id_imagen = :id_imagen");
      $sql_actualizar_imagen->bindParam(':id_imagen', $id_imagen, PDO::PARAM_INT);
      $sql_actualizar_imagen->bindParam(':nombre_imagen', $nombre_imagen, PDO::PARAM_STR);
      $sql_actualizar_imagen->execute();
  
      echo '<script>';
      echo 'alert("Cambios realizados");';
      echo 'window.location.href = "productos.php";'; // Redirecciona a la página de productos
      echo '</script>';
  }
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
            <h1 class="m-0">Editar imagen</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">inicio</a></li>
              <li class="breadcrumb-item"><a href="productos.php">productos</a></li>
              <li class="breadcrumb-item active">Editar imagen</li>
              
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
                <h3 class="card-title">imagen ID: </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form class="form-horizontal" action="<?php ($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nombre_imagen" class="col-sm-2 col-form-label">Nombre de la imagen</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombre_imagen" name="nombre_imagen" value="<?php echo $informacion_imagen["nombre_imagen"]; ?>" placeholder="Ingrese un nuevo nombre para la imagen">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="editar_imagen" class="btn btn-info">Guardar</button>
                    <a class="btn btn-default float-right" href="productos.php">Cancelar</a>
                </div>
              </form>


            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->

  
</div>



<script src="../admin/js/app.js"></script>

</body>
</html>
