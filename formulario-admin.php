<?php 
include("funciones/sesiones.php");
include("funciones/funciones.php");

date_default_timezone_set("America/Argentina/Tucuman");

$update=0;
//Si hay que editar un registro
$IdUsuario = isset($_REQUEST["IdUsuario"]) ? $_REQUEST["IdUsuario"] : 0;
if ($IdUsuario > 0) {
    $sql = " SELECT * FROM usuarios WHERE IdUsuario = $IdUsuario ";
    $resultado = $conn->query($sql);
    $usuario = $resultado->fetch_assoc();
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
                            <h1><?= ($update == 0) ? 'Crear' : 'Editar' ;?> Administrador</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Blank Page</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row py-4">
                        <div class="col-12 col-sm-8">
                            <!-- form start -->
                            <form class="form-horizontal" name="formAdmin" id="formAdmin" method="POST" action="controladores/modelo-admin.php" autocomplete="off">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="usuario" class="col-sm-2 col-form-label">Usuario:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="UsuarioUser" name="UsuarioUser" placeholder="Usuario" value="<?= ($update == 1) ? $usuario['UsuarioUser'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="UsuarioNombre" name="UsuarioNombre" placeholder="Nombre" value="<?= ($update == 1) ? $usuario['UsuarioNombre'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="apellido" class="col-sm-2 col-form-label">Apellido:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="UsuarioApellido" name="UsuarioApellido" placeholder="Apellido" value="<?= ($update == 1) ? $usuario['UsuarioApellido'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-2 col-form-label">Password:</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="UsuarioClave" name="UsuarioClave" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="reppassword" class="col-sm-2 col-form-label">Repetir Password:</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="UsuarioClave2" name="UsuarioClave2" placeholder="Password">
                                            <span id="resultado_password" class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rol" class="col-sm-2 col-form-label">Rol:</label>
                                        <div class="col-sm-10">
                                            <select name="UsuarioRol" id="UsuarioRol" class="form-control">
                                                <option value="0">--Seleccionar--</option>
                                                <?php while($rol = $result_roles->fetch_assoc()): ?>
                                                    <option value="<?= $rol['IdRol'] ?>" <?= ( isset($usuario) && ($rol['IdRol'] == $usuario['IdRol'])) ? 'selected' :''; ?> >
                                                        <?= $rol['Rol'] ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer d-flex justify-content-end">
                                    <input type="hidden" name="action" value="<?= ($update == 0) ? 'insert' : 'update' ;?>">
                                    <input type="hidden" name="IdUsuario" value="<?= ($update == 0) ? 0 : $usuario['IdUsuario'] ;?>">
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