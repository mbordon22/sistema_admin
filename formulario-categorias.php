<?php
include("funciones/sesiones.php");
include("funciones/funciones.php");

date_default_timezone_set("America/Argentina/Tucuman");
$update = 0;
//Si hay que editar un registro
$IdCategoria = isset($_REQUEST["IdCategoria"]) ? $_REQUEST["IdCategoria"] : 0;
if ($IdCategoria > 0) {
    $sql = " SELECT * FROM categorias WHERE IdCategoria = $IdCategoria ";
    $resultado = $conn->query($sql);
    $categoria = $resultado->fetch_assoc();

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
                            <h1>Nueva Categoria</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="admin-area">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="categorias.php">Categorias</a></li>
                                <li class="breadcrumb-item active"><a href="formulario-categorias.php">Nueva Categoria</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="row mt-5 px-3">
                        <div class="col-6 col-sm-3">
                            <a href="categorias.php" class="btn btn-success">Ver listado categorias</a>
                        </div>
                    </div>

                    <div class="row py-4">
                        <div class="col-12 col-sm-8">
                            <!-- form start -->
                            <form class="form-horizontal" name="formCategorias" id="formCategorias" method="POST" action="controladores/modelo-categorias.php">
                                <div class="card-body">
                                    <!-- row -->
                                    <div class="form-group row">
                                        <label for="CategoriaNombre" class="col-sm-2 col-form-label">Nombre Categoría:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="CategoriaNombre" name="CategoriaNombre" value="<?php echo isset($categoria['CategoriaNombre']) ? $categoria['CategoriaNombre'] : ""; ?>" placeholder="Ej: Dulces">
                                        </div>
                                    </div>

                                    <!-- row -->
                                    <div class="form-group row">
                                        <label for="CategoriaDescripcion" class="col-sm-2 col-form-label">Descripción:</label>
                                        <div class="col-sm-10">
                                            <textarea name="CategoriaDescripcion" id="CategoriaDescripcion" class="form-control" cols="30" rows="10"><?php echo isset($categoria['CategoriaDescripcion']) ? $categoria['CategoriaDescripcion'] : ""; ?></textarea>
                                        </div>
                                    </div>

                                    
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer d-flex justify-content-end">
                                    <input type="hidden" name="IdCategoria" id="IdCategoria" value="<?php echo isset($categoria['IdCategoria']) ? $categoria['IdCategoria'] : ''?>">
                                    <input type="hidden" name="action" value="<?= ($update == 0) ? 'insert' : 'update' ;?>">
                                    <button type="submit" class="btn btn-info" id="btn-form-admin"><?php echo isset($categoria['IdCategoria']) ? 'Actualizar' : 'Crear'; ?></button>
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