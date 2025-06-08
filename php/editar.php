<?php
session_start();
if (!isset($_SESSION['usuario']) || ($_SESSION['rol'] !== 'admin' && $_SESSION['rol'] !== 'soporte')) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID no proporcionado.";
    exit;
}

$conexion = new mysqli('db', 'ipvg', 'ipvg', 'inventario');
$id = intval($_GET['id']);
$resultado = $conexion->query("SELECT * FROM activos WHERE id = $id");

if ($resultado->num_rows === 0) {
    echo "Activo no encontrado.";
    exit;
}

$activo = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Activo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <a href="registrar.php">Agregar activos</a>
        <?php if ($_SESSION['rol'] === 'admin'): ?>
        <a href="admin_usuarios.php">Agregar usuarios</a>
        <a href="admin_recuperaciones.php">Solicitudes</a>
        <?php endif; ?>
        <a href="logout.php" class="text-danger mt-3 d-block">Cerrar sesión</a>
      </div>
      <div class="col-md-9 content">
        <h2 class="mb-4">Editar Activo</h2>
        <form action="actualizar.php" method="POST">
          <input type="hidden" name="id" value="<?= $activo['id'] ?>">
          <div class="mb-3">
            <label>Nombre del activo</label>
            <input type="text" name="nombre" class="form-control" value="<?= $activo['nombre'] ?>" required>
          </div>
          <div class="mb-3">
            <label>Tipo</label>
            <input type="text" name="tipo" class="form-control" value="<?= $activo['tipo'] ?>">
          </div>
          <div class="mb-3">
            <label>Número de serie</label>
            <input type="text" name="numero_serie" class="form-control" value="<?= $activo['numero_serie'] ?>">
          </div>
          <div class="mb-3">
            <label>Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" value="<?= $activo['ubicacion'] ?>">
          </div>
          <div class="mb-3">
            <label>Fecha de ingreso</label>
            <input type="date" name="fecha_ingreso" class="form-control" value="<?= $activo['fecha_ingreso'] ?>">
          </div>
          <div class="mb-3">
            <label>Estado</label>
            <input type="text" name="estado" class="form-control" value="<?= $activo['estado'] ?>">
          </div>
          <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
