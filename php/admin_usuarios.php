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

    $stmt = $conexion->prepare("INSERT INTO usuarios (usuario, contrasena, correo, rol) VALUES (?, ?, ?, ?)");
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
        <a href="admin_usuarios.php">Agregar usuarios</a>
        <a href="admin_recuperaciones.php">Solicitudes</a>
        <a href="logout.php" class="text-danger mt-3 d-block">Cerrar sesión</a>
      </div>
      <div class="col-md-9 content">
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
        </form>
      </div>
    </div>
  </div>
</body>
</html>

