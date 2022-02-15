<?php
include("funciones/sesiones.php");
include("funciones/funciones.php");

date_default_timezone_set("America/Argentina/Tucuman");

//Si hay que editar un registro
$IdVenta = isset($_REQUEST["IdVenta"]) ? $_REQUEST["IdVenta"] : 0;
if ($IdVenta > 0) {
    $sql = " SELECT * FROM ventas ";
    $sql .= " INNER JOIN productos ";
    $sql .= " ON ventas.IdProducto = productos.IdProducto ";
    $sql .= " WHERE IdVenta = $IdVenta ";
    $resultado = $conn->query($sql);
    $venta = $resultado->fetch_assoc();

}

include("templates/header.php");

?>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php include("templates/barra.php"); ?>

        <!-- Main Sidebar Container -->
        <?php include("templates/aside.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2 px-3">
                        <div class="col-sm-6">
                            <h1>Nueva Venta</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="admin-area">Inicio</a></li>
                                <li class="breadcrumb-item active"><a href="crear-venta.php">Nueva Venta</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="row mt-5 px-3">
                        <div class="col-6 col-sm-3">
                            <a href="lista-ventas.php" class="btn btn-success">Ver listado ventas</a>
                        </div>
                    </div>

                    <div class="row py-4">
                        <div class="col-12 col-sm-8">
                            <!-- form start -->
                            <form class="form-horizontal" name="form-ventas" id="form-ventas" method="POST" action="controladores/modelo-ventas.php">
                                <div class="card-body">
                                    <!-- row -->
                                    <div class="form-group row">
                                        <label for="fechaVenta" class="col-sm-2 col-form-label">Fecha Venta:</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="VentaFechaVenta" name="VentaFechaVenta" value="<?php echo isset($venta['VentaFechaVenta']) ? $venta['VentaFechaVenta'] : date("Y-m-d"); ?>">
                                        </div>
                                    </div>

                                    <!-- row -->
                                    <div class="form-group row">
                                        <label for="HoraVenta" class="col-sm-2 col-form-label">Hora Venta:</label>
                                        <div class="col-sm-10">
                                            <input type="time" class="form-control" id="VentaHoraVenta" name="VentaHoraVenta" value="<?php echo isset($venta['VentaHoraVenta']) ? $venta['VentaHoraVenta'] : date("H:i"); ?>">
                                        </div>
                                    </div>

                                    <!-- row -->
                                    <div class="form-group row">
                                        <label for="IdProducto" class="col-sm-2 col-form-label">Producto:</label>
                                        <div class="col-sm-10">
                                            <?php
                                            try {
                                                $sql = " SELECT * FROM productos ";
                                                $resultado = $conn->query($sql);
                                            } catch (Exception $e) {
                                                echo "Error: " . $e->getMessage();
                                            }
                                            ?>
                                            <select name="IdProducto" id="IdProducto" class="form-control">

                                                <?php if (isset($IdVenta) && $IdVenta > 0) { ?>
                                                    <option value="0" disabled>--Selecionar--</option>
                                                    <?php while ($producto = $resultado->fetch_assoc()) { ?>
                                                        <option value="<?php echo $producto["IdProducto"] ?>" <?php ($venta["IdProducto"] == $producto["IdProducto"]) ? 'selected' : ''; ?>>
                                                            <?php echo $producto["ProductoNombre"]; ?>
                                                        </option>
                                                    <?php }
                                                } else { ?>
                                                    <option value="0" disabled selected>--Selecionar--</option>
                                                    <?php while ($producto = $resultado->fetch_assoc()) { ?>
                                                        <option value="<?php echo $producto["IdProducto"] ?>">
                                                            <?php echo $producto["ProductoNombre"]; ?>
                                                        </option>
                                                    <?php }
                                                } ?>

                                            </select>
                                        </div>
                                    </div>

                                    <!-- row -->
                                    <div class="form-group row">
                                        <label for="VentaPrecioUnitario" class="col-sm-2 col-form-label">Precio Unitario</label>
                                        <div class="col-sm-10">
                                            <input type="number" step=".01" class="form-control" id="VentaPrecioUnitario" name="VentaPrecioUnitario" placeholder="0.00" value="<?php echo isset($venta['VentaPrecioUnitario']) ? $venta['VentaPrecioUnitario'] : ''; ?>">
                                        </div>
                                    </div>
                                    <!-- row -->
                                    <div class="form-group row">
                                        <label for="VentaCantidadProducto" class="col-sm-2 col-form-label">Cantidad:</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="VentaCantidadProducto" name="VentaCantidadProducto" placeholder="0" value="<?php echo isset($venta['VentaCantidadProducto']) ? $venta['VentaCantidadProducto'] : ''; ?>">
                                        </div>
                                    </div>
                                    <!-- row -->
                                    <div class="form-group row">
                                        <label for="VentaTotal" class="col-sm-2 col-form-label">Monto Total</label>
                                        <div class="col-sm-10">
                                            <input type="number" step=".01" class="form-control" id="VentaTotal" name="VentaTotal" placeholder="0.00" readonly value="<?php echo isset($venta['VentaTotal']) ? $venta['VentaTotal'] : ''; ?>">
                                        </div>
                                    </div>
                                    <!-- row -->
                                    <div class="form-group row">
                                        <label for="VentaPagado" class="col-sm-2 col-form-label">Monto Pagado</label>
                                        <div class="col-sm-10">
                                            <input type="number" step=".01" class="form-control" id="VentaPagado" name="VentaPagado" placeholder="0.00" value="<?php echo isset($venta['VentaPagado']) ? $venta['VentaPagado'] : ''; ?>">
                                            <span id="mensajeMontoPagado" class="help-block"></span>
                                        </div>
                                    </div>
                                    <!-- row -->
                                    <div class="form-group row">
                                        <label for="VentaDebe" class="col-sm-2 col-form-label">Monto Falta Pagar</label>
                                        <div class="col-sm-10">
                                            <input type="number" step=".01" class="form-control" id="VentaDebe" name="VentaDebe" placeholder="0.00" readonly value="<?php echo isset($venta['VentaDebe']) ? $venta['VentaDebe'] : ''; ?>">
                                            <span id="mensajeMontoDebe" class="help-block"></span>
                                        </div>
                                    </div>
                                    <!-- row -->
                                    <div class="form-group row">
                                        <label for="VentaObservacioones" class="col-sm-2 col-form-label">Información extra</label>
                                        <div class="col-sm-10">
                                            <textarea name="VentaObservaciones" id="VentaObservaciones" cols="30" rows="10" class="form-control"><?php echo isset($venta['VentaObservaciones']) ? $venta['VentaObservaciones'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer d-flex justify-content-end">
                                    <input type="hidden" name="IdVenta" id="IdVenta" value="<?php echo isset($venta['IdVenta']) ? $venta['IdVenta'] : ''?>">
                                    <input type="hidden" name="VentaFechaPagoTotal" id="VentaFechaPagoTotal" value="<?php echo isset($venta['VentaFechaPagoTotal']) ? $venta['VentaFechaPagoTotal'] : ''; ?>">
                                    <input type="hidden" name="editado" id="editado" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                    <input type="hidden" name="opcion" id="opcion" value="<?php echo isset($venta['IdVenta']) ? 'actualizar' : 'nuevo'; ?>">
                                    <button type="submit" class="btn btn-info" id="btn-form-admin"><?php echo isset($venta['IdVenta']) ? 'Actualizar' : 'Crear'; ?></button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
        </div>
        <!-- /.content-wrapper -->

        <?php include("templates/footer.php"); ?>