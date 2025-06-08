<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conexion = new mysqli('db', 'ipvg', 'ipvg', 'inventario');
    $usuario = $_POST['usuario'];

    $stmt = $conexion->prepare("INSERT INTO solicitudes_recuperacion (usuario) VALUES (?)");
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
      text-align: center;
    }
    .login-box img.logo {
      max-height: 80px;
      margin-bottom: 1.5rem;
    }
    .form-control {
      background-color: #f8f9fa;
    }
    .btn-primary {
      width: 100%;
    }
    .text-small {
      font-size: 0.875rem;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <img src="img/logo_ipvg.png" class="logo" alt="Logo IPVG">
    <h2>¿Olvidaste tu contraseña?</h2>
    <?php if (isset($mensaje)): ?>
      <div class="alert alert-success text-white mt-3"><?= $mensaje ?></div>
    <?php endif; ?>
    <form method="POST" class="mt-3">
      <div class="mb-3 text-start">
        <label for="usuario" class="form-label">Nombre de usuario</label>
        <input type="text" name="usuario" id="usuario" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Enviar solicitud</button>
    </form>
    <div class="mt-3 text-center text-small">
      <a href="login.php" class="text-white">← Volver al inicio</a>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const msg = document.querySelector('.alert-success');
      const btn = document.querySelector('button[type="submit"]');
      if (msg && btn) {
        btn.disabled = true;
        btn.classList.remove("btn-primary");
        btn.classList.add("btn-secondary");
        btn.innerText = "✔ Solicitud enviada";
      }
    });
  </script>
</body>
</html>
