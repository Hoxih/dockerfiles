<?php

$conexion = new mysqli('db', 'ipvg', 'ipvg', 'inventario');
$stmt = $conexion->prepare("INSERT INTO activos (nombre, tipo, numero_serie, ubicacion, fecha_ingreso, estado) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $_POST['nombre'], $_POST['tipo'], $_POST['numero_serie'], $_POST['ubicacion'], $_POST['fecha_ingreso'], $_POST['estado']);
$stmt->execute();
$stmt->close();
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Guardando...</title>
  <meta http-equiv="refresh" content="3;url=index.php">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
  <div class="text-center">
    <div class="alert alert-success">
      Activo registrado correctamente. Serás redirigido en unos segundos...
    </div>
    <a href="index.php" class="btn btn-sm btn-outline-primary">Volver ahora</a>
  </div>
</body>
</html>
