<?php
include("funciones/sesiones.php");
include("funciones/funciones.php");
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
                Listado de Categorías
            </h1>
            <div class="row my-4 px-3">
                <div class="col-6 col-sm-3">
                    <a href="formulario-categorias.php" class="btn btn-success">Nueva categoría</a>
                </div>
            </div>
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Administra y Maneja las categorías en esta sección</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="registro" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Categoria</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            try {

                                $sql = " SELECT * FROM categorias ";
                                $resultado = $conn->query($sql);
                            } catch (Exception $E) {
                                $error =  "Error: " . $e->getMessage();
                                echo $error;
                            }
                            while ($categoria = $resultado->fetch_assoc()) { ?>

                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $categoria["CategoriaNombre"]; ?></td>
                                    <td><?php echo $categoria["CategoriaDescripcion"]; ?></td>
                                    <td>
                                        <a href="formulario-categorias.php?IdCategoria=<?php echo $categoria['IdCategoria']; ?>" class="btn bg-orange btn-flat margin">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a onclick="eliminarCategoria(<?= $categoria['IdCategoria'] ?>,'<?= $categoria['CategoriaNombre'] ?>')" class="btn bg-maroon btn-flat margin">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                            <?php $i++; } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Categoria</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.content-wrapper -->

        <?php include("templates/footer.php"); ?>