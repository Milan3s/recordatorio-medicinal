<?php
session_start();
require_once __DIR__ . '/../../Controlador/EjerciciosDiariosControlador.php';

if (!isset($_GET['id'])) {
    header("Location: ListarEjercicios.php");
    exit();
}

$controlador = new EjerciciosDiariosControlador();
$resultado = $controlador->eliminar($_GET['id']);

if ($resultado) {
    $_SESSION['mensaje'] = "Ejercicio eliminado correctamente.";
    $_SESSION['tipoMensaje'] = "success";
} else {
    $_SESSION['mensaje'] = "Error al eliminar el ejercicio.";
    $_SESSION['tipoMensaje'] = "danger";
}

header("Location: ListarEjercicios.php");
exit();
