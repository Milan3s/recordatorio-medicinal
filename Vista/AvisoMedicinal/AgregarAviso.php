<?php
session_start();
require_once __DIR__ . '/../../Controlador/MedicamentosControlador.php';
require_once __DIR__ . '/../../Controlador/AvisoMedicinalControlador.php';

// Verificación de inicio de sesión
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: ../../Controlador/Login.php");
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];
$usuario_id = $_SESSION['usuario_id'];
$medicamentosControlador = new MedicamentosControlador();
$avisoControlador = new AvisoMedicinalControlador();

$medicamentos = $medicamentosControlador->listarMedicamentos();

// Mostrar mensaje y limpiar sesión
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : "";
$tipoMensaje = isset($_SESSION['tipoMensaje']) ? $_SESSION['tipoMensaje'] : "";
unset($_SESSION['mensaje'], $_SESSION['tipoMensaje']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $mes = $_POST['mes'];
    $toma = $_POST['toma'];
    $medicamento_id = $_POST['medicamento_id'];

    $resultado = $avisoControlador->agregarAviso($usuario_id, $fecha, $hora, $mes, $toma, $medicamento_id);

    if ($resultado) {
        $_SESSION['mensaje'] = "Aviso agregado correctamente.";
        $_SESSION['tipoMensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al agregar el aviso. Por favor, revise los registros de error.";
        $_SESSION['tipoMensaje'] = "danger";
    }
    header("Location: AgregarAviso.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Aviso Medicinal</title>
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
        <h2 class="text-center mb-4">Agregar Aviso Medicinal</h2>

        <!-- Mensaje de éxito o error -->
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo $tipoMensaje; ?> text-center">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form action="AgregarAviso.php" method="POST" class="p-4 shadow rounded bg-light">
            <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="hora" class="form-label">Hora</label>
                    <input type="time" class="form-control" id="hora" name="hora" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="mes" class="form-label">Mes</label>
                    <input type="month" class="form-control" id="mes" name="mes" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="toma" class="form-label">Toma</label>
                    <select class="form-select" id="toma" name="toma" required>
                        <option value="">Seleccione...</option>
                        <option value="si">Sí</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="medicamento_id" class="form-label">Medicamento</label>
                    <select class="form-select" id="medicamento_id" name="medicamento_id" required>
                        <option value="">Seleccione un medicamento...</option>
                        <?php foreach ($medicamentos as $medicamento): ?>
                            <option value="<?php echo $medicamento['medicamento_id']; ?>"><?php echo htmlspecialchars($medicamento['marca']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100 mt-3"><i class="bi bi-plus-circle me-1"></i> Agregar Aviso</button>
        </form>
    </div>

    <footer class="bg-light text-center py-3 mt-auto">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
