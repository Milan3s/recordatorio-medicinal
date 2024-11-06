<?php
session_start();
require_once __DIR__ . '/../../Controlador/MedicamentosControlador.php';
require_once __DIR__ . '/../../Controlador/AvisoMedicinalControlador.php';

// Verificación de inicio de sesión
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: ../../Controlador/Login.php");
    exit();
}

// Obtener nombre del usuario logueado
$nombre_usuario = $_SESSION['nombre_usuario'];
$usuario_id = $_SESSION['usuario_id'];

$medicamentosControlador = new MedicamentosControlador();
$avisoControlador = new AvisoMedicinalControlador();

// Obtener el aviso a editar
if (isset($_GET['id'])) {
    $aviso = $avisoControlador->obtenerAvisoPorId($_GET['id']);
} else {
    header("Location: ListaAvisoMedicinal.php");
    exit();
}

$medicamentos = $medicamentosControlador->listarMedicamentos();
$mensaje = "";
$tipoMensaje = "";

// Procesar formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $mes = $_POST['mes'] . "-01"; // Ajuste de formato a YYYY-MM-DD
    $toma = $_POST['toma'];
    $medicamento_id = $_POST['medicamento_id'];

    $resultado = $avisoControlador->actualizarAviso($aviso['id'], $fecha, $hora, $mes, $toma, $medicamento_id);

    if ($resultado) {
        $mensaje = "Aviso actualizado correctamente.";
        $tipoMensaje = "success";
    } else {
        $mensaje = "Error al actualizar el aviso.";
        $tipoMensaje = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aviso Medicinal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <style>
        .form-container {
            max-width: 400px;
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

    <div class="container my-5 form-container">
        <h2 class="text-center mb-4">Editar Aviso Medicinal</h2>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo $tipoMensaje; ?> text-center">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form action="EditarAviso.php?id=<?php echo htmlspecialchars($aviso['id']); ?>" method="POST" class="p-4 shadow rounded bg-light">
            <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuario_id); ?>">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo htmlspecialchars($aviso['fecha']); ?>" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="hora" class="form-label">Hora</label>
                    <input type="time" class="form-control" id="hora" name="hora" value="<?php echo htmlspecialchars($aviso['hora']); ?>" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="mes" class="form-label">Mes</label>
                    <input type="month" class="form-control" id="mes" name="mes" value="<?php echo substr(htmlspecialchars($aviso['mes']), 0, 7); ?>" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="toma" class="form-label">Toma</label>
                    <select class="form-select" id="toma" name="toma" required>
                        <option value="si" <?php echo $aviso['toma'] == 'si' ? 'selected' : ''; ?>>Sí</option>
                        <option value="no" <?php echo $aviso['toma'] == 'no' ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="medicamento_id" class="form-label">Medicamento</label>
                    <select class="form-select" id="medicamento_id" name="medicamento_id" required>
                        <?php foreach ($medicamentos as $medicamento): ?>
                            <option value="<?php echo $medicamento['medicamento_id']; ?>" <?php echo $aviso['medicamento_id'] == $medicamento['medicamento_id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($medicamento['marca']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-3"><i class="bi bi-pencil-square me-1"></i> Guardar Cambios</button>
        </form>
    </div>

    <footer class="bg-light text-center py-3 mt-auto">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

