
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
<script>
        function confirmarAccion(event, url) {
            event.preventDefault(); // Previene la redirección inmediata
            var confirmacion = confirm("¿Estás seguro de que deseas enviar este producto a mercado libre?");
            if (confirmacion) {
                window.location.href = url;
            }
        }
    </script>
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
                    <th>Precio</th>
                    <th>Precio descuento</th>
                    <th>% desc</th>
                    <th>Destacado</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Img</th>
                    <th>acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql_productos = $con->prepare
                    ("SELECT p.*, c.nombre_categoria AS nombre_categoria, e.nombre_estado_producto AS nombre_estado, COUNT(i.id_imagen) AS cantidad_imagenes
                    FROM productos AS p
                    LEFT JOIN categoria AS c ON p.id_categoria = c.id_categoria
                    LEFT JOIN estado_producto AS e ON p.id_estado = e.id_estado_producto
                    LEFT JOIN imagenes AS i ON p.id_producto = i.id_producto
                    GROUP BY p.id_producto
                    ");
                    $sql_productos->execute();
                    $Productos = $sql_productos->fetchAll(PDO::FETCH_ASSOC);

                    foreach($Productos as $producto) { ?>
                        <tr>
                          <td> <?php echo $producto['id_producto'] ?></td>
                          <td> <?php echo $producto['n_producto'] ?></td>
                          <td> <?php echo $producto['nombre'] ?> </td>
                          <td> <?php echo $producto['descripcion'] ?></td>
                          <td> <?php echo $producto['precio'] ?></td>
                          <td> <?php echo $producto['precio_desc'] ?></td>
                          <td> <?php echo $producto['descuento'] ?></td>
                          <td> <?php if($producto['destacado']==0){
                                  echo "No";
                              }else{
                                  echo "Si";
                          } ?></td>
                          <td> <?php echo $producto['nombre_categoria'] ?></td>
                          <td> <?php echo $producto['stock'] ?></td>
                          <td> <?php echo $producto['nombre_estado'] ?></td>
                          <td> <?php echo $producto['cantidad_imagenes'] ?></td>
                          <td>
                              <a href="editar_producto.php?id_producto=<?php echo $producto['id_producto']; ?>" type="button" class="btn bg-orange btn-flat margin"> <i class="fas fa-user-edit"></i></a>
                              <a  href="../../config/mercadolibre.php?id_producto=<?php echo $producto['id_producto']; ?>"
                                  type="button"
                                  class="btn bg-yellow btn-flat margin borrar_registro"
                                  onclick="confirmarAccion(event, this.href)">
                                  <i class="fas fa-solid fa-handshake"></i>
                              </a>
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
                    <th>Precio</th>
                    <th>Precio descuento</th>
                    <th>% desc</th>
                    <th>Destacado</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Img</th>
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
