<?php
session_start();
require_once __DIR__ . '/../../Controlador/AvisoMedicinalControlador.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: ../../Controlador/Login.php");
    exit();
}

// Obtener nombre del usuario logueado
$nombre_usuario = $_SESSION['nombre_usuario'];
$avisoControlador = new AvisoMedicinalControlador();

// Obtener el aviso por ID
if (isset($_GET['id'])) {
    $aviso = $avisoControlador->obtenerAvisoPorId($_GET['id']);
    if (!$aviso) {
        $_SESSION['mensaje'] = "No se encontró el aviso solicitado.";
        $_SESSION['tipoMensaje'] = "danger";
        header("Location: ListaAvisoMedicinal.php");
        exit();
    }
} else {
    header("Location: ListaAvisoMedicinal.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Aviso Medicinal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <style>
        .detail-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="../../Listado/Aplicaciones.php">
                <img src="../../assets/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                <span class="fw-bold">Aplicación Medicinal</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="ListaAvisoMedicinal.php"><i class="bi bi-arrow-left me-1"></i> Volver al Listado</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> <?php echo htmlspecialchars($nombre_usuario); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usuarioDropdown">
                            <li><a class="dropdown-item" href="../../Perfil.php"><i class="bi bi-person"></i> Perfil</a></li>
                            <li><a class="dropdown-item" href="../../Controlador/Logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container my-5 detail-container">
        <h2 class="text-center mb-4">Detalle del Aviso Medicinal</h2>

        <!-- Mensaje de éxito o error -->
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?php echo $_SESSION['tipoMensaje']; ?> text-center">
                <?php echo $_SESSION['mensaje']; ?>
            </div>
            <?php unset($_SESSION['mensaje'], $_SESSION['tipoMensaje']); ?>
        <?php endif; ?>

        <!-- Detalles del aviso -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Información del Aviso</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Usuario:</strong> <?php echo htmlspecialchars($aviso['usuario_nombre']); ?></li>
                    <li class="list-group-item"><strong>Medicamento:</strong> <?php echo htmlspecialchars($aviso['medicamento_nombre']); ?></li>
                    <li class="list-group-item"><strong>Fecha:</strong> <?php echo htmlspecialchars($aviso['fecha']); ?></li>
                    <li class="list-group-item"><strong>Hora:</strong> <?php echo htmlspecialchars($aviso['hora']); ?></li>
                    <li class="list-group-item"><strong>Mes:</strong> <?php echo htmlspecialchars($aviso['mes']); ?></li>
                    <li class="list-group-item"><strong>Toma:</strong> <?php echo htmlspecialchars($aviso['toma'] == 'si' ? 'Sí' : 'No'); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <footer class="bg-light text-center py-3 mt-auto">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
