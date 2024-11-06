<?php
session_start();
require_once __DIR__ . '/../../Controlador/MedicamentosControlador.php';

if (!isset($_GET['id'])) {
    header("Location: ListadoDeMedicamentos.php");
    exit();
}

$controlador = new MedicamentosControlador();
$resultado = $controlador->eliminarMedicamento($_GET['id']);

if ($resultado) {
    $_SESSION['mensaje'] = "Medicamento eliminado correctamente.";
    $_SESSION['tipoMensaje'] = "success";
} else {
    $_SESSION['mensaje'] = "Error al eliminar el medicamento.";
    $_SESSION['tipoMensaje'] = "danger";
}

header("Location: ListadoDeMedicamentos.php");
exit();
?>
