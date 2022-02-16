<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../index.php" class="brand-link">
    <img src="img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Sistema</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION["Nombre"] ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <!-- ---------------Inicio--------------- -->
          <a href="index.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Inicio
            </p>
          </a>
        </li>
        <li class="nav-item">
        <hr class="bg-light">
          <!-- ---------------Ventas--------------- -->
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
              Ventas
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="lista-ventas.php" class="nav-link">
                <i class="fas fa-bars nav-icon"></i>
                <p>Ver todos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="crear-venta.php" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Agregar</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <!-- ---------------Productos--------------- -->
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Productos
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="lista-productos.php" class="nav-link">
                <i class="fas fa-bars nav-icon"></i>
                <p>Ver todos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="formulario-producto.php" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Agregar</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <!-- ---------------Productos--------------- -->
          <a href="categorias.php" class="nav-link">
            <i class="nav-icon fas fa-bars"></i>
            <p>
              Categorías
            </p>
          </a>
        </li>
        <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-user-circle"></i>
              <p>
                Invitados
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../admin/lista-invitados.php" class="nav-link">
                <i class="fas fa-bars nav-icon"></i>
                  <p>Ver todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../admin/crear-invitado.php" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon far fa-address-book"></i>
              <p>
                Registrados
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="lista-registrados.php" class="nav-link">
                <i class="fas fa-bars nav-icon"></i>
                  <p>Ver todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crear-registro.php" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li> -->
        <?php if ($_SESSION["Rol"] == 1) : ?>
          <li class="nav-item">
            <!-- ---------------Usuarios--------------- -->
            <a href="usuarios.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="empleados.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Empleados
              </p>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>