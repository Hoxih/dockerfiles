<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conexion = new mysqli('db', 'ipvg', 'ipvg', 'inventario');
    $usuario = $_POST['usuario'];

    $stmt = $conexion->prepare("INSERT INTO solicitudes_recuperacion (usuario_solicitado) VALUES (?)");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->close();
    $conexion->close();

    $mensaje = "Solicitud enviada correctamente. El administrador revisará tu caso.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Recuperar Contraseña</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #0a3d62;
      color: white;
      font-family: 'Roboto', sans-serif;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-box {
      background-color: #ffffff0d;
      border-radius: 10px;
      padding: 2rem;
      width: 100%;
      max-width: 400px;
    }
    .form-control {
      background-color: #f8f9fa;
    }
    .btn-primary {
      width: 100%;
    }
    .logo {
      display: block;
      margin: 0 auto 1rem auto;
      max-height: 80px;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Logo_Instituto_Profesional_Virginio_G%C3%B3mez.png" class="logo" alt="IPVG">
    <h2>¿Olvidaste tu contraseña?</h2>
    <?php if (isset($mensaje)): ?>
      <div class="alert alert-success text-white text-center"><?= $mensaje ?></div>
    <?php endif; ?>
    <form method="POST">
      <div class="mb-3">
        <label for="usuario" class="form-label">Ingresa tu nombre de usuario</label>
        <input type="text" name="usuario" id="usuario" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Enviar solicitud</button>
    </form>
    <div class="mt-3 text-center text-small">
      <a href="login.php">← Volver al inicio de sesión</a>
    </div>
  </div>
</body>
</html>
