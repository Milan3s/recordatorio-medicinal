<?php
session_start();
require_once __DIR__ . '/../../Controlador/DatosCorporalesControlador.php';

// Obtener el nombre del usuario para mostrarlo en el dropdown
$nombre_usuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : "Usuario";

$mensaje = "";
$tipoMensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controlador = new DatosCorporalesControlador();
    $usuario_id = $_SESSION['usuario_id']; // Obtiene el ID del usuario logueado desde la sesión
    $resultado = $controlador->agregar($usuario_id, $_POST['fecha'], $_POST['peso'], $_POST['semana'], $_POST['year']);

    if ($resultado) {
        $mensaje = "Registro agregado correctamente. <a href='ListarDatos.php' class='alert-link'>Ver lista de registros</a>";
        $tipoMensaje = "success";
    } else {
        $mensaje = "Error al agregar el registro. <a href='ListarDatos.php' class='alert-link'>Volver a la lista</a>";
        $tipoMensaje = "danger";
    }    
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Datos Corporales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <style>
        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="../../Listado/Aplicaciones.php">
                <img src="../../assets/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                Aplicación Listado
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
                    <li class="nav-item"><a class="nav-link fw-bold" href="ListarDatos.php"><i class="bi bi-activity me-1"></i> Agregar Datos Corporales</a></li>
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

    <div class="container my-5">
        <h2 class="text-center mb-4">Agregar Datos Corporales</h2>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo $tipoMensaje; ?> text-center">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form action="AgregarDatos.php" method="POST" class="p-4 shadow rounded bg-light form-container">
            <!-- Campo oculto para el ID del usuario logueado -->
            <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($_SESSION['usuario_id']); ?>">

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="peso" class="form-label">Peso (kg)</label>
                <input type="text" class="form-control" id="peso" name="peso" required>
            </div>
            <div class="mb-3">
                <label for="semana" class="form-label">Semana</label>
                <input type="number" class="form-control" id="semana" name="semana" required>
            </div>
            <div class="mb-3">
                <label for="año" class="form-label">Año</label>
                <input type="number" class="form-control" id="year" name="year" required>
            </div>
            <button type="submit" class="btn btn-success">Agregar Registro</button>
        </form>
    </div>

    <footer class="bg-light text-center py-3 mt-auto">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
