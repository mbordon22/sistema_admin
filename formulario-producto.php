<?php
include("funciones/sesiones.php");
include("funciones/funciones.php");

date_default_timezone_set("America/Argentina/Tucuman");
$update = 0;
//Si hay que editar un registro
$IdProducto = isset($_REQUEST["IdProducto"]) ? $_REQUEST["IdProducto"] : 0;
if ($IdProducto > 0) {
    $sql = " SELECT * FROM productos WHERE IdProducto = $IdProducto ";
    $resultado = $conn->query($sql);
    $producto = $resultado->fetch_assoc();
    $update = 1;
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
                            <h1>Nuevo Producto</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="admin-area">Inicio</a></li>
                                <li class="breadcrumb-item active"><a href="crear-producto.php">Nuevo Producto</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="row mt-5 px-3">
                        <div class="col-6 col-sm-3">
                            <a href="lista-productos.php" class="btn btn-success">Ver listado productos</a>
                        </div>
                    </div>

                    <div class="row py-4">
                        <div class="col-12 col-sm-8">
                            <!-- form start -->
                            <form class="form-horizontal" name="form-productos" id="form-productos" method="POST" action="controladores/modelo-productos.php">
                                <div class="card-body">
                                    <!-- row -->
                                    <div class="form-group row">
                                        <label for="ProductoNombre" class="col-sm-2 col-form-label">Nombre Producto:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="ProductoNombre" name="ProductoNombre" value="<?php echo isset($producto['ProductoNombre']) ? $producto['ProductoNombre'] : ""; ?>" placeholder="Ej: Harina">
                                        </div>
                                    </div>

                                    <!-- row -->
                                    <div class="form-group row">
                                        <label for="ProductoPrecio" class="col-sm-2 col-form-label">Precio:</label>
                                        <div class="col-sm-10">
                                            <input type="number" step="0.01" min="0.00" class="form-control" id="ProductoPrecio" name="ProductoPrecio" value="<?php echo isset($producto['ProductoPrecio']) ? $producto['ProductoPrecio'] : ""; ?>" placeholder="0.00">
                                        </div>
                                    </div>

                                    
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer d-flex justify-content-end">
                                    <input type="hidden" name="IdProducto" id="IdProducto" value="<?php echo isset($producto['IdProducto']) ? $producto['IdProducto'] : ''?>">
                                    <input type="hidden" name="editado" id="editado" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                    <input type="hidden" name="opcion" id="opcion" value="<?php echo isset($producto['IdProducto']) ? 'actualizar' : 'nuevo'; ?>">
                                    <button type="submit" class="btn btn-info" id="btn-form-admin"><?php echo isset($producto['IdProducto']) ? 'Actualizar' : 'Crear'; ?></button>
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