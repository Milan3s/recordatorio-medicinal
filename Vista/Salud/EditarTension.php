<?php
session_start();
require_once __DIR__ . '/../../Controlador/TensionControlador.php';

// Verificar si el ID está presente en la URL
if (!isset($_GET['id'])) {
    header("Location: ListadoTension.php");
    exit();
}

$controlador = new TensionControlador();
$registro = $controlador->obtenerPorId($_GET['id']);

// Procesar el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $sistolica = $_POST['sistolica'];
    $diastolica = $_POST['diastolica'];
    $pulso = $_POST['pulso'];
    
    $resultado = $controlador->actualizar($_GET['id'], $fecha, $sistolica, $diastolica, $pulso);

    if ($resultado) {
        $_SESSION['mensaje'] = "Registro de tensión actualizado correctamente.";
        $_SESSION['tipoMensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el registro de tensión.";
        $_SESSION['tipoMensaje'] = "danger";
    }

    header("Location: ListadoTension.php");
    exit();
}

// Obtener el nombre del usuario para el dropdown
$nombre_usuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : "Usuario";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro de Tensión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <style>
        /* Limitar el ancho del formulario */
        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="ListadoTension.php">
                <img src="../../assets/logo.png" alt="Logo" width="30" height="30" class="me-2"> 
                <span class="fw-bold">Aplicación Listado</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="ListadoTension.php">
                            <i class="bi bi-arrow-left me-1"></i> Volver
                        </a>
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

    <!-- Formulario de Editar Registro de Tensión -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Editar Registro de Tensión</h2>

        <form action="EditarTension.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" method="POST" class="p-4 shadow rounded bg-light form-container">
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo htmlspecialchars($registro['fecha']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="sistolica" class="form-label">Sistólica</label>
                <input type="number" class="form-control" id="sistolica" name="sistolica" value="<?php echo htmlspecialchars($registro['sistolica']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="diastolica" class="form-label">Diastólica</label>
                <input type="number" class="form-control" id="diastolica" name="diastolica" value="<?php echo htmlspecialchars($registro['diastolica']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="pulso" class="form-label">Pulso</label>
                <input type="number" class="form-control" id="pulso" name="pulso" value="<?php echo htmlspecialchars($registro['pulso']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Guardar Cambios</button>
        </form>
    </div>

    <footer class="bg-light text-center py-3 mt-auto">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
