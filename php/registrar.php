<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Activo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2 class="mb-4">Registrar Activo Tecnológico</h2>
  <form action="guardar.php" method="POST">
    <div class="mb-3">
      <label>Nombre del activo</label>
      <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Tipo</label>
      <input type="text" name="tipo" class="form-control">
    </div>
    <div class="mb-3">
      <label>Número de serie</label>
      <input type="text" name="numero_serie" class="form-control">
    </div>
    <div class="mb-3">
      <label>Ubicación</label>
      <input type="text" name="ubicacion" class="form-control">
    </div>
    <div class="mb-3">
      <label>Fecha de ingreso</label>
      <input type="date" name="fecha_ingreso" class="form-control">
    </div>
    <div class="mb-3">
      <label>Estado</label>
      <input type="text" name="estado" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
  </form>
</body>
</html>
