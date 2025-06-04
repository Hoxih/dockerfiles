<?php
$conexion = new mysqli('db', 'ipvg', 'ipvg', 'inventario');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$stmt = $conexion->prepare("UPDATE activos SET nombre=?, tipo=?, numero_serie=?, ubicacion=?, fecha_ingreso=?, estado=? WHERE id_activos=?");
$stmt->bind_param("ssssssi",
    $_POST['nombre'],
    $_POST['tipo'],
    $_POST['numero_serie'],
    $_POST['ubicacion'],
    $_POST['fecha_ingreso'],
    $_POST['estado'],
    $_POST['id']
);

if ($stmt->execute()) {
    header("Location: index.php?msg=actualizado");
} else {
    echo "❌ Error al actualizar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
