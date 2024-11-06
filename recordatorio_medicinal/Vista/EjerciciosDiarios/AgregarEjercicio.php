<?php
session_start();
require_once __DIR__ . '/../../Controlador/EjerciciosDiariosControlador.php';

$controlador = new EjerciciosDiariosControlador();
$mensaje = "";
$tipoMensaje = "";

$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha'];
    $hora_salida = $_POST['hora_salida'];
    $hora_llegada = $_POST['hora_llegada'];
    $sitio_salida = $_POST['sitio_salida'];
    $sitio_llegada = $_POST['sitio_llegada'];
    $pasos = $_POST['pasos'];
    $calorias_perdidas = $_POST['calorias_perdidas'];
    $kilos_perdidos = $_POST['kilos_perdidos'];

    $resultado = $controlador->agregar($usuario_id, $fecha, $hora_salida, $hora_llegada, $sitio_salida, $sitio_llegada, $pasos, $calorias_perdidas, $kilos_perdidos);

    if ($resultado) {
        $mensaje = "Ejercicio agregado correctamente.";
        $tipoMensaje = "success";
    } else {
        $mensaje = "Error al agregar el ejercicio.";
        $tipoMensaje = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Ejercicio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        /* Limitar el ancho del formulario */
        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar Sticky -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="../../index.php">
                <img src="../../assets/logo.png" alt="Logo" width="40" height="40" class="me-2">
                Aplicación Listado
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
                            <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($_SESSION['nombre_usuario'] ?? 'Usuario'); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-person"></i> Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../../Controlador/Logout.php">
                                    <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="text-center">Agregar Nuevo Ejercicio</h2>

        <!-- Mensaje de éxito o error -->
        <?php if ($mensaje): ?>
            <div class="alert alert-<?php echo $tipoMensaje; ?> mt-3">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <!-- Formulario con ancho limitado -->
        <form action="" method="POST" class="p-4 border rounded bg-light form-container">
            <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuario_id); ?>">

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="hora_salida" class="form-label">Hora de Salida</label>
                <input type="time" class="form-control" id="hora_salida" name="hora_salida" required>
            </div>
            <div class="mb-3">
                <label for="hora_llegada" class="form-label">Hora de Llegada</label>
                <input type="time" class="form-control" id="hora_llegada" name="hora_llegada" required>
            </div>
            <div class="mb-3">
                <label for="sitio_salida" class="form-label">Sitio de Salida</label>
                <input type="text" class="form-control" id="sitio_salida" name="sitio_salida" required>
            </div>
            <div class="mb-3">
                <label for="sitio_llegada" class="form-label">Sitio de Llegada</label>
                <input type="text" class="form-control" id="sitio_llegada" name="sitio_llegada" required>
            </div>
            <div class="mb-3">
                <label for="pasos" class="form-label">Pasos</label>
                <input type="number" class="form-control" id="pasos" name="pasos" required>
            </div>
            <div class="mb-3">
                <label for="calorias_perdidas" class="form-label">Calorías Perdidas</label>
                <input type="number" step="0.01" class="form-control" id="calorias_perdidas" name="calorias_perdidas" required>
            </div>
            <div class="mb-3">
                <label for="kilos_perdidos" class="form-label">Kilos Perdidos</label>
                <input type="number" step="0.001" class="form-control" id="kilos_perdidos" name="kilos_perdidos" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Ejercicio</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto">
        &copy; <?php echo date("Y"); ?> Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
