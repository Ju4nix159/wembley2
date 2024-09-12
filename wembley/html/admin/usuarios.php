
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
            <h1 class="m-0">Gestion Usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gestion Usuarios</></li>
              
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
                <h3 class="card-title">Usuarios</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID_usuario</th>
                    <th>E1mail</th>
                    <th>Permisos</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    // Obtener datos de usuarios
                    $sqlUsuarios = $con->prepare("
                    SELECT u.id_usuario, u.email, p.nombre_permiso AS nombre_permiso, e.nombre_estado_usuario AS nombre_estado
                    FROM usuarios u
                    INNER JOIN permisos p ON u.id_permiso = p.id_permiso
                    INNER JOIN estado_usuario e ON u.id_estado_usuario = e.id_estado_usuario
                ");
                    $sqlUsuarios->execute();
                    $usuarios = $sqlUsuarios->fetchAll(PDO::FETCH_ASSOC);

                    foreach($usuarios as $usuario) { ?>
                        <tr>
                          <td> <?php echo $usuario['id_usuario'] ?> </td>
                          <td> <?php echo $usuario['email'] ?> </td>
                          <td> <?php echo $usuario['nombre_permiso'] ?> </td>
                          <td> <?php echo $usuario['nombre_estado'] ?></td>

                          <td>
                              <a href="editar_usuario.php?id_usuario=<?php echo $usuario['id_usuario']; ?>" type="button" class="btn bg-orange btn-flat margin"> <i class="fas fa-user-edit"></i></a>

                              <a href="info_usuario.php?id_usuario=<?php echo $usuario['id_usuario']; ?>" type="button" class="btn bg-yellow btn-flat margin borrar_registro"><i class="fas fa-solid fa-search"></i></a>

                          

                            </td>
                        </tr>
                    <?php }?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID_usuario</th>
                    <th>Email</th>
                    <th>Permisos</th>
                    <th>Estado</th>
                    <th>Acciones</th>

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
