<?php
if (!isset($_GET['id'])) {
    die("ID no especificado.");
}

$conexion = new mysqli('db', 'ipvg', 'ipvg', 'inventario');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$id = intval($_GET['id']);
$stmt = $conexion->prepare("DELETE FROM activos WHERE id_activos = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php?msg=eliminado");
} else {
    echo "❌ Error al eliminar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
