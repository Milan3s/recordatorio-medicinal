<?php
session_start();
require_once __DIR__ . '/../../Controlador/SaludControlador.php';

$mensaje = "";
$tipoMensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controlador = new SaludControlador();
    $data = [
        'tipo' => $_POST['tipo'],
        'descripcion' => $_POST['descripcion'],
        'fecha' => $_POST['fecha']
    ];
    $resultado = $controlador->agregar($data);

    if ($resultado) {
        $mensaje = "Registro de salud agregado correctamente.";
        $tipoMensaje = "success";
    } else {
        $mensaje = "Error al agregar el registro de salud.";
        $tipoMensaje = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Registro de Salud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="ListarSalud.php">
                <img src="../../assets/logo.png" alt="Logo" width="30" height="30" class="me-2"> Aplicación Agregar Salud
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="../../Listado/Aplicaciones.php"><i class="bi bi-house-door me-1"></i> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="ListarSalud.php"><i class="bi bi-heart me-1"></i> Listado de Salud</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulario de Agregar Registro de Salud -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Agregar Registro de Salud</h2>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo $tipoMensaje; ?> text-center">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form action="AgregarSalud.php" method="POST" class="p-4 shadow rounded bg-light">
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <input type="text" class="form-control" id="tipo" name="tipo" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Agregar Registro</button>
        </form>
    </div>

    <footer class="bg-light text-center py-3 mt-auto">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
