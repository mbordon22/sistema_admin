<?php 
include("funciones/sesiones.php");
include("funciones/funciones.php");

$sqlVentas = " SELECT * FROM ventas ";
$resultadoVentas = $conn->query($sqlVentas);

$sumaTotalVentas= 0;
$sumaTotalDebe = 0;
$sumaTotalPagado = 0;
while($venta = $resultadoVentas->fetch_assoc()){
  $sumaTotalVentas += $venta['VentaTotal'];
  $sumaTotalDebe += $venta['VentaDebe'];
  $sumaTotalPagado += $venta['VentaPagado'];
}


include("templates/header.php");
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include("templates/barra.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include("templates/aside.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Inicio</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Inicio</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-md-6 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo "$".number_format($sumaTotalVentas, 2, ",", "."); ?></h3>

                <h5>Total de Ventas</h5>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="lista-ventas.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-md-6 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo "$".number_format($sumaTotalPagado, 2, ",", "."); ?></h3>

                <h5>Total Pagado</h5>
              </div>
              <div class="icon">
              <i class="fas fa-dollar-sign"></i>
              </div>
              <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-md-6 col-12">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo "$".number_format($sumaTotalDebe, 2, ",", "."); ?></h3>

                <h5>Total Deudas</h5>
              </div>
              <div class="icon">
              <i class="fas fa-exclamation-triangle"></i>
              </div>
              <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-md-6 col-12"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
        </div>
        <div class="row">
            <div class="card">
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include("templates/footer.php"); ?>
