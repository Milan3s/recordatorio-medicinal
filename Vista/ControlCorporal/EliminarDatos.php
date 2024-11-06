<?php
session_start();
require_once __DIR__ . '/../../Controlador/DatosCorporalesControlador.php';

if (!isset($_GET['id'])) {
    header("Location: ListarDatos.php");
    exit();
}

$controlador = new DatosCorporalesControlador();
$resultado = $controlador->eliminar($_GET['id']);

if ($resultado) {
    $_SESSION['mensaje'] = "Registro eliminado correctamente.";
    $_SESSION['tipoMensaje'] = "success";
} else {
    $_SESSION['mensaje'] = "Error al eliminar el registro.";
    $_SESSION['tipoMensaje'] = "danger";
}

header("Location: ListarDatos.php");
exit();
?>
