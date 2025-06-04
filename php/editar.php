<?php
if (!isset($_GET['id'])) {
    die("ID no especificado.");
}

$conexion = new mysqli('db', 'ipvg', 'ipvg', 'inventario');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$id = intval($_GET['id']);
$resultado = $conexion->query("SELECT * FROM activos WHERE id_activos = $id");
$activo = $resultado->fetch_assoc();
if (!$activo) {
    die("Activo no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Activo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2 class="mb-4">Editar Activo</h2>
  <form action="actualizar.php" method="POST">
    <input type="hidden" name="id" value="<?= $activo['id_activos'] ?>">
    <div class="mb-3">
      <label>Nombre</label>
      <input type="text" name="nombre" value="<?= $activo['nombre'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Tipo</label>
      <input type="text" name="tipo" value="<?= $activo['tipo'] ?>" class="form-control">
    </div>
    <div class="mb-3">
      <label>N° Serie</label>
      <input type="text" name="numero_serie" value="<?= $activo['numero_serie'] ?>" class="form-control">
    </div>
    <div class="mb-3">
      <label>Ubicación</label>
      <input type="text" name="ubicacion" value="<?= $activo['ubicacion'] ?>" class="form-control">
    </div>
    <div class="mb-3">
      <label>Fecha de ingreso</label>
      <input type="date" name="fecha_ingreso" value="<?= $activo['fecha_ingreso'] ?>" class="form-control">
    </div>
    <div class="mb-3">
      <label>Estado</label>
      <input type="text" name="estado" value="<?= $activo['estado'] ?>" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Guardar cambios</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>
