<?php
session_start();
require_once __DIR__ . '/../../Controlador/MedicamentosControlador.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../Login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ListadoDeMedicamentos.php");
    exit();
}

$controlador = new MedicamentosControlador();
$medicamento = $controlador->obtenerMedicamentoPorId($_GET['id']);

// Obtener el nombre del usuario
$nombre_usuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : "Usuario";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <style>
        .navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .folio {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .folio h3 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="ListadoDeMedicamentos.php">
                <img src="../../assets/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                Aplicación Listado
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                        <a class="nav-link" href="ListadoDeMedicamentos.php">
                            <i class="bi bi-arrow-left me-1"></i> Volver
                        </a>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="DetalleTension.php"><i class="bi bi-file-earmark-text me-1"></i> Hoja de Detalle</a>
                    </li>
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

    <!-- Contenido principal -->
    <div class="container my-5">
        <div class="folio">
            <h3 class="text-center">Detalle del Medicamento</h3>
            <p><strong>Usuario:</strong> <?php echo htmlspecialchars($medicamento['usuario_nombre']); ?></p>
            <p><strong>Marca:</strong> <?php echo htmlspecialchars($medicamento['marca']); ?></p>
            <p><strong>Cantidad de Pastillas:</strong> <?php echo htmlspecialchars($medicamento['cantidad_pastillas']); ?></p>
            <p><strong>Precio (€):</strong> <?php echo htmlspecialchars($medicamento['precio']); ?></p>
            <p><strong>Compras Mensuales:</strong> <?php echo htmlspecialchars($medicamento['compras_mensuales']); ?></p>
            <p><strong>Médico:</strong> <?php echo htmlspecialchars($medicamento['medico']); ?></p>
            <div class="text-center mt-4">
                <a href="ListadoDeMedicamentos.php" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Volver al Listado</a>
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
