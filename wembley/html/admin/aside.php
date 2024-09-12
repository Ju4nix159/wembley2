<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="../../imagen/logo.png" alt="wembley Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Wembley</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- Usuarios -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
            <i class="fas fa-solid fa-chart-pie"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-solid fa-user"></i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="usuarios.php" class="nav-link">
                <i class="fas fa-solid fa-list"></i>
                  <p>Mostrar todos</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- productos -->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-solid fa-table"></i>
              <p>
                Productos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="productos.php" class="nav-link">
                <i class="fas fa-solid fa-list"></i>
                  <p>Mostrar todos</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="añadir_producto.php" class="nav-link">
                <i class="fas fa-solid fa-plus"></i>
                  <p>Añadir Producto</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- categorias -->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-solid fa-layer-group"></i>
              <p>
                Categorias
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="categorias.php" class="nav-link">
                <i class="fas fa-solid fa-list"></i>
                  <p>Mostrar todos</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="añadir_categoria.php" class="nav-link">
                <i class="fas fa-solid fa-plus"></i>
                  <p>Añadir Categorias</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="pedidos.php" class="nav-link">
            <i class="fas fa-list-ul"></i>
              <p>
                Pedidos
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>
</html>
