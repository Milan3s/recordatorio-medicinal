<?php
session_start();
require_once __DIR__ . '/../../Controlador/SaludControlador.php';

if (!isset($_GET['id'])) {
    header("Location: ListarSalud.php");
    exit();
}

$controlador = new SaludControlador();
$registro = $controlador->obtenerPorId($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'tipo' => $_POST['tipo'],
        'descripcion' => $_POST['descripcion'],
        'fecha' => $_POST['fecha']
    ];
    $resultado = $controlador->actualizar($_GET['id'], $data);

    if ($resultado) {
        $_SESSION['mensaje'] = "Registro actualizado correctamente.";
        $_SESSION['tipoMensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el registro.";
        $_SESSION['tipoMensaje'] = "danger";
    }

    header("Location: ListarSalud.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro de Salud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="ListarSalud.php">
                <img src="../../assets/logo.png" alt="Logo" width="30" height="30" class="me-2"> Aplicación Editar Salud
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="../../Listado/Aplicaciones.php"><i class="bi bi-house-door me-1"></i> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="ListarSalud.php"><i class="bi bi-heart me-1"></i> Listado de Salud</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulario de Editar Registro de Salud -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Editar Registro de Salud</h2>

        <form action="EditarSalud.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" method="POST" class="p-4 shadow rounded bg-light">
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo htmlspecialchars($registro['tipo']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo htmlspecialchars($registro['descripcion']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo htmlspecialchars($registro['fecha']); ?>" required>
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
