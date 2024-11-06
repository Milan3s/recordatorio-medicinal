<?php
session_start();
require_once __DIR__ . '/../../Controlador/TensionControlador.php';

$controlador = new TensionControlador();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id'];
    $fecha = $_POST['fecha'];
    $sistolica = $_POST['sistolica'];
    $diastolica = $_POST['diastolica'];
    $pulso = $_POST['pulso'];
    
    $resultado = $controlador->insertarRegistroDeTension($usuario_id, $fecha, $sistolica, $diastolica, $pulso);

    if ($resultado) {
        $_SESSION['mensaje'] = "Registro de tensión agregado correctamente.";
        $_SESSION['tipoMensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al agregar el registro de tensión.";
        $_SESSION['tipoMensaje'] = "danger";
    }

    header("Location: ListadoTension.php");
    exit();
}

$nombre_usuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : "Usuario";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Registro de Tensión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="../../index.php">
                <img src="../../assets/logo.png" alt="Logo" width="30" height="30" class="me-2"> 
                <span class="fw-bold">Aplicación Listado</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="ListadoTension.php">
                            <i class="bi bi-arrow-left me-1"></i> Volver
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="AgregarTension.php">
                            <i class="bi bi-plus-circle me-1"></i> Agregar Tensión
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> <?php echo htmlspecialchars($nombre_usuario); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#"><i class="bi bi-person"></i> Perfil</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../../Controlador/Logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulario de Agregar Registro de Tensión -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Agregar Registro de Tensión</h2>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?php echo $_SESSION['tipoMensaje']; ?> text-center">
                <?php echo $_SESSION['mensaje']; ?>
            </div>
            <?php unset($_SESSION['mensaje'], $_SESSION['tipoMensaje']); ?>
        <?php endif; ?>

        <form action="AgregarTension.php" method="POST" class="p-4 shadow rounded bg-light" style="max-width: 500px; margin: 0 auto;">
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="sistolica" class="form-label">Sistólica</label>
                <input type="number" class="form-control" id="sistolica" name="sistolica" required>
            </div>
            <div class="mb-3">
                <label for="diastolica" class="form-label">Diastólica</label>
                <input type="number" class="form-control" id="diastolica" name="diastolica" required>
            </div>
            <div class="mb-3">
                <label for="pulso" class="form-label">Pulso</label>
                <input type="number" class="form-control" id="pulso" name="pulso" required>
            </div>
            <button type="submit" class="btn btn-success w-100"><i class="bi bi-plus-circle me-1"></i> Agregar Registro</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto">
        &copy; <?php echo date("Y"); ?> Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
