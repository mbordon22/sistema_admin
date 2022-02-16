<?php
include("funciones/sesiones.php");
include("funciones/funciones.php");
include("templates/header.php");

//Busco los empleados
try {
    $sql = " SELECT * FROM empleados INNER JOIN roles on empleados.IdRol=roles.IdRol ";
    $resultado = $conn->query($sql);
    $resultado2 = $conn->query($sql);
} catch (Exception $E) {
    $error =  "Error: " . $e->getMessage();
    echo $error;
}

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
            <h1 class="px-3">
                Listado de Empleados
            </h1>
            <div class="row my-4 px-3">
                <div class="col-6 col-sm-3">
                    <a href="formulario-empleado.php" class="btn btn-success">Nuevo empleado</a>
                </div>
            </div>
            <!-- Content Header (Page header) -->
            <div class="card d-none">
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
                            <?php while ($empleado = $resultado->fetch_assoc()) {
                                $fecha_nac = date('d/m/Y', strtotime($empleado["EmpleadoFecNac"]));
                            ?>

                                <tr>
                                    <td><?php echo $empleado['IdEmpleado']; ?></td>
                                    <td><?php echo $empleado["EmpleadoNombre"] . ' ' . $empleado['EmpleadoApellido']; ?></td>
                                    <td><?php echo $empleado["EmpleadoDNI"]; ?></td>
                                    <td><?php echo $empleado["Rol"]; ?></td>
                                    <td><?php echo $fecha_nac; ?></td>
                                    <td><?php echo $empleado["EmpleadoTel"]; ?></td>
                                    <td><?php echo $empleado["EmpleadoDomicilio"]; ?></td>
                                    <td>
                                        <a href="formulario-empleado.php?IdEmpleado=<?php echo $empleado['IdEmpleado']; ?>" class="btn bg-orange btn-flat margin">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a onclick="eliminarEmpleado(<?= $empleado['IdEmpleado'] ?>,'<?= $empleado['EmpleadoNombre'] . ' ' . $empleado['EmpleadoApellido'] ?>')" class="btn bg-maroon btn-flat margin">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                            <?php } ?>
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

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card card-solid">
                    <div class="card-body pb-0">
                        <div class="row d-flex align-items-stretch">
                            <?php while($empleado = $resultado2->fetch_assoc()){?>
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                <div class="card bg-light">
                                    <div class="card-header text-muted border-bottom-0">
                                        <?= $empleado['Rol']?>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b><?=$empleado['EmpleadoNombre'] . ' '. $empleado['EmpleadoApellido']?></b></h2>
                                                <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small mb-2"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Domicilio: <?=$empleado['EmpleadoDomicilio']?></li>
                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefono : <?=$empleado['EmpleadoTel']?></li>
                                                </ul>
                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="img/empleados/<?=$empleado['EmpleadoDNI'].'.jpg'?>" alt="user-avatar" class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <!-- <a  class="btn bg-maroon btn-flat margin">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a> -->
                                            <a onclick="eliminarEmpleado(<?= $empleado['IdEmpleado'] ?>,'<?= $empleado['EmpleadoNombre'] . ' ' . $empleado['EmpleadoApellido'] ?>')" class="btn btn-sm bg-danger">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
                                            <a href="perfil-empleado.php?IdEmpleado=<?=$empleado['IdEmpleado']?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-user"></i> Ver Perfil
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <nav aria-label="Contacts Page Navigation">
                            <ul class="pagination justify-content-center m-0">
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item"><a class="page-link" href="#">6</a></li>
                                <li class="page-item"><a class="page-link" href="#">7</a></li>
                                <li class="page-item"><a class="page-link" href="#">8</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include("templates/footer.php"); ?>