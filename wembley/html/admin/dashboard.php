<?php

include '../admin/header.php';
include '../admin/aside.php';
include '../admin/footer.php';
include '../../config/database.php';



// Consulta para cantidad de usuarios por género
$sql_cantidad_usuarios_genero = $con->query("SELECT s.nombre AS nombre_genero, COUNT(*) as cantidad 
FROM info_usuarios AS iu
INNER JOIN sexos AS s ON iu.id_sexo = s.id_sexo
GROUP BY iu.id_sexo");

$resultado_cantidad_usuarios_genero = $sql_cantidad_usuarios_genero->fetchAll(PDO::FETCH_ASSOC);

// Arreglo para almacenar los datos del gráfico
$datos_grafico = array();
$labels = array();

// Iterar sobre los resultados y almacenarlos en el arreglo
foreach ($resultado_cantidad_usuarios_genero as $fila) {
  $datos_grafico[$fila['nombre_genero']] = $fila['cantidad'];
}

// Consulta para ventas por mes
$sql_ventas_por_mes = "SELECT MONTH(fecha) as mes, COUNT(*) as cantidad_pedidos FROM pedidos GROUP BY MONTH(fecha)";
$resultado_ventas_por_mes = $con->query($sql_ventas_por_mes);

// Arreglo para datos de línea
$data_line = [];

while ($fila = $resultado_ventas_por_mes->fetch(PDO::FETCH_ASSOC)) {
  $data_line[] = $fila['cantidad_pedidos'];
}

// Consulta para cantidad de usuarios registrados
$sql_cantidad_usuarios = "SELECT COUNT(*) AS cantidad_usuarios FROM usuarios";
$resultado_cantidad_usuarios = $con->query($sql_cantidad_usuarios);

if ($resultado_cantidad_usuarios) {
  // Obtener el resultado como un array asociativo
  $fila = $resultado_cantidad_usuarios->fetch(PDO::FETCH_ASSOC);

  // Guardar la cantidad de usuarios registrados en la variable
  $cantidad_usuarios = $fila['cantidad_usuarios'];
}

// Consulta para ventas totales
$sql_ventas_totales = "SELECT SUM(cantidad) AS cantidad_total_ventas FROM pedido_productos";
$resultado_cantidad_ventas = $con->query($sql_ventas_totales);

if ($resultado_cantidad_ventas) {
  // Obtener el resultado como un array asociativo
  $fila = $resultado_cantidad_ventas->fetch(PDO::FETCH_ASSOC);

  // Guardar la cantidad total de ventas en la variable
  $cantidad_total_ventas = $fila['cantidad_total_ventas'];
}

// Consulta para ganancia total
$sql_ganancia_total = "SELECT SUM(total) AS ganancia_total FROM pedidos";
$resultado_ganancia_total = $con->query($sql_ganancia_total);

if ($resultado_ganancia_total) {
  // Obtener el resultado como un array asociativo
  $fila = $resultado_ganancia_total->fetch(PDO::FETCH_ASSOC);

  // Guardar la ganancia total en la variable
  $ganancia_total = $fila['ganancia_total'];
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
            <h1 class="m-0">Dashboard</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</>
              </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>


              <div class="info-box-content">
                <span class="info-box-text">usuarios registrados</span>
                <span class="info-box-number"><?php echo $cantidad_usuarios; ?></span>
              </div>
            </div>
          </div>

          <!-- DONUT CHART -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Generos Usuario</h3>
            </div>
            <div class="card-body">
              <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Ventas Totales</span>
                <span class="info-box-number"><?php echo $cantidad_total_ventas ?></span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total recaudado</span>
                <span class="info-box-number"><?php echo $ganancia_total ?></span>
              </div>
            </div>
          </div>
        </div>
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Line Chart</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>







    </section>
  </div> <!-- /.content-wrapper -->
</div><!-- ./wrapper -->

<script>
  $(document).ready(function() {
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var datos_grafico = <?php echo json_encode($datos_grafico); ?>;

    // Configuración del gráfico de dona
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
    var donutData = {
      labels: Object.keys(datos_grafico),
      datasets: [{
        data: Object.values(datos_grafico),
        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
      }]
    };
    var donutOptions = {
      maintainAspectRatio: false,
      responsive: true,
    };

    // Crear el gráfico de dona
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    });


    //-------------
    //- LINE CHART -
    //--------------
    var areaChartData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July',
        'August', 'September', 'October', 'November', 'December'
      ],
      datasets: [{
        label: 'Electronics',
        backgroundColor: 'rgba(210, 214, 222, 1)',
        borderColor: 'rgba(210, 214, 222, 1)',
        pointRadius: false,
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: <?php echo json_encode($data_line); ?>
      }, ]
    }

    var areaChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
          }
        }],
        yAxes: [{
          gridLines: {
            display: false,
          }
        }]
      }
    }




    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })




  });
</script>
</body>

</html>