<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Acceso Intranet - Inventario IPVG</title>
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
    .login-box h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: white;
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
    <h2>Acceso Intranet</h2>
    <form action="validar.php" method="POST">
      <div class="mb-3">
        <label for="usuario" class="form-label">Nombre usuario</label>
        <input type="text" name="usuario" id="usuario" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
    <div class="mt-3 text-center text-small">
      <a href="recuperar.php">¿Olvidaste tu contraseña?</a>
    </div>
    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger mt-3 text-center">Credenciales incorrectas.</div>
    <?php endif; ?>
  </div>
</body>
</html>
