
<?php
  
  include '../admin/header.php';
  include '../admin/aside.php';
  include '../admin/footer.php';



  $id_categoria = $_GET['id_categoria'];

  $sql_categoria = $con->prepare("SELECT * FROM categoria WHERE id_categoria = :id_categoria");
  $sql_categoria->bindParam(':id_categoria',$id_categoria);
  $sql_categoria->execute();
  $categoria = $sql_categoria->fetch(PDO::FETCH_ASSOC);

  // Procesar el formulario de edición de categorias si se ha enviado
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_categoria'])) {

    $id_categoria = $_POST['id_categoria'];

    $nuevoNombreCategoria = $_POST['nombre_categoria'];

    // Validar y actualizar los permisos en la base de datos para categorias
    $sql_actualizar_categoria = $con->prepare("UPDATE categoria SET nombre_categoria = :nombre_categoria WHERE id_categoria = :id_categoria");
    $sql_actualizar_categoria->bindParam(':nombre_categoria', $nuevoNombreCategoria, PDO::PARAM_STR);
    $sql_actualizar_categoria->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
    $sql_actualizar_categoria->execute();

    // Mostrar mensaje de éxito y redirigir
    echo '<script>';
    echo 'alert("Cambios realizados");';
    echo 'window.location.href = "categorias.php";';
    echo '</script>';

  }


  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar categorias</title>


</head>
<div class="wrapper">


  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Editar categoria</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">inicio</a></li>
              <li class="breadcrumb-item ">Editar categoria</></li>
              <li class="breadcrumb-item active"><?php echo $categoria['nombre_categoria']?></li>

              
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
                <h3 class="card-title">Editar categoria "<?php echo $categoria['nombre_categoria']?>"</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              
              <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'];?>" method="POST" >
                <div class="card-body">

                  <input type="hidden" name="id_categoria" value="<?php echo $id_categoria; ?>">

                  <div class="form-group row">
                    <label for="nombre_categoria" class="col-sm-2 col-form-label">nombre</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" value="<?php echo $categoria['nombre_categoria']?>">
                    </div>

                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="editar_categoria" class="btn btn-info">Guardar</button>
                  <a class="btn btn-default float-right" href="categorias.php">cancelar</a>
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
