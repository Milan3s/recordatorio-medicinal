<?php
session_start();
require_once __DIR__ . '/../../Controlador/DatosCorporalesControlador.php';

$mensaje = "";
$tipoMensaje = "";

// Verificación de ID en la URL
if (!isset($_GET['id'])) {
    header("Location: ListarDatos.php");
    exit();
}

$controlador = new DatosCorporalesControlador();
$registro = $controlador->obtenerPorId($_GET['id']);

// Obtener nombre de usuario para el dropdown
$nombre_usuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : "Usuario";

// Procesar formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $peso = $_POST['peso'];
    $semana = $_POST['semana'];
    $año = $_POST['year'];

    $resultado = $controlador->actualizar($_GET['id'], $registro['usuario_id'], $fecha, $peso, $semana, $año);

    if ($resultado) {
        $mensaje = "Registro actualizado correctamente.";
        $tipoMensaje = "success";
    } else {
        $mensaje = "Error al actualizar el registro.";
        $tipoMensaje = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datos Corporales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="ListarDatos.php">
                <img src="../../assets/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                Aplicación Listar
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
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="ListarDatos.php">
                            <i class="bi bi-activity me-1"></i> Datos Corporales
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> <?php echo htmlspecialchars($nombre_usuario); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usuarioDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Perfil</a></li>
                            <li><a class="dropdown-item" href="../../Controlador/Logout.php"><i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="text-center mb-4">Editar Datos Corporales</h2>

        <!-- Mensaje de éxito o error -->
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo $tipoMensaje; ?> text-center">
                <?php echo $mensaje; ?>
                <?php if ($tipoMensaje === "success"): ?>
                    <br><a href="ListarDatos.php" class="alert-link">Ver lista de datos corporales</a>
                <?php else: ?>
                    <br><a href="ListarDatos.php" class="alert-link text-danger">Regresar a la lista</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <form action="EditarDatos.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" method="POST" class="p-4 shadow rounded bg-light" style="max-width: 400px; margin: auto;">
            <!-- Campo oculto para usuario_id -->
            <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($registro['usuario_id']); ?>">

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo htmlspecialchars($registro['fecha']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="peso" class="form-label">Peso (kg)</label>
                <input type="text" class="form-control" id="peso" name="peso" value="<?php echo htmlspecialchars($registro['peso']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="semana" class="form-label">Semana</label>
                <input type="number" class="form-control" id="semana" name="semana" value="<?php echo htmlspecialchars($registro['semana']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Año</label>
                <input type="number" class="form-control" id="year" name="year" value="<?php echo htmlspecialchars($registro['year']); ?>" required>
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
