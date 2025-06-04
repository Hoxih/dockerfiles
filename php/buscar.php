
<?php
$conexion = new mysqli('db', 'ipvg', 'ipvg', 'inventario');
$busqueda = isset($_GET['buscar']) ? $conexion->real_escape_string($_GET['buscar']) : '';
$sql = "SELECT * FROM activos";

if ($busqueda !== '') {
    $sql .= " WHERE nombre LIKE '%$busqueda%' OR numero_serie LIKE '%$busqueda%'";
}

$sql .= " ORDER BY fecha_ingreso DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Búsqueda de Activos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<?php if (isset($_GET['msg']) && $_GET['msg'] === 'actualizado'): ?>
  <div class='alert alert-success'>✅ Activo actualizado correctamente.</div>
<?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'eliminado'): ?>
  <div class='alert alert-success'>🗑️ Activo eliminado correctamente.</div>
<?php endif; ?>

<h2 class="mb-4">Buscar Activos</h2>

<form method="GET" class="mb-4">
  <div class="input-group">
    <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o serie..." value="<?= htmlspecialchars($busqueda) ?>">
    <button class="btn btn-primary">Buscar</button>
  </div>
</form>

<a href="index.php" class="btn btn-secondary mb-3">← Volver al Inventario</a>

<form method="POST" action="accion_seleccion.php">
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Seleccionar</th>
        <th>#</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>N° Serie</th>
        <th>Ubicación</th>
        <th>Fecha de ingreso</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; while ($fila = $resultado->fetch_assoc()): ?>
      <tr>
        <td><input type="radio" name="id" value="<?= $fila['id_activos'] ?>" onclick="habilitarBotones();"></td>
        <td><?= $i++ ?></td>
        <td><?= $fila['nombre'] ?></td>
        <td><?= $fila['tipo'] ?></td>
        <td><?= $fila['numero_serie'] ?></td>
        <td><?= $fila['ubicacion'] ?></td>
        <td><?= $fila['fecha_ingreso'] ?></td>
        <td><?= $fila['estado'] ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <button type="submit" name="accion" value="editar" class="btn btn-warning" disabled id="btnEditar">Editar</button>
  <button type="submit" name="accion" value="eliminar" class="btn btn-danger" disabled id="btnEliminar" onclick="return confirm('¿Estás seguro de eliminar este activo?');">Eliminar</button>
</form>

<script>
function habilitarBotones() {
  document.getElementById('btnEditar').disabled = false;
  document.getElementById('btnEliminar').disabled = false;
}
</script>

</body>
</html>
