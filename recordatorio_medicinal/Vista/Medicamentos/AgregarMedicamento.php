<?php
session_start();
require_once __DIR__ . '/../../Controlador/MedicamentosControlador.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: ../../Controlador/Login.php");
    exit();
}

$mensaje = "";
$tipoMensaje = ""; // 'success' para OK o 'danger' para KO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = $_POST['marca'];
    $cantidad_pastillas = $_POST['cantidad_pastillas'];
    $precio = $_POST['precio'];
    $compras_mensuales = $_POST['compras_mensuales'];
    $medico = $_POST['medico'];

    $controlador = new MedicamentosControlador();
    $resultado = $controlador->agregarMedicamento($marca, $cantidad_pastillas, $precio, $compras_mensuales, $medico);

    if ($resultado) {
        $mensaje = "Medicamento insertado correctamente.";
        $tipoMensaje = "success";
    } else {
        $mensaje = "Error al insertar el medicamento.";
        $tipoMensaje = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Medicamento</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        /* Limitar el ancho del formulario */
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
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body class="container-flex">
    <!-- Navbar sticky -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="ListadoDeMedicamentos.php">
                <img src="../../assets/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                <span>Aplicación Listado</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="ListadoDeMedicamentos.php"><i class="bi bi-arrow-left-circle me-1"></i> Volver</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="AgregarMedicamento.php"><i class="bi bi-plus-circle me-1"></i> Agregar Medicamento</a>
                    </li>
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

    <!-- Mensaje de éxito o error -->
    <?php if (!empty($mensaje)): ?>
        <div class="container mt-3">
            <div class="alert alert-<?php echo $tipoMensaje; ?> text-center">
                <?php echo $mensaje; ?>
                <?php if ($tipoMensaje === "success"): ?>
                    <a href="ListadoDeMedicamentos.php" class="alert-link">Ver listado de medicamentos</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Formulario de Agregar Medicamento -->
    <div class="container content my-5">
        <h2 class="text-center mb-4">Agregar Medicamento</h2>
        <form action="AgregarMedicamento.php" method="POST" class="p-4 shadow rounded bg-light form-container">
            <div class="mb-3">
                <label for="marca" class="form-label"><i class="bi bi-capsule me-1"></i> Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" required>
            </div>
            <div class="mb-3">
                <label for="cantidad_pastillas" class="form-label"><i class="bi bi-bag me-1"></i> Cantidad de Pastillas</label>
                <input type="number" class="form-control" id="cantidad_pastillas" name="cantidad_pastillas" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label"><i class="bi bi-currency-euro me-1"></i> Precio (€)</label>
                <input type="text" class="form-control" id="precio" name="precio" required>
            </div>
            <div class="mb-3">
                <label for="compras_mensuales" class="form-label"><i class="bi bi-calendar me-1"></i> Compras Mensuales</label>
                <input type="number" class="form-control" id="compras_mensuales" name="compras_mensuales" required>
            </div>
            <div class="mb-3">
                <label for="medico" class="form-label"><i class="bi bi-person-badge me-1"></i> Médico</label>
                <input type="text" class="form-control" id="medico" name="medico" required>
            </div>
            <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Agregar Medicamento</button>
        </form>
    </div>

    <!-- Footer pegado al fondo -->
    <footer class="bg-light text-center py-3">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
