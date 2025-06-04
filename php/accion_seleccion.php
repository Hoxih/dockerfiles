<?php
if (!isset($_POST['id']) || !isset($_POST['accion'])) {
    die("Solicitud inválida.");
}

$id = intval($_POST['id']);
$accion = $_POST['accion'];

if ($accion === 'editar') {
    header("Location: editar.php?id=$id");
    exit;
} elseif ($accion === 'eliminar') {
    header("Location: eliminar.php?id=$id");
    exit;
} else {
    die("Acción no válida.");
}
