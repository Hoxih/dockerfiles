<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$conexion = new mysqli('db', 'ipvg', 'ipvg', 'inventario');

if (isset($_GET['resolver'])) {
    $id = intval($_GET['resolver']);
    $conexion->query("UPDATE solicitudes_recuperacion SET estado='resuelto' WHERE id=$id");
    header("Location: admin_recuperaciones.php");
    exit;
}

$solicitudes = $conexion->query("SELECT * FROM solicitudes_recuperacion ORDER BY fecha_solicitud DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Solicitudes de Recuperación</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Solicitudes de Recuperación de Contraseña</h2>
  <table class="table table-bordered mt-4">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Usuario Solicitado</th>
        <th>Fecha de Solicitud</th>
        <th>Estado</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($fila = $solicitudes->fetch_assoc()): ?>
      <tr>
        <td><?= $fila['id'] ?></td>
        <td><?= $fila['usuario_solicitado'] ?></td>
        <td><?= $fila['fecha_solicitud'] ?></td>
        <td><?= $fila['estado'] ?></td>
        <td>
          <?php if ($fila['estado'] === 'pendiente'): ?>
          <a href="admin_recuperaciones.php?resolver=<?= $fila['id'] ?>" class="btn btn-success btn-sm">Marcar como resuelto</a>
          <?php else: ?>
          <span class="text-muted">✔ Resuelto</span>
          <?php endif; ?>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <a href="index.php" class="btn btn-secondary mt-3">← Volver</a>
</body>
</html>
