<?php
session_start();
$conexion = new mysqli('db', 'ipvg', 'ipvg', 'inventario');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?");
$stmt->bind_param("ss", $usuario, $contrasena);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuarioData = $resultado->fetch_assoc();
    $_SESSION['usuario'] = $usuarioData['usuario'];
    $_SESSION['rol'] = $usuarioData['rol'];
    header("Location: index.php");
} else {
    header("Location: login.php?error=1");
}

$stmt->close();
$conexion->close();
?>
