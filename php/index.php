<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<?php
if (isset($_GET['msg']) && $_GET['msg'] === 'actualizado') { echo "
  <div class='alert alert-success'>Activo actualizado correctamente.</div>
"; }

$conexion = new mysqli('db', 'ipvg', 'ipvg', 'inventario');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$resultado = $conexion->query("SELECT * FROM activos ORDER BY fecha_ingreso DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inventario de Activos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2 class="mb-4">Inventario de Activos</h2>
  <a href="registrar.php" class="btn btn-success mb-3">Registrar nuevo activo</a>
  <a href="buscar.php" class="btn btn-info mb-3">Buscar activos</a>  
  <a href="logout.php" class="btn btn-danger mb-3">Cerrar sesión</a>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>N° Serie</th>
        <th>Ubicación</th>
        <th>Fecha de ingreso</th>
        <th>Estado</th>
	<th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      <?php while ($fila = $resultado->fetch_assoc()): ?>
      <tr>
        <td><?= $i++ ?></td>
        <td><?= $fila['nombre'] ?></td>
        <td><?= $fila['tipo'] ?></td>
        <td><?= $fila['numero_serie'] ?></td>
        <td><?= $fila['ubicacion'] ?></td>
        <td><?= $fila['fecha_ingreso'] ?></td>
        <td><?= $fila['estado'] ?></td>
	<td>
	 <a href="editar.php?id=<?= $fila['id_activos'] ?>" class="btn btn-warning btn-sm">Editar</a>
         <a href="eliminar.php?id=<?= $fila['id_activos'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este activo?');">Eliminar</a>
	</td>
      <tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>

<?php
$conexion->close();
?>
