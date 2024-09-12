
<?php
  
  include '../admin/header.php';
  include '../admin/aside.php';
  include '../admin/footer.php';

$id_usuario =  $_GET['id_usuario'];


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
            <h1 class="m-0">Info Personal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Info Personal</></li>
              
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Usuario <?php ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                  <thead>

                  <tr>
                    <th>Id_info</th>
                    <th>Id_usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>edad</th>
                    <th>sexo</th>
                    <th>num_telefono</th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    // Obtener datos de usuarios con el nombre del sexo
                    $sql_info_usuarios = $con->prepare("
                        SELECT iu.*, s.nombre
                        FROM info_usuario iu
                        JOIN sexo s ON iu.id_sexo = s.id_sexo
                        WHERE iu.id_usuario = :id_usuario
                    ");
                    $sql_info_usuarios->bindParam(':id_usuario', $id_usuario);
                    $sql_info_usuarios->execute();
                    $resultado_info_usuarios = $sql_info_usuarios->fetchAll(PDO::FETCH_ASSOC);

                    foreach($resultado_info_usuarios as $info_usuario) { ?>
                        <tr>
                            <td> <?php echo $info_usuario['id_info'] ?> </td>
                            <td> <?php echo $info_usuario['id_usuario'] ?> </td>
                            <td> <?php echo $info_usuario['nombre'] ?> </td>
                            <td> <?php echo $info_usuario['apellido'] ?> </td>
                            <td> <?php echo $info_usuario['dni'] ?> </td>
                            <td> <?php echo $info_usuario['edad'] ?> </td>
                            <td> <?php echo $info_usuario['nombre'] ?> </td>
                            <td> <?php echo $info_usuario['numtelefonico'] ?> </td>
                        </tr>
                    <?php }?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Id_info</th>
                    <th>Id_usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>edad</th>
                    <th>sexo</th>
                    <th>num_telefono</th>

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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Domicilio <?php ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="domicilio" class="table table-bordered table-striped">
                  <thead>

                  <tr>
                    <th>Provincia</th>
                    <th>Localidad</th>
                    <th>Barrio</th>
                    <th>Calle</th>
                    <th>Numero</th>
                    <th>C postal</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    // Obtener datos de usuarios con el nombre del sexo
                    $sql_info_domicilio = $con->prepare("
                        SELECT d.*, iu.id_info, iu.id_usuario
                        FROM info_usuario iu
                        JOIN domicilio d ON iu.id_domicilio = d.id_domicilio
                        WHERE iu.id_usuario = :id_usuario
                    ");
                    $sql_info_domicilio->bindParam(':id_usuario', $id_usuario);
                    $sql_info_domicilio->execute();
                    $resultado_info_domicilio = $sql_info_domicilio->fetchAll(PDO::FETCH_ASSOC);

                    foreach($resultado_info_domicilio as $info_dom) { ?>
                        <tr>
                            <td> <?php echo $info_dom['provincia'] ?> </td>
                            <td> <?php echo $info_dom['localidad'] ?> </td>
                            <td> <?php echo $info_dom['barrio'] ?> </td>
                            <td> <?php echo $info_dom['calle'] ?> </td>
                            <td> <?php echo $info_dom['numero'] ?> </td>
                            <td> <?php echo $info_dom['cod_postal'] ?> </td>
                        </tr>
                    <?php }?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Provincia</th>
                    <th>Localidad</th>
                    <th>Barrio</th>
                    <th>Calle</th>
                    <th>Numero</th>
                    <th>C postal</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a class="btn btn-default float-right" href="usuarios.php">Volver</a>
              </div>
                <!-- /.card-footer -->
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
<!-- ./wrapper -->
<script src="../admin/js/app.js"></script>

</body>
</html>
