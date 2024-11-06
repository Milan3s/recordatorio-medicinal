<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: Login.php");
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Aplicaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <style>
        /* Grid container styling */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            justify-content: center;
            margin-top: 40px;
            justify-items: center;
        }
        .grid-item {
            width: 328px;
            height: 216px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: #f8f9fa;
            text-align: center;
            transition: box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            color: inherit;
        }
        .grid-item:hover {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .grid-item i {
            font-size: 40px;
            margin-bottom: 10px;
        }
        .grid-item h5 {
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            color: #007bff;
        }
        /* Icon colors */
        .icon-medicamentos { color: #007bff; }
        .icon-tension { color: #e83e8c; }
        .icon-corporal { color: #28a745; }
        .icon-peso { color: #ffc107; }
        .icon-ficha { color: #6f42c1; }
        .icon-pasos { color: #17a2b8; }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .grid-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 576px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="../assets/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
            Recordatorio Medicinal
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Dropdown de Aplicaciones -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aplicacionesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-app-indicator"></i> Aplicaciones
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="aplicacionesDropdown">
                        <li><a class="dropdown-item" href="../Vista/Medicamentos/ListadoDeMedicamentos.php"><i class="bi bi-capsule me-2"></i> Listado de Medicamentos</a></li>
                        <li><a class="dropdown-item" href="../Vista/Salud/ListadoTension.php"><i class="bi bi-heart-pulse me-2"></i> Medidas de Tensión y pulsaciones</a></li>
                        <li><a class="dropdown-item" href="../Vista/ControlCorporal/ListarDatos.php"><i class="bi bi-activity me-2"></i> Control Corporal</a></li>
                        <li><a class="dropdown-item" href="../Vista/EjerciciosDiarios/ListarEjercicios.php"><i class="bi bi-arrow-down-up me-2"></i> Ejercicio Diario</a></li>
                        <li><a class="dropdown-item" href="../Vista/AvisoMedicinal/ListaAvisoMedicinal.php"><i class="bi bi-person-lines-fill me-2"></i> Aviso de Medicinas</a></li>
                        <li><a class="dropdown-item" href="../Vista/FichaMedica/Ficha.php"><i class="bi bi-file-earmark-medical me-2"></i> Ficha Médica Anual</a></li>
                    </ul>
                </li>

                <!-- Dropdown de Usuario -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($nombre_usuario); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usuarioDropdown">
                        <li><a class="dropdown-item" href="../Vista/PerfilUsuario/CardPerfilUsuario.php"><i class="bi bi-person"></i> Perfil</a></li>
                        <li><a class="dropdown-item" href="../Controlador/Logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <!-- Main Content -->
    <div class="container my-5">
        <h2 class="text-center mb-4 my-5">Listado de Aplicaciones</h2>
        <div class="grid-container">
            <a href="../Vista/Medicamentos/ListadoDeMedicamentos.php" class="grid-item">
                <i class="bi bi-capsule icon-medicamentos"></i>
                <h5>Listado de Medicamentos</h5>
            </a>
            <a href="../Vista/Salud/ListadoTension.php" class="grid-item">            
                <i class="bi bi-heart-pulse icon-tension"></i>
                <h5>Medidas de Tensión y pulsaciones</h5>                
            </a>
            <a href="../Vista/ControlCorporal/ListarDatos.php" class="grid-item">                
                <i class="bi bi-activity icon-corporal"></i>
                <h5>Control Corporal</h5>                
            </a>
            <a href="../Vista/EjerciciosDiarios/ListarEjercicios.php" class="grid-item">                
                <i class="bi bi-arrow-down-up icon-peso"></i>
                <h5>Ejercicio Diario</h5>                
            </a>
            <a href="../Vista/AvisoMedicinal/ListaAvisoMedicinal.php" class="grid-item">
                <i class="bi bi-person-lines-fill icon-pasos"></i>
                <h5>Aviso de Medicinas</h5>
            </a>
            <a href="../Vista/FichaMedica/Ficha.php" class="grid-item">
                <i class="bi bi-file-earmark-medical icon-ficha"></i>
                <h5>Ficha Médica Anual</h5>
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
