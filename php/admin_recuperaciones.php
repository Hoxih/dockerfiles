<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$conexion = new mysqli('db', 'ipvg', 'ipvg', 'inventario');

// Marcar solicitud como resuelta si se envía el ID
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['resolver_id'])) {
    $id = intval($_POST['resolver_id']);
    $conexion->query("UPDATE solicitudes_recuperacion SET estado = 'resuelto' WHERE id = $id");
}

// Obtener todas las solicitudes
$solicitudes = $conexion->query("SELECT * FROM solicitudes_recuperacion ORDER BY fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Solicitudes de Recuperación</title>
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
        <a href="registrar.php">Agregar activos</a>
        <a href="admin_usuarios.php">Agregar usuarios</a>
        <a href="admin_recuperaciones.php">Solicitudes</a>
        <a href="logout.php" class="text-danger mt-3 d-block">Cerrar sesión</a>
      </div>
      <div class="col-md-9 content">
        <h2>Solicitudes de Recuperación</h2>
        <table class="table table-striped table-bordered mt-4">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Usuario</th>
              <th>Fecha</th>
              <th>Estado</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $solicitudes->fetch_assoc()): ?>
              <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['usuario']) ?></td>
                <td><?= $row['fecha'] ?></td>
                <td><?= $row['estado'] ?></td>
                <td>
                  <?php if ($row['estado'] !== 'resuelto'): ?>
                  <form method="POST" style="display:inline;">
                    <input type="hidden" name="resolver_id" value="<?= $row['id'] ?>">
                    <button type="submit" class="btn btn-sm btn-success">Marcar como resuelto</button>
                  </form>
                  <?php else: ?>
                  <span class="text-muted">✔</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
