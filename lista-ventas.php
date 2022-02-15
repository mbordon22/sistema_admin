<?php
include("funciones/sesiones.php");
include("funciones/funciones.php");

/* Consulta a la base de datos */
try {
    $sql = " SELECT * FROM ventas ";
    $sql .= " INNER JOIN productos ";
    $sql .= " ON ventas.IdProducto = productos.IdProducto ";
    $sql .= " ORDER BY VentaFechaVenta ";
    $resultado = $conn->query($sql);
} catch (Exception $E) {
    $error =  "Error: " . $e->getMessage();
    echo $error;
}



include("templates/header.php"); ?>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php include("templates/barra.php"); ?>

        <!-- Main Sidebar Container -->
        <?php include("templates/aside.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <h1 class="px-3">
                Listado de Ventas
            </h1>
            <div class="row my-4 px-3">
                <div class="col-6 col-sm-3">
                    <a href="crear-venta.php" class="btn btn-success">Nueva Venta</a>
                </div>
            </div>
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <p class="card-title">Administra y Maneja las ventas en esta sección</p>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <?php if($resultado->num_rows == 0){ ?>
                    <h3 class="text-center">No hay registros</h3>
                <?php } else { ?>
                    <table id="registro" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Observaciones</th>
                                <th>Pagado</th>
                                <th>Debe</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($venta = $resultado->fetch_assoc())                             
                            {
                                $fecha = date('d-m-Y', strtotime($venta["VentaFechaVenta"]))
                            ?>
                                <tr>
                                    <td><?php echo $fecha; ?></td>
                                    <td><?php echo $venta["VentaHoraVenta"]; ?></td>
                                    <td><?php echo $venta["ProductoNombre"]; ?></td>
                                    <td><?php echo $venta["VentaCantidadProducto"]; ?></td>
                                    <td><?php echo $venta["VentaObservaciones"]; ?></td>
                                    <td><?php echo "$ " . $venta["VentaPagado"]; ?></td>
                                    <td><?php echo "$ " . $venta["VentaDebe"]; ?></td>
                                    <td><?php echo "$ " . $venta["VentaTotal"]; ?></td>
                                    <td>
                                        <a href="crear-venta.php?IdVenta=<?php echo $venta['IdVenta']; ?>" class="btn bg-orange btn-flat margin">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button data-id="<?php echo $venta['IdVenta']; ?>" data-tipo="ventas" class="btn bg-maroon btn-flat margin borrar-registro">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Observaciones</th>
                                <th>Pagado</th>
                                <th>Debe</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                    <?php } ?>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.content-wrapper -->

        <?php include("templates/footer.php"); ?>