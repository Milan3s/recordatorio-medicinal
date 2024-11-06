<?php
session_start();
require_once __DIR__ . '/../../Controlador/SaludControlador.php';

if (!isset($_GET['id'])) {
    header("Location: ListarSalud.php");
    exit();
}

$controlador = new SaludControlador();
$resultado = $controlador->eliminar($_GET['id']);

if ($resultado) {
    $_SESSION['mensaje'] = "Registro eliminado correctamente.";
    $_SESSION['tipoMensaje'] = "success";
} else {
    $_SESSION['mensaje'] = "Error al eliminar el registro.";
    $_SESSION['tipoMensaje'] = "danger";
}

header("Location: ListarSalud.php");
exit();
