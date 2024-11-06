<?php
session_start();
require_once __DIR__ . '/../../Controlador/TensionControlador.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: ../../Vista/Login.php"); // Redirige al login si no hay sesión activa
    exit();
}

// Obtener el nombre del usuario logueado
$nombre_usuario = $_SESSION['nombre_usuario'];

// Activa mensajes de error para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inicializar controlador y capturar posibles excepciones
try {
    $controlador = new TensionControlador();
    $registros = $controlador->listar();
} catch (Exception $e) {
    die("Error al cargar los registros: " . $e->getMessage());
}

// Mensajes de sesión (si existen)
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : "";
$tipoMensaje = isset($_SESSION['tipoMensaje']) ? $_SESSION['tipoMensaje'] : "";

// Limpiar mensajes de sesión
unset($_SESSION['mensaje']);
unset($_SESSION['tipoMensaje']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Tensión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
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
                    <li class="nav-item"><a class="nav-link" href="../../Listado/Aplicaciones.php"><i class="bi bi-house-door me-1"></i> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="ListadoTension.php"><i class="bi bi-heart-pulse me-1"></i> Listado de Tensión</a></li>
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

    <!-- Mensajes y Contenido -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Listado de Tensión</h2>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo htmlspecialchars($tipoMensaje); ?> text-center">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <div class="mb-3 d-flex justify-content-between align-items-center">
            <a href="AgregarTension.php" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Añadir Registro de Tensión
            </a>
        </div>

        <div class="table-responsive">
            <table id="tensionTable" class="table table-bordered table-striped text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Sistólica</th>
                        <th>Diastólica</th>
                        <th>Pulso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($registros)): ?>
                        <?php foreach ($registros as $registro): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($registro['tension_id']); ?></td>
                                <td><?php echo htmlspecialchars($registro['usuario_nombre']); ?></td>
                                <td><?php echo htmlspecialchars($registro['fecha']); ?></td>
                                <td><?php echo htmlspecialchars($registro['sistolica']); ?></td>
                                <td><?php echo htmlspecialchars($registro['diastolica']); ?></td>
                                <td><?php echo htmlspecialchars($registro['pulso']); ?></td>
                                <td>
                                    <a href="EditarTension.php?id=<?php echo $registro['tension_id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                    <a href="EliminarTension.php?id=<?php echo $registro['tension_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');"><i class="bi bi-trash"></i></a>
                                    <a href="FichaVerTension.php?id=<?php echo $registro['tension_id']; ?>" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron registros de tensión.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Inicialización de DataTables -->
    <script>
        $(document).ready(function() {
            $('#tensionTable').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
                },
                "paging": true,
                "lengthChange": false,
                "pageLength": 5,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });
        });
    </script>
</body>
</html>
