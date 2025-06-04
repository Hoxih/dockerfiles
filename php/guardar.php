<?php
$conexion = new mysqli('db', 'ipvg', 'ipvg', 'inventario');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$stmt = $conexion->prepare("INSERT INTO activos (nombre, tipo, numero_serie, ubicacion, fecha_ingreso, estado) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss",
    $_POST['nombre'],
    $_POST['tipo'],
    $_POST['numero_serie'],
    $_POST['ubicacion'],
    $_POST['fecha_ingreso'],
    $_POST['estado']
);

if ($stmt->execute()) {
    echo "<div style='text-align:center;margin-top:50px;font-family:sans-serif;'>
            ✅ Activo registrado correctamente.<br><a href='registrar.php'>← Volver</a>
          </div>";
} else {
    echo "Error al guardar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
