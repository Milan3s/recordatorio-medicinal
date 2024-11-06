<?php
session_start();
require_once __DIR__ . '/../../Controlador/MedicamentosControlador.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../Login.php");
    exit();
}

$controlador = new MedicamentosControlador();
$medicamentos = $controlador->listarMedicamentos();

$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : "";
$tipoMensaje = isset($_SESSION['tipoMensaje']) ? $_SESSION['tipoMensaje'] : "";

// Limpiar el mensaje de la sesión después de mostrarlo
unset($_SESSION['mensaje']);
unset($_SESSION['tipoMensaje']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Medicamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="ListadoDeMedicamentos.php">
                <img src="../../assets/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                Aplicación Listado
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="../../Listado/Aplicaciones.php"><i class="bi bi-house-door me-1"></i>Inicio</a></li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="ListadoDeMedicamentos.php"><i class="bi bi-capsule me-1"></i>Listado de Medicamentos</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>
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

    <!-- Contenido principal -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Mis Medicamentos</h2>

        <!-- Mensaje de éxito o error -->
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo $tipoMensaje; ?> text-center">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <!-- Botón de añadir medicamento -->
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <a href="AgregarMedicamento.php" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Añadir Medicamento
            </a>
        </div>

        <?php if (!empty($medicamentos)): ?>
            <!-- Tabla centrada -->
            <div class="table-responsive">
                <table id="medicamentosTable" class="table table-bordered table-striped text-center">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Marca</th>
                            <th>Cantidad de Pastillas</th>
                            <th>Precio (€)</th>
                            <th>Compras Mensuales</th>
                            <th>Médico</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($medicamentos as $medicamento): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($medicamento['medicamento_id']); ?></td>
                                <td><?php echo htmlspecialchars($medicamento['usuario_nombre']); ?></td>
                                <td><?php echo htmlspecialchars($medicamento['marca']); ?></td>
                                <td><?php echo htmlspecialchars($medicamento['cantidad_pastillas']); ?></td>
                                <td><?php echo htmlspecialchars($medicamento['precio']); ?></td>
                                <td><?php echo htmlspecialchars($medicamento['compras_mensuales']); ?></td>
                                <td><?php echo htmlspecialchars($medicamento['medico']); ?></td>
                                <td>
                                    <a href="EditarMedicamento.php?id=<?php echo $medicamento['medicamento_id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <a href="EliminarMedicamento.php?id=<?php echo $medicamento['medicamento_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este medicamento?');"><i class="bi bi-trash"></i></a>
                                    <a href="FichaMedicamento.php?id=<?php echo $medicamento['medicamento_id']; ?>" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <!-- Mensaje de que no se encontraron medicamentos -->
            <div class="alert alert-info text-center" role="alert">
                No se encontraron registros de medicamentos.
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
