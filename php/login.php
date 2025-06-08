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
    <h2>Acceso Inventario</h2>
    <form action="validar.php" method="POST" class="mt-3">
      <div class="mb-3 text-start">
        <label for="usuario" class="form-label">Nombre usuario</label>
        <input type="text" name="usuario" id="usuario" class="form-control" required>
      </div>
      <div class="mb-3 text-start">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
    <div class="mt-3 text-center text-small">
      <a href="recuperar.php" class="text-white">¿Olvidaste tu contraseña?</a>
    </div>
    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger mt-3">Credenciales incorrectas.</div>
    <?php endif; ?>
  </div>
</body>
</html>
