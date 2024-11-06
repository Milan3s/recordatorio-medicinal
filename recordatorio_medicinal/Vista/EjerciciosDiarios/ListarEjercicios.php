<?php
session_start();
require_once __DIR__ . '/../../Controlador/EjerciciosDiariosControlador.php';

$controlador = new EjerciciosDiariosControlador();
$registros = $controlador->listar();

$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : "";
$tipoMensaje = isset($_SESSION['tipoMensaje']) ? $_SESSION['tipoMensaje'] : "";
unset($_SESSION['mensaje']);
unset($_SESSION['tipoMensaje']);

$nombre_usuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : "Usuario";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Ejercicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="../../index.php">
                <img src="../../assets/logo.png" alt="Logo" width="40" height="40" class="me-2">
                Aplicación Listado
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../Listado/Aplicaciones.php">
                            <i class="bi bi-house-door me-1"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="ListarEjercicios.php">
                            <i class="bi bi-list-check me-1"></i> Listado de Ejercicios
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($nombre_usuario); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Perfil</a></li>
                            <li><a class="dropdown-item" href="../../Controlador/Logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="text-center mb-4">Listado de Ejercicios Diarios</h2>

        <!-- Mensaje de éxito o error -->
        <?php if ($mensaje): ?>
            <div class="alert alert-<?php echo $tipoMensaje; ?> text-center">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="AgregarEjercicio.php" class="btn btn-success text-white">
                <i class="bi bi-plus-circle"></i> Agregar Ejercicio
            </a>
        </div>

        <div class="table-responsive">
            <table id="ejerciciosTable" class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>Fecha</th>
                        <th>Hora de Salida</th>
                        <th>Hora de Llegada</th>
                        <th>Sitio de Salida</th>
                        <th>Sitio de Llegada</th>
                        <th>Pasos</th>
                        <th>Calorías Perdidas</th>
                        <th>Kilos Perdidos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $registro): ?>
                        <tr class="text-center">
                            <td><?php echo htmlspecialchars($registro['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($registro['hora_salida']); ?></td>
                            <td><?php echo htmlspecialchars($registro['hora_llegada']); ?></td>
                            <td><?php echo htmlspecialchars($registro['sitio_salida']); ?></td>
                            <td><?php echo htmlspecialchars($registro['sitio_llegada']); ?></td>
                            <td><?php echo htmlspecialchars($registro['pasos']); ?></td>
                            <td><?php echo htmlspecialchars($registro['calorias_perdidas']); ?></td>
                            <td><?php echo htmlspecialchars($registro['kilos_perdidos']); ?></td>
                            <td>
                                <a href="FichaEjerciciosCorporales.php?id=<?php echo $registro['ejercicio_id']; ?>" class="btn btn-info btn-sm" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="EditarEjercicio.php?id=<?php echo $registro['ejercicio_id']; ?>" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="EliminarEjercicio.php?id=<?php echo $registro['ejercicio_id']; ?>" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto">
        &copy; <?php echo date("Y"); ?> Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Inicialización de DataTables -->
    <script>
        $(document).ready(function() {
            $('#ejerciciosTable').DataTable({
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
