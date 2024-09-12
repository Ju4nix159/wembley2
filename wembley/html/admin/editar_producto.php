
<?php
  
  include '../admin/header.php';
  include '../admin/aside.php';
  include '../admin/footer.php';



$id_producto = $_GET['id_producto'];



$sql_informacion_producto = $con->prepare("SELECT p.*, c.nombre_categoria AS nombre_categoria
FROM productos AS p
LEFT JOIN categoria AS c ON p.id_categoria = c.id_categoria
WHERE id_producto = :id_producto;
");
  $sql_informacion_producto->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
  $sql_informacion_producto->execute();
  $informacion_productos = $sql_informacion_producto->fetch(PDO::FETCH_ASSOC);

 // Procesar el formulario de edición de productos si se ha enviado
 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_producto'])) {
  // Obtener el ID, nombre, descripción, precio, destacado y la nueva referencia de imagen del formulario de edición de productos
      $n_producto = $_POST["n_producto"];
      $nombreProducto = $_POST["nombre"];
      $descripcionProducto = $_POST["descripcion"];
      $precioProducto = $_POST["precio"];
      $destacadoProducto = $_POST["destacado"];
      $descuento = $_POST["descuento"];
      $nuevaCategoria = $_POST["id_categoria"];
      $stock = $_POST["stock"];
      $nuevoEstado = $_POST["id_estado_producto"];
      $rutaImagen = "0.png";
     // Verifica si se ha cargado un archivo y si no hay errores
      if (isset($_FILES['referencia_imagen']) && $_FILES['referencia_imagen']['error'] === UPLOAD_ERR_OK) {
          $rutaImagen = basename($_FILES['referencia_imagen']['name']);
          move_uploaded_file($_FILES['referencia_imagen']['tmp_name'], "../../imagen/botines/".$rutaImagen);
      }
  

  // Validar y actualizar la información en la base de datos para productos
  $sql = $con->prepare("UPDATE productos SET 
  n_producto = :n_producto,
  nombre = :nombre, 
  descripcion = :descripcion, 
  precio = :precio, 
  destacado = :destacado, 
  descuento = :descuento,
  img = :referencia_imagen,
  id_categoria = :id_categoria,
  id_estado = :id_estado,
  stock = :stock
  WHERE id_producto = :id_producto");
  $sql->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
  $sql->bindParam(':n_producto', $n_producto, PDO::PARAM_INT);
  $sql->bindParam(':nombre', $nombreProducto, PDO::PARAM_STR);
  $sql->bindParam(':descripcion', $descripcionProducto, PDO::PARAM_STR);
  $sql->bindParam(':precio', $precioProducto, PDO::PARAM_STR);
  $sql->bindParam(':destacado', $destacadoProducto, PDO::PARAM_INT);
  $sql->bindParam(':descuento', $descuento, PDO::PARAM_INT);
  $sql->bindParam(':referencia_imagen', $rutaImagen, PDO::PARAM_STR);
  $sql->bindParam(':id_categoria', $nuevaCategoria, PDO::PARAM_INT);
  $sql->bindParam(':stock', $stock, PDO::PARAM_INT);
  $sql->bindParam(':id_estado', $nuevoEstado, PDO::PARAM_INT);
  $sql->execute();

  echo '<script>';
  echo 'alert("Cambios realizados");';
  echo 'window.location.href = "productos.php";';
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
            <h1 class="m-0">Editar Producto</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">inicio</a></li>
              <li class="breadcrumb-item"><a href="productos.php">productos</a></li>
              <li class="breadcrumb-item active">Editar Producto</></li>
              
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
                <h3 class="card-title">Producto ID: <?php echo $id_producto?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form class="form-horizontal" action="<?php ($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">


                <div class="form-group row">
                  <label for="n_producto" class="col-sm-2 col-form-label">N_producto</label>
                  <div class="col-sm-10">
                      <div class="input-icon-container">
                          <input type="text" class="form-control" id="n_producto" name="n_producto" value="<?php echo $informacion_productos["n_producto"]; ?>" placeholder="Ingrese un numero de producto unico">
                          <i class="far fa-question-circle"></i>
                          <span class="tooltip-text">Código único de producto</span>
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                  <div class="col-sm-10">
                      <div class="input-icon-container">
                          <input  type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $informacion_productos["nombre"]; ?>"placeholder="Ingrese nombre del producto"  required >
                          <i class="far fa-question-circle"></i>
                          <span class="tooltip-text">Nombre del producto</span>
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="descripcion" class="col-sm-2 col-form-label">Descripción</label>
                  <div class="col-sm-10">
                      <div class="input-icon-container">
                          <textarea placeholder="Ingrese una descripcion del producto" id="descripcion" class="form-control" rows="3" name="descripcion"><?php echo $informacion_productos["descripcion"]; ?></textarea>
                          <i class="far fa-question-circle"></i>
                          <span class="tooltip-text">Breve descripción del producto</span>
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                  <div class="col-sm-10">
                      <div class="input-icon-container">
                          <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $informacion_productos["precio"]; ?>" placeholder="Ingrese precio del producto" required>
                          <i class="far fa-question-circle"></i>
                          <span class="tooltip-text">Precio del producto</span>
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="descuento" class="col-sm-2 col-form-label">% descuento</label>
                  <div class="col-sm-10">
                      <div class="input-icon-container">
                          <input type="text" class="form-control" id="descuento" name="descuento" value="<?php echo $informacion_productos["descuento"]; ?>"   placeholder="Ingrese en % de descuento aplicado al producto">
                          <i class="far fa-question-circle"></i>
                          <span class="tooltip-text">Porcentaje de descuento aplicado al producto</span>
                      </div>
                  </div>
              </div>

              <div class="form-group row ">
                  <label for="destacado" class="col-sm-2 col-form-label">Destacado</label>
                  <div class="col-sm-10">
                      <div class="input-icon-container">
                          <select class="form-control" name="destacado">
                              <option value="1" <?php echo ($informacion_productos["destacado"] == 1) ? "selected" : ""; ?>>Sí</option>
                              <option value="0" <?php echo ($informacion_productos["destacado"] == 0) ? "selected" : ""; ?>>No</option>
                          </select>
                      </div>
                  </div>
              </div>

              <div class="form-group row ">
                  <label for="id_categoria" class="col-sm-2 col-form-label">Categorias</label>
                  <div class="col-sm-10">
                      <div class="input-icon-container">
                          <?php 
                          $sql_nombre_categoria = $con->prepare("SELECT * FROM categoria");
                          $sql_nombre_categoria -> execute();
                          $nombres_categoria = $sql_nombre_categoria->fetchAll();
                          ?>
                          <select class="form-control" name="id_categoria">
                              <?php foreach ($nombres_categoria as $row) {
                                  $selected = ($row["id_categoria"] == $informacion_productos["id_categoria"]) ? "selected" : "";
                                  echo '<option value="' . $row["id_categoria"] . '" ' . $selected . '>' . $row["nombre_categoria"] . '</option>';
                              } ?>
                          </select>
                          
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="stock" class="col-sm-2 col-form-label">stock</label>
                  <div class="col-sm-10">
                      <div class="input-icon-container">
                          <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $informacion_productos["stock"]; ?>" placeholder="Ingrese stock del producto" required>
                          <i class="far fa-question-circle"></i>
                          <span class="tooltip-text">Cantidad disponible en stock</span>
                      </div>
                  </div>
              </div>

              <div class="form-group row ">
                  <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                  <div class="col-sm-10">
                      <div class="input-icon-container">
                          <?php 
                          $sql_nombre_estado = $con->prepare("SELECT * FROM estado_producto");
                          $sql_nombre_estado -> execute();
                          $nombres_estado = $sql_nombre_estado->fetchAll();
                          ?>
                          <select class="form-control" name="id_estado_producto">
                              <?php foreach ($nombres_estado as $row) {
                                  $selected = ($row["id_estado_producto"] == $informacion_productos["id_estado"]) ? "selected" : "";
                                  echo '<option value="' . $row["id_estado_producto"] . '" ' . $selected . '>' . $row["nombre_estado_producto"] . '</option>';
                              } ?>
                          </select>
                          
                      </div>
                  </div>
              </div>



                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="editar_producto" class="btn btn-info">Guardar</button>
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">imagenes</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Productos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID_imagen</th>
                    <th>Nombre referencia</th>
                    <th>imagen</th>
                    <th>acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql_nombre_imagen = $con->prepare
                    ("SELECT * FROM imagenes WHERE id_producto = :id_producto");
                    $sql_nombre_imagen->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                    $sql_nombre_imagen->execute();
                    $sql_nombre_imagenes = $sql_nombre_imagen->fetchAll(PDO::FETCH_ASSOC);

                    foreach($sql_nombre_imagenes as $imagen) { ?>
                        <tr>
                          <td> <?php echo $imagen['id_imagen'] ?></td>
                          <td> <?php echo $imagen['nombre_imagen'] ?></td>
                          <?php $nombre_imagen = $imagen['nombre_imagen'] ?>

                          <td class="celda_img" > <img class="img_producto" src="../../imagen/botines/<?php echo $id_producto ?>/<?php echo $nombre_imagen ?>" alt="imagen del producto"></td>

                          <td class="d-flex">
                              <a href="editar_imagen.php?id_imagen=<?php echo $imagen['id_imagen'];?>" type="button" class="btn bg-orange btn-flat margin"> <i class="fas fa-solid fa-pen"></i>
                              <a href="eliminar_img" type="button" class="btn bg-red btn-flat margin"><i class="fas fa-solid fa-trash-alt"></i></a>

                              
                            </td>
                        </tr>
                    <?php }?>
                    
            
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID_imagen</th>
                    <th>Nombre referencia</th>
                    <th>Nombre</th>
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
<style>

  .input-icon-container {
      position: relative;
  }

  .input-icon-container i {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
  }

  .tooltip-text {
      color: black;
      display: none;
      position: absolute;
      z-index:  100;
      top: calc(100% + 5px);
      left: 50%;
      transform: translateX(-50%);
      background-color: #fff;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .input-icon-container i:hover + .tooltip-text {
      display: block;
  }
  .celda_img{
    width: 100px; 
    height: 100px; 
    max-width: 100%;
    max-height: 100%;
  }
  .img_producto{
    width: 100%;
    height: 100%;
  }

</style>


<script src="../admin/js/app.js"></script>

</body>
</html>
