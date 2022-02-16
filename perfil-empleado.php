<?php
include("funciones/sesiones.php");
include("funciones/funciones.php");

date_default_timezone_set("America/Argentina/Tucuman");

$update = 0;
//Si hay que editar un registro
$IdEmpleado = isset($_REQUEST["IdEmpleado"]) ? $_REQUEST["IdEmpleado"] : 0;
if ($IdEmpleado > 0) {
  $sql = " SELECT * FROM empleados INNER JOIN roles on empleados.IdRol = roles.IdRol WHERE IdEmpleado = $IdEmpleado";
  $resultado = $conn->query($sql);
  $empleado = $resultado->fetch_assoc();
  $update = 1;
}

//Busco los roles
$sql_roles = "SELECT * FROM roles";
$result_roles = $conn->query($sql_roles);

include("templates/header.php"); ?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include("templates/barra.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include("templates/aside.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Perfil del empleado</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="empleados.php">Empleados</a></li>
                <li class="breadcrumb-item active">Perfil del empleado</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="img/empleados/<?=$empleado['EmpleadoDNI'].'.jpg'?>" alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center"><?= $empleado['EmpleadoNombre'] . ' ' . $empleado['EmpleadoApellido'] ?></h3>

                  <p class="text-muted text-center"><?= $empleado['Rol'] ?></p>

                  <a href="#" class="btn btn-success btn-block"><b>Habilitado</b></a>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <!-- About Me Box -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Sobre <?= $empleado['EmpleadoNombre'] ?></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <strong><i class="fas fa-phone mr-1"></i> Telefono</strong>

                  <p class="text-muted">
                    <?= $empleado['EmpleadoTel'] ?>
                  </p>

                  <hr>

                  <strong><i class="fas fa-map-marker-alt mr-1"></i> Domicilio</strong>

                  <p class="text-muted"><?= $empleado['EmpleadoDomicilio'] ?></p>

                  <hr>

                  <strong><i class="far fa-envelope mr-1"></i> Correo</strong>

                  <p class="text-muted"><?= $empleado['EmpleadoMail'] ?></p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <!-- <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> -->
                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Editar</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane" id="activity">
                      <!-- Post -->
                      <div class="post">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                          <span class="username">
                            <a href="#">Jonathan Burke Jr.</a>
                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                          </span>
                          <span class="description">Shared publicly - 7:30 PM today</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                          Lorem ipsum represents a long-held tradition for designers,
                          typographers and the like. Some people hate it and argue for
                          its demise, but others ignore the hate as they create awesome
                          tools to help create filler text for everyone from bacon lovers
                          to Charlie Sheen fans.
                        </p>

                        <p>
                          <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                          <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                          <span class="float-right">
                            <a href="#" class="link-black text-sm">
                              <i class="far fa-comments mr-1"></i> Comments (5)
                            </a>
                          </span>
                        </p>

                        <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                      </div>
                      <!-- /.post -->

                      <!-- Post -->
                      <div class="post clearfix">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                          <span class="username">
                            <a href="#">Sarah Ross</a>
                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                          </span>
                          <span class="description">Sent you a message - 3 days ago</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                          Lorem ipsum represents a long-held tradition for designers,
                          typographers and the like. Some people hate it and argue for
                          its demise, but others ignore the hate as they create awesome
                          tools to help create filler text for everyone from bacon lovers
                          to Charlie Sheen fans.
                        </p>

                        <form class="form-horizontal">
                          <div class="input-group input-group-sm mb-0">
                            <input class="form-control form-control-sm" placeholder="Response">
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-danger">Send</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.post -->

                      <!-- Post -->
                      <div class="post">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                          <span class="username">
                            <a href="#">Adam Jones</a>
                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                          </span>
                          <span class="description">Posted 5 photos - 5 days ago</span>
                        </div>
                        <!-- /.user-block -->
                        <div class="row mb-3">
                          <div class="col-sm-6">
                            <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-6">
                            <div class="row">
                              <div class="col-sm-6">
                                <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                                <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-6">
                                <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                                <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <p>
                          <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                          <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                          <span class="float-right">
                            <a href="#" class="link-black text-sm">
                              <i class="far fa-comments mr-1"></i> Comments (5)
                            </a>
                          </span>
                        </p>

                        <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                      </div>
                      <!-- /.post -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                      <!-- The timeline -->
                      <div class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        <div class="time-label">
                          <span class="bg-danger">
                            10 Feb. 2014
                          </span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div>
                          <i class="fas fa-envelope bg-primary"></i>

                          <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> 12:05</span>

                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                            <div class="timeline-body">
                              Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                              weebly ning heekya handango imeem plugg dopplr jibjab, movity
                              jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                              quora plaxo ideeli hulu weebly balihoo...
                            </div>
                            <div class="timeline-footer">
                              <a href="#" class="btn btn-primary btn-sm">Read more</a>
                              <a href="#" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                          </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <div>
                          <i class="fas fa-user bg-info"></i>

                          <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                            <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                            </h3>
                          </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <div>
                          <i class="fas fa-comments bg-warning"></i>

                          <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                            <div class="timeline-body">
                              Take me to your leader!
                              Switzerland is small and neutral!
                              We are more like Germany, ambitious and misunderstood!
                            </div>
                            <div class="timeline-footer">
                              <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                            </div>
                          </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline time label -->
                        <div class="time-label">
                          <span class="bg-success">
                            3 Jan. 2014
                          </span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div>
                          <i class="fas fa-camera bg-purple"></i>

                          <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                            <div class="timeline-body">
                              <img src="https://placehold.it/150x100" alt="...">
                              <img src="https://placehold.it/150x100" alt="...">
                              <img src="https://placehold.it/150x100" alt="...">
                              <img src="https://placehold.it/150x100" alt="...">
                            </div>
                          </div>
                        </div>
                        <!-- END timeline item -->
                        <div>
                          <i class="far fa-clock bg-gray"></i>
                        </div>
                      </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="active tab-pane" id="settings">
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
                              <input type="date" class="form-control" id="EmpleadoFecNac" name="EmpleadoFecNac" value="<?= ($update == 1) ? $empleado['EmpleadoFecNac'] : ''; ?>">
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
                              <select name="IdRol" id="IdRol" class="form-control">
                                <option value="0">--Seleccionar--</option>
                                <?php while ($rol = $result_roles->fetch_assoc()) : ?>
                                  <option value="<?= $rol['IdRol'] ?>" <?= (isset($empleado) && ($rol['IdRol'] == $empleado['IdRol'])) ? 'selected' : ''; ?>>
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
                          <input type="hidden" name="action" value="<?= ($update == 0) ? 'insert' : 'update'; ?>">
                          <input type="hidden" name="IdEmpleado" value="<?= ($update == 0) ? 0 : $empleado['IdEmpleado']; ?>">
                          <a href="empleados.php" class="btn btn-primary mr-2">Volver</a>
                          <button type="submit" class="btn btn-info" id="btn-form-admin"><?= ($update == 0) ? 'Crear' : 'Actualizar'; ?></button>
                        </div>
                        <!-- /.card-footer -->
                      </form>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.1.0-rc
      </div>
      <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="js/plugins/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="js/plugins/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="js/plugins/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="js/plugins/demo.js"></script>
  <!-- sweet alert -->
  <script src="js/plugins/sweetalert2.all.min.js"></script>
  <!-- propios -->
  <script src="js/propios/empleados.js"></script>
</body>

</html>