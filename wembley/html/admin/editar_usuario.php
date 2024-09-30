
<?php
  
  include '../admin/header.php';
  include '../admin/aside.php';
  include '../admin/footer.php';



  $id_usuario = $_GET['id_usuario'];

  $sql_email_usuario = $con->prepare("SELECT p.nombre, u.email, u.id_permiso  FROM usuarios u JOIN permisos p ON u.id_permiso = p.id_permiso WHERE u.id_usuario = :id_usuario;");
  $sql_email_usuario->bindParam(':id_usuario',$id_usuario);
  $sql_email_usuario->execute();
  $email_usuario = $sql_email_usuario->fetch(PDO::FETCH_ASSOC);

  // Procesar el formulario de edición de usuarios si se ha enviado
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_usuario'])) {
    // Obtener el ID del permiso seleccionado
    $id_permiso = $_POST["id_permiso"];
    $id_usuario = $_POST["id_usuario"];

    // Validar y actualizar los permisos en la base de datos para usuarios
    $sql_actualizar_usuario = $con->prepare("UPDATE usuarios SET id_permiso = :id_permiso WHERE id_usuario = :id_usuario");
    $sql_actualizar_usuario->bindParam(':id_permiso', $id_permiso, PDO::PARAM_INT);
    $sql_actualizar_usuario->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $sql_actualizar_usuario->execute();

    // Mostrar mensaje de éxito y redirigir
    echo '<script>';
    echo 'alert("Cambios realizados");';
    echo 'window.location.href = "usuarios.php";';
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
            <h1 class="m-0">Editar Ususario</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">inicio</a></li>
              <li class="breadcrumb-item active">Editar usuario</></li>
              
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
                <h3 class="card-title">Cambio de permisos del ususario: <?php echo $email_usuario["email"]; ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              
              <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'];?>" method="POST" >
                <div class="card-body">

                  <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">


                  <div class="form-group row ">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Permisos </label>
                    <div class="col-sm-10">
                      
                      <?php 
                        $sql_nombre_permisos = $con->prepare("SELECT id_permiso, nombre FROM permisos");
                        $sql_nombre_permisos -> execute();
                        $nombres_permisos = $sql_nombre_permisos->fetchAll();
                      ?>
                      <select class="form-control" name="id_permiso">
                        <?php foreach ($nombres_permisos as $row) {
                          $selected = ($row["id_permiso"] == $email_usuario["id_permiso"]) ? "selected" : "";
                          echo '<option value="' . $row["id_permiso"] . '" ' . $selected . '>' . $row["nombre"] . '</option>';
                        } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="editar_usuario" class="btn btn-info">Guardar</button>
                  <a class="btn btn-default float-right" href="usuarios.php">cancelar</a>
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
