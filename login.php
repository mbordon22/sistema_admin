<?php 

    session_start();
    $cerrar_sesion = isset($_GET["cerrar_sesion"]);
    if($cerrar_sesion){
        //Si se cerró sesión se destruye la sesión actual
        session_destroy();
    }

include("templates/header.php"); ?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../index.php"><b>Admin</b>Sistema</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Inicia Sesión aquí</p>

                <form name="login-admin-form" id="login-admin" method="POST" action="modelo-login.php">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="Maxi">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="Racing14">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <input type="hidden" id="opcion" value="1">
                            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.content-wrapper -->

    <?php include("templates/footer.php"); ?>