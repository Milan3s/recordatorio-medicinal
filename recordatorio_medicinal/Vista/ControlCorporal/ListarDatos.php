<?php
session_start();
require_once __DIR__ . '/../../Controlador/DatosCorporalesControlador.php';

$controlador = new DatosCorporalesControlador();
$registros = $controlador->listar();

$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : "";
$tipoMensaje = isset($_SESSION['tipoMensaje']) ? $_SESSION['tipoMensaje'] : "";

// Limpiar el mensaje de la sesión
unset($_SESSION['mensaje']);
unset($_SESSION['tipoMensaje']);

// Obtener el nombre del usuario para mostrarlo en el dropdown
$nombre_usuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : "Usuario";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Datos Corporales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <style>
        /* Centrar contenido de la tabla */
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="../../Listado/Aplicaciones.php">
                <img src="../../assets/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2 ">
                <span class="fw-bold">Aplicación Listado</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="../../Listado/Aplicaciones.php"><i class="bi bi-house-door me-1"></i> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="ListarDatos.php"><i class="bi bi-person-lines-fill me-1"></i> Datos Corporales</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> <?php echo htmlspecialchars($nombre_usuario); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usuarioDropdown">
                            <li><a class="dropdown-item" href="../../Controlador/Perfil.php"><i class="bi bi-person me-1"></i> Perfil</a></li>
                            <li><a class="dropdown-item" href="../../Controlador/Logout.php"><i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="text-center mb-4">Lista de Datos Corporales</h2>

        <!-- Mensaje de éxito o error -->
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo $tipoMensaje; ?> text-center">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <!-- Botón de añadir datos corporales -->
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <a href="AgregarDatos.php" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Añadir Datos Corporales
            </a>
        </div>

        <!-- Tabla de datos corporales -->
        <div class="table-responsive">
            <table id="datosCorporalesTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Peso</th>
                        <th>Semana</th>
                        <th>Año</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $registro): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($registro['control_id']); ?></td>
                            <td><?php echo htmlspecialchars($registro['usuario_nombre']); ?></td>
                            <td><?php echo htmlspecialchars($registro['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($registro['peso']); ?></td>
                            <td><?php echo htmlspecialchars($registro['semana']); ?></td>
                            <td><?php echo htmlspecialchars($registro['year']); ?></td>
                            <td>
                                <a href="EditarDatos.php?id=<?php echo $registro['control_id']; ?>" class="btn btn-warning btn-sm" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                <a href="EliminarDatos.php?id=<?php echo $registro['control_id']; ?>" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');"><i class="bi bi-trash"></i></a>
                                <a href="FichaDatos.php?id=<?php echo $registro['control_id']; ?>" class="btn btn-info btn-sm" title="Ver Detalle"><i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="bg-light text-center py-3 mt-auto">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Inicialización de DataTables con configuración en español -->
    <script>
        $(document).ready(function() {
            $('#datosCorporalesTable').DataTable({
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
