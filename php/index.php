<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio - Inventario IPVG</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .sidebar {
      height: 100vh;
      background-color: #0a3d62;
      color: white;
      padding: 1rem;
    }
    .sidebar a {
      color: white;
      display: block;
      padding: 0.5rem 0;
      text-decoration: none;
    }
    .sidebar a:hover {
      text-decoration: underline;
    }
    .logo {
      max-width: 100%;
      height: 60px;
      margin-bottom: 1rem;
    }
    .content { padding: 2rem; }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 sidebar">
        <img src="img/logo_ipvg.png" class="logo" alt="Logo IPVG">
        <h5>Bienvenid@</h5>
        <p><?= $_SESSION['usuario'] ?> (<?= $_SESSION['rol'] ?>)</p>
        <hr>
        <a href="index.php">Inicio</a>
        <a href="buscar.php">Buscar activos</a>
	<?php if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'soporte'): ?>
	<a href="registrar.php">Agregar activos</a>
	<?php endif; ?>
	<?php if ($_SESSION['rol'] === 'admin'): ?>
        <a href="admin_usuarios.php">Agregar usuarios</a>
        <a href="admin_recuperaciones.php">Solicitudes</a>
        <?php endif; ?>
        <a href="logout.php" class="text-danger mt-3 d-block">Cerrar sesión</a>
      </div>
      <div class="col-md-9 content">
        <h2>Bienvenido al sistema de inventario de activos tecnológicos</h2>
        <p class="lead">Desde aquí puedes acceder a todas las funciones del sistema.</p>
        <img src="img/logo_ipvg.png" class="img-fluid mt-4" style="max-height: 150px;">
      </div>
    </div>
  </div>
</body>
</html>

