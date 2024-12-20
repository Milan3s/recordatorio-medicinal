<?php
session_start();
require_once __DIR__ . '/../../Controlador/DatosCorporalesControlador.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../Login.php");
    exit();
}

$controlador = new DatosCorporalesControlador();

if (!isset($_GET['id'])) {
    header("Location: ListadoDatosCorporales.php");
    exit();
}

$registro = $controlador->obtenerPorId($_GET['id']);
$nombre_usuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : "Usuario";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Datos Corporales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
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
        .folio h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-back {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="">
                <img src="../../assets/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                Aplicación Datos Corporales
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="ListarDatos.php">
                            <i class="bi bi-arrow-left me-1"></i> Volver
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="ListadoDatosCorporales.php"><i class="bi bi-person-lines-fill me-1"></i> Listado de Datos Corporales</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> <?php echo htmlspecialchars($nombre_usuario); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usuarioDropdown">
                            <li><a class="dropdown-item" href="../../Controlador/Logout.php"><i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Ficha de Datos Corporales -->
    <div class="container my-5">
        <div class="folio">
            <h2>Ficha de Datos Corporales</h2>
            <p><strong>Nombre del Usuario:</strong> <?php echo htmlspecialchars($registro['usuario_nombre']); ?></p>
            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($registro['fecha']); ?></p>
            <p><strong>Peso:</strong> <?php echo htmlspecialchars($registro['peso']); ?> kg</p>
            <p><strong>Semana:</strong> <?php echo htmlspecialchars($registro['semana']); ?></p>
            <p><strong>Año:</strong> <?php echo htmlspecialchars($registro['year']); ?></p>
            <div class="btn-back">
                <a href="ListarDatos.php" class="btn btn-primary mt-4"><i class="bi bi-arrow-left me-1"></i> Volver al Listado</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
