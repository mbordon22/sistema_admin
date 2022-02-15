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
                Listado de Empleados
            </h1>
            <div class="row my-4 px-3">
                <div class="col-6 col-sm-3">
                    <a href="formulario-empleado.php" class="btn btn-success">Nuevo empleado</a>
                </div>
            </div>
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Administra y Maneja los empleados en esta sección</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="registro" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Cod</th>
                                <th>Nombre</th>
                                <th>DNI</th>
                                <th>Rol</th>
                                <th>Fecha de Nac.</th>
                                <th>Teléfono</th>
                                <th>Domicilio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            /* try {

                                $sql = " SELECT * FROM usuarios ";
                                $resultado = $conn->query($sql);
                            } catch (Exception $E) {
                                $error =  "Error: " . $e->getMessage();
                                echo $error;
                            }
                            while ($admin = $resultado->fetch_assoc()) { */ ?>

                                <!-- <tr>
                                    <td><?php echo $admin["UsuarioUser"]; ?></td>
                                    <td><?php echo $admin["UsuarioNombre"]; ?></td>
                                    <td>
                                        <a href="formulario-admin.php?IdUsuario=<?php echo $admin['IdUsuario']; ?>" class="btn bg-orange btn-flat margin">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a onclick="eliminarUsuario(<?= $admin['IdUsuario'] ?>,'<?= $admin['UsuarioUser'] ?>')" class="btn bg-maroon btn-flat margin">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr> -->

                            <?php //} ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Cod</th>
                                <th>Nombre</th>
                                <th>DNI</th>
                                <th>Rol</th>
                                <th>Fecha de Nac.</th>
                                <th>Teléfono</th>
                                <th>Domicilio</th>
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