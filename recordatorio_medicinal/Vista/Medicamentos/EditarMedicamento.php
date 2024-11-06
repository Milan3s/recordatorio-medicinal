<?php
session_start();
require_once __DIR__ . '/../../Controlador/MedicamentosControlador.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: ../../Controlador/Login.php");
    exit();
}

$mensaje = "";
$tipoMensaje = "";

if (!isset($_GET['id'])) {
    header("Location: ListadoDeMedicamentos.php");
    exit();
}

$controlador = new MedicamentosControlador();
$medicamento = $controlador->obtenerMedicamentoPorId($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = $_POST['marca'];
    $cantidad_pastillas = $_POST['cantidad_pastillas'];
    $precio = $_POST['precio'];
    $compras_mensuales = $_POST['compras_mensuales'];
    $medico = $_POST['medico'];

    $resultado = $controlador->actualizarMedicamento($_GET['id'], $marca, $cantidad_pastillas, $precio, $compras_mensuales, $medico);

    if ($resultado) {
        $mensaje = "Medicamento actualizado correctamente.";
        $tipoMensaje = "success";
    } else {
        $mensaje = "Error al actualizar el medicamento.";
        $tipoMensaje = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        /* Estilo para limitar el ancho del formulario */
        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }
        /* Asegurar que el footer esté en la parte inferior */
        .container-flex {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
    </style>
</head>
<body class="container-flex">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="ListadoDeMedicamentos.php">
                <img src="../../assets/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                <span>Aplicación Editar</span>
            </a>

            <a class="navbar-brand d-flex align-items-center" href="ListadoDeMedicamentos.php">
                    <i class="bi bi-arrow-left-circle me-2"></i> Volver
                </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link fw-bold" href="#"><i class="bi bi-pencil-square me-1"></i> Editar Medicamento</a></li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usuarioDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Perfil</a></li>
                            <li><a class="dropdown-item" href="../../Controlador/Logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container content my-5">
        <h2 class="text-center mb-4">Editar Medicamento</h2>
        
        <!-- Mostrar mensaje de actualización -->
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo $tipoMensaje; ?> text-center">
                <?php echo $mensaje; ?>
                <?php if ($tipoMensaje === "success"): ?>
                    <br><a href="ListadoDeMedicamentos.php" class="alert-link">Volver al listado</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <form action="EditarMedicamento.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" method="POST" class="p-4 shadow rounded bg-light form-container">
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" value="<?php echo htmlspecialchars($medicamento['marca']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="cantidad_pastillas" class="form-label">Cantidad de Pastillas</label>
                <input type="number" class="form-control" id="cantidad_pastillas" name="cantidad_pastillas" value="<?php echo htmlspecialchars($medicamento['cantidad_pastillas']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="text" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($medicamento['precio']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="compras_mensuales" class="form-label">Compras Mensuales</label>
                <input type="number" class="form-control" id="compras_mensuales" name="compras_mensuales" value="<?php echo htmlspecialchars($medicamento['compras_mensuales']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="medico" class="form-label">Médico</label>
                <input type="text" class="form-control" id="medico" name="medico" value="<?php echo htmlspecialchars($medicamento['medico']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
