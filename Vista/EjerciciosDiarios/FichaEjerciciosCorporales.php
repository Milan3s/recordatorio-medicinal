<?php
session_start();
require_once __DIR__ . '/../../Controlador/EjerciciosDiariosControlador.php';

$controlador = new EjerciciosDiariosControlador();
$registro = $controlador->obtenerPorId($_GET['id']);
$nombre_usuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : "Usuario";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Ejercicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        .folio {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="../../index.php">
                <img src="../../assets/logo.png" alt="Logo" width="40" height="40" class="me-2">
                <span class="fw-bold">Aplicación Listado<span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="ListarEjercicios.php">
                            <i class="bi bi-arrow-left-circle"></i> Volver al Listado
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($nombre_usuario); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Perfil</a></li>
                            <li><a class="dropdown-item" href="../../Controlador/Logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido de Ficha de Ejercicio -->
    <div class="container my-5">
        <div class="folio">
            <h2 class="text-center mb-4">Detalle de Ejercicio</h2>
            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($registro['fecha']); ?></p>
            <p><strong>Hora de salida:</strong> <?php echo htmlspecialchars($registro['hora_salida']); ?></p>
            <p><strong>Hora de llegada:</strong> <?php echo htmlspecialchars($registro['hora_llegada']); ?></p>
            <p><strong>Sitio de salida:</strong> <?php echo htmlspecialchars($registro['sitio_salida']); ?></p>
            <p><strong>Sitio de salida:</strong> <?php echo htmlspecialchars($registro['sitio_llegada']); ?></p>
            <p><strong>Pasos:</strong> <?php echo htmlspecialchars($registro['pasos']); ?></p>
            <p><strong>Calorías perdidas:</strong> <?php echo htmlspecialchars($registro['calorias_perdidas']); ?></p>
            <p><strong>Kilos perdidos:</strong> <?php echo htmlspecialchars($registro['kilos_perdidos']); ?></p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto">
        &copy; <?php echo date("Y"); ?> Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
