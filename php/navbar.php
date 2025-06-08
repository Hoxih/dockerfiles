<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Inventario IPVG</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="buscar.php">Buscar</a>
        </li>
        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
        <li class="nav-item">
          <a class="nav-link" href="admin_usuarios.php">Agregar Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_recuperaciones.php">Solicitudes</a>
        </li>
        <?php endif; ?>
      </ul>
      <span class="navbar-text me-3">
        Usuario: <?= $_SESSION['usuario'] ?? 'Invitado' ?> (<?= $_SESSION['rol'] ?? 'Sin rol' ?>)
      </span>
      <a href="logout.php" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
    </div>
  </div>
</nav>
