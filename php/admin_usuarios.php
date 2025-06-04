<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$conexion = new mysqli('db', 'ipvg', 'ipvg', 'inventario');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol'];
    $correo = $_POST['correo'];

    $stmt = $conexion->prepare("INSERT INTO usuarios (usuario, contraseña, correo, rol) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $usuario, $contrasena, $correo, $rol);

    if ($stmt->execute()) {
        $msg = "✅ Usuario registrado correctamente.";
    } else {
        $msg = "❌ Error al registrar: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Administración de Usuarios</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Registrar Nuevo Usuario</h2>

  <?php if (isset($msg)): ?>
    <div class="alert alert-info"><?= $msg ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label for="usuario" class="form-label">Usuario</label>
      <input type="text" class="form-control" name="usuario" required>
    </div>
    <div class="mb-3">
      <label for="contrasena" class="form-label">Contraseña</label>
      <input type="text" class="form-control" name="contrasena" required>
    </div>
    <div class="mb-3">
      <label for="correo" class="form-label">Correo electrónico</label>
      <input type="email" class="form-control" name="correo" required>
    </div>
    <div class="mb-3">
      <label for="rol" class="form-label">Rol</label>
      <select class="form-select" name="rol" required>
        <option value="admin">Administrador</option>
        <option value="lector">Lector</option>
        <option value="soporte">Soporte</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Crear Usuario</button>
    <a href="index.php" class="btn btn-secondary">Volver</a>
  </form>
</body>
</html>
