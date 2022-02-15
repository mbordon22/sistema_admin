<?php
include("funciones/sesiones.php");
include("funciones/funciones.php");

/* Consulta a la base de datos */
try {
    $sql = " SELECT * FROM productos ";
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
                Listado de Productos
            </h1>
            <div class="row my-4 px-3">
                <div class="col-6 col-sm-3">
                    <a href="formulario-producto.php" class="btn btn-success">Nuevo Producto</a>
                </div>
            </div>
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <p class="card-title">Administra y Maneja los productos en esta sección</p>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <?php if($resultado->num_rows == 0){ ?>
                    <h3 class="text-center">No hay registros</h3>
                <?php } else { ?>
                    <table id="registro" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($producto = $resultado->fetch_assoc())                             
                            {
                            ?>
                                <tr>
                                    <td><?php echo $producto["ProductoNombre"]; ?></td>
                                    <td><?php echo "$".$producto["ProductoPrecio"]; ?></td>
                                    <td>
                                        <a href="crear-producto.php?IdProducto=<?php echo $producto['IdProducto']; ?>" class="btn bg-orange btn-flat margin">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button data-id="<?php echo $producto['IdProducto']; ?>" data-tipo="productos" class="btn bg-maroon btn-flat margin borrar-registro">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
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