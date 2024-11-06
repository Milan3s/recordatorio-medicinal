<?php
session_start();
require_once __DIR__ . '/../../Modelo/AvisoMedicinal.php';

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: ../../Controlador/Login.php");
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];

// Instancia del modelo y obtención de los datos
$modelo = new AvisoMedicinal();
$registros = $modelo->listarAvisos();

// Mensaje de eliminación
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : "";
$tipoMensaje = isset($_SESSION['tipoMensaje']) ? $_SESSION['tipoMensaje'] : "";

// Limpiar mensaje de la sesión
unset($_SESSION['mensaje']);
unset($_SESSION['tipoMensaje']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Avisos Medicinales</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="../../Listado/Aplicaciones.php">
                <img src="../../assets/logo.png" alt="Logo" width="30" height="30" class="me-2">
                Aplicación Medicinal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="../../Listado/Aplicaciones.php"><i class="bi bi-house-door me-1"></i> Inicio</a></li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="AgregarAviso.php">
                            <i class="bi bi-plus-circle me-1"></i> Agregar Aviso
                        </a>
                    </li>
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

    <!-- Contenido principal -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Listado de Avisos Medicinales</h2>

        <!-- Mensaje de éxito o error -->
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo $tipoMensaje; ?> text-center">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <!-- Botón de agregar aviso -->
        <div class="mb-3 text-start">
            <a href="AgregarAviso.php" class="btn btn-success text-white">
                <i class="bi bi-plus-circle me-1"></i> Agregar Aviso
            </a>
        </div>

        <?php if (count($registros) > 0): ?>
            <div class="table-responsive">
                <table id="avisosTable" class="table table-striped table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Mes</th>
                            <th>Toma</th>
                            <th>Medicamento</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registros as $registro): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($registro['id']); ?></td>
                                <td><?php echo htmlspecialchars($registro['fecha']); ?></td>
                                <td><?php echo htmlspecialchars($registro['hora']); ?></td>
                                <td><?php echo htmlspecialchars($registro['mes']); ?></td>
                                <td><?php echo htmlspecialchars($registro['toma']); ?></td>
                                <td><?php echo htmlspecialchars($registro['medicamento_nombre']); ?></td>
                                <td><?php echo htmlspecialchars($registro['usuario_nombre']); ?></td>
                                <td>
                                    <a href="EditarAviso.php?id=<?php echo $registro['id']; ?>" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="EliminarAviso.php?id=<?php echo $registro['id']; ?>" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este registro?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="FichaDetalleAviso.php?id=<?php echo $registro['id']; ?>" class="btn btn-info btn-sm" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <!-- Mensaje de que no se encontraron registros -->
            <div class="alert alert-info text-center" role="alert">
                No se encontraron registros de avisos medicinales.
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <!-- jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
