<?php 
include("funciones/sesiones.php");
include("funciones/funciones.php");

date_default_timezone_set("America/Argentina/Tucuman");

$update=0;
//Si hay que editar un registro
$IdEmpleado = isset($_REQUEST["IdEmpleado"]) ? $_REQUEST["IdEmpleado"] : 0;
if ($IdEmpleado > 0) {
    $sql = " SELECT * FROM empleados WHERE IdEmpleado = $IdEmpleado ";
    $resultado = $conn->query($sql);
    $empleado = $resultado->fetch_assoc();
    $update=1;
}

//Busco los roles
$sql_roles = "SELECT * FROM roles";
$result_roles = $conn->query($sql_roles);

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
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= ($update == 0) ? 'Crear' : 'Editar' ;?> Empleado</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="empleados.php">Empleados</a></li>
                                <li class="breadcrumb-item active"><?= ($update == 0) ? 'Crear' : 'Editar' ;?> Empleado</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row py-4">
                        <div class="col-12 col-sm-8">
                            <!-- form start -->
                            <form class="form-horizontal" name="formEmpleado" id="formEmpleado" method="POST" action="controladores/modelo-empleados.php" autocomplete="off" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="EmpleadoNombre" name="EmpleadoNombre" placeholder="Nombre" value="<?= ($update == 1) ? $empleado['EmpleadoNombre'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="apellido" class="col-sm-2 col-form-label">Apellido:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="EmpleadoApellido" name="EmpleadoApellido" placeholder="Apellido" value="<?= ($update == 1) ? $empleado['EmpleadoApellido'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dni" class="col-sm-2 col-form-label">DNI:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="EmpleadoDNI" name="EmpleadoDNI" placeholder="DNI" value="<?= ($update == 1) ? $empleado['EmpleadoDNI'] : ''; ?>">
                                            <span id="resultado_dni" class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fechaNacimiento" class="col-sm-2 col-form-label">Fecha de Nacimiento:</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="EmpleadoFecNac" name="EmpleadoFecNac">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="domicilio" class="col-sm-2 col-form-label">Domicilio:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="EmpleadoDomicilio" name="EmpleadoDomicilio" placeholder="Domicilio" value="<?= ($update == 1) ? $empleado['EmpleadoDomicilio'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="telefono" class="col-sm-2 col-form-label">Telefono:</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="EmpleadoTel" name="EmpleadoTel" placeholder="Telefono" value="<?= ($update == 1) ? $empleado['EmpleadoTel'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mail" class="col-sm-2 col-form-label">Correo:</label>
                                        <div class="col-sm-10">
                                            <input type="mail" class="form-control" id="EmpleadoMail" name="EmpleadoMail" placeholder="Correo" value="<?= ($update == 1) ? $empleado['EmpleadoMail'] : ''; ?>">
                                        </div>
                                    </div>
                                    <!-- Roles -->
                                    <div class="form-group row">
                                        <label for="rol" class="col-sm-2 col-form-label">Rol:</label>
                                        <div class="col-sm-10">
                                            <select name="EmpleadoRol" id="EmpleadoRol" class="form-control">
                                                <option value="0">--Seleccionar--</option>
                                                <?php while($rol = $result_roles->fetch_assoc()): ?>
                                                    <option value="<?= $rol['IdRol'] ?>" <?= ( isset($empleado) && ($rol['IdRol'] == $empleado['IdRol'])) ? 'selected' :''; ?> >
                                                        <?= $rol['Rol'] ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Imagen -->
                                    <div class="form-group row">
                                        <label for="imagen" class="col-sm-2 col-form-label">Foto:</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="imagen" name="imagen">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer d-flex justify-content-end">
                                    <input type="hidden" name="action" value="<?= ($update == 0) ? 'insert' : 'update' ;?>">
                                    <input type="hidden" name="IdEmpleado" value="<?= ($update == 0) ? 0 : $empleado['IdEmpleado'] ;?>">
                                    <button type="submit" class="btn btn-info" id="btn-form-admin"><?= ($update == 0) ? 'Crear' : 'Actualizar' ;?></button>
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