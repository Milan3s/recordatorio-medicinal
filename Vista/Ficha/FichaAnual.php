<?php
session_start();
require_once __DIR__ . '/../../FichaAnualControlador.php'; // Ajusta 'ruta/a/' según la ubicación real de FichaAnualControlador.php

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_nombre'])) {
    echo "Debe iniciar sesión para ver esta información.";
    exit;
}

$usuario_nombre = $_SESSION['usuario_nombre'];
$usuario_id = $_SESSION['usuario_id'];  // Asegúrate de que el ID de usuario esté en la sesión
$year = date("Y");  // Año actual, puedes cambiarlo según lo necesites

$controlador = new FichaAnualControlador();
$fichaAnual = $controlador->mostrarFichaAnual($usuario_id, $year);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Anual</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Bienvenido, <?php echo htmlspecialchars($usuario_nombre); ?></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- Card para la ficha anual -->
        <div class="card">
            <div class="card-header">
                Resumen Anual de Ejercicio - Año <?php echo $year; ?>
            </div>
            <div class="card-body">
                <?php if ($fichaAnual): ?>
                    <h5 class="card-title">Total de Sesiones: <?php echo $fichaAnual['total_sesiones']; ?></h5>
                    <p class="card-text">Pasos Totales: <?php echo $fichaAnual['total_pasos']; ?></p>
                    <p class="card-text">Calorías Quemadas: <?php echo $fichaAnual['total_calorias']; ?> kcal</p>
                    <p class="card-text">Kilos Perdidos: <?php echo $fichaAnual['total_kilos_perdidos']; ?> kg</p>
                <?php else: ?>
                    <p class="card-text">No hay registros de ejercicio para este año.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
</html>
