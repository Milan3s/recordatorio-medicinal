<?php
session_start();
require_once __DIR__ . '/../../Controlador/AvisoMedicinalControlador.php';

if (!isset($_GET['id'])) {
    header("Location: ListaAvisoMedicinal.php");
    exit();
}

$controlador = new AvisoMedicinalControlador();
$resultado = $controlador->eliminarAviso($_GET['id']);

if ($resultado) {
    $_SESSION['mensaje'] = "Aviso eliminado correctamente.";
    $_SESSION['tipoMensaje'] = "success";
} else {
    $_SESSION['mensaje'] = "Error al eliminar el aviso.";
    $_SESSION['tipoMensaje'] = "danger";
}

header("Location: ListaAvisoMedicinal.php");
exit();
?>
