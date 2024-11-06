<?php 
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['nombre_usuario']) || !isset($_SESSION['usuario_id'])) {
    header("Location: ../../Vista/Login.php"); // Redirige al login si no hay sesión activa
    exit();
}

// Obtener el nombre del usuario logueado y su ID
$nombre_usuario = $_SESSION['nombre_usuario'];
$usuario_id = $_SESSION['usuario_id'];

// Incluir el controlador y obtener los datos
require_once __DIR__ . '/../../Controlador/FichaControlador.php';
$fichaControlador = new FichaControlador();
$datosFicha = $fichaControlador->obtenerDatosFicha($usuario_id);

// Asignar datos individuales para facilidad de uso en la vista
$datosUsuario = $datosFicha['datosUsuario'] ?? null;
$historialMedico = $datosFicha['historialMedico'] ?? null;
$controlCorporal = $datosFicha['controlCorporal'] ?? null;
$tensionArterial = $datosFicha['tensionArterial'] ?? null;

// Activa mensajes de error para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Médica</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <style>
        /* Estilos personalizados */
        .card-hoja {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #ccc;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .header-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header-section h3 {
            color: #007bff;
            font-size: 1.5rem;
            margin: 0;
        }
        .user-photo {
            width: 67px;
            height: 67px;
            border: 2px solid #ccc;
            border-radius: 50%;
            background-image: url('<?php echo htmlspecialchars($datosUsuario['foto'] ?? 'https://via.placeholder.com/50'); ?>');
            background-size: cover;
            background-position: center;
        }
        .section-title {
            font-weight: bold;
            color: #555;
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
            padding-bottom: 5px;
        }
        .data-field {
            font-weight: bold;
            color: #333;
        }
        .flex-sections {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        .flex-section {
            flex: 1;
            border: 1px solid #ddd;
            padding: 10px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }
        footer {
            text-align: center;
            padding: 10px 0;
            color: #777;
        }
        .navbar-shadow {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top navbar-shadow">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="../../assets/logo.png" width="30" height="30" alt="Logo" class="mr-2">
            Aplicación Medicinal
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <!-- Botón de Volver -->
                <li class="nav-item">
                    <a class="nav-link" href="../../Listado/Aplicaciones.php"><i class="bi bi-arrow-left-circle me-1"></i> Volver</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-file-medical me-1"></i> Ficha Médica</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($nombre_usuario); ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><i class="bi bi-person"></i> Perfil</a>
                        <a class="dropdown-item" href="../../Controlador/Logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-4">
    <div class="card card-hoja">
        <div class="header-section">
            <h3>Ficha Médica</h3>
        </div>
        <div class="card-body">
            <?php if (!$datosUsuario && !$historialMedico && !$controlCorporal && !$tensionArterial): ?>
                <div class="alert alert-info text-center" role="alert">
                    Aún no se han introducido datos para este usuario.
                </div>
            <?php else: ?>
                <!-- Información del Paciente -->
                <div class="section">
                    <p class="section-title">Información del Paciente</p>
                    <p><span class="data-field">Nombre:</span> <?php echo htmlspecialchars($datosUsuario['nombre'] ?? ''); ?></p>
                    <p><span class="data-field">Edad:</span> <?php echo htmlspecialchars($datosUsuario['edad'] ?? '') . ' años'; ?></p>
                    <p><span class="data-field">Género:</span> <?php echo htmlspecialchars($datosUsuario['genero'] ?? ''); ?></p>
                    <p><span class="data-field">Teléfono:</span> <?php echo htmlspecialchars($datosUsuario['telefono'] ?? ''); ?></p>
                </div>

                <!-- Historial Médico -->
                <div class="section">
                    <p class="section-title">Historial Médico</p>
                    <p><span class="data-field">Enfermedades Crónicas:</span> <?php echo htmlspecialchars($historialMedico['enfermedades_cronicas'] ?? ''); ?></p>
                    <p><span class="data-field">Alergias:</span> <?php echo htmlspecialchars($historialMedico['alergias'] ?? ''); ?></p>
                    <p><span class="data-field">Medicamentos Actuales:</span> <?php echo htmlspecialchars($historialMedico['medicamentos_actuales'] ?? ''); ?></p>
                    <p><span class="data-field">Observaciones:</span> <?php echo htmlspecialchars($historialMedico['observaciones'] ?? ''); ?></p>
                </div>

                <!-- Datos de Control Corporal y Tensión Arterial en Flex -->
                <div class="flex-sections">
                    <!-- Datos de Control Corporal -->
                    <div class="flex-section">
                        <p class="section-title">Datos de Control Corporal</p>
                        <p><span class="data-field">Peso:</span> <?php echo htmlspecialchars($controlCorporal['peso'] ?? '') . ' kg'; ?></p>
                        <p><span class="data-field">Semana:</span> <?php echo htmlspecialchars($controlCorporal['semana'] ?? ''); ?></p>
                        <p><span class="data-field">Año:</span> <?php echo htmlspecialchars($controlCorporal['year'] ?? ''); ?></p>
                    </div>

                    <!-- Tensión Arterial -->
                    <div class="flex-section">
                        <p class="section-title">Tensión Arterial</p>
                        <p><span class="data-field">Sistólica:</span> <?php echo htmlspecialchars($tensionArterial['sistolica'] ?? '') . ' mmHg'; ?></p>
                        <p><span class="data-field">Diastólica:</span> <?php echo htmlspecialchars($tensionArterial['diastolica'] ?? '') . ' mmHg'; ?></p>
                        <p><span class="data-field">Pulso:</span> <?php echo htmlspecialchars($tensionArterial['pulso'] ?? '') . ' BPM'; ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="text-center mt-4">
                <a href="EditarFicha.php?usuario_id=<?php echo $usuario_id; ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Actualizar Ficha</a>
                <button class="btn btn-secondary"><i class="bi bi-printer"></i> Imprimir</button>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-light text-center py-3 mt-4">
    <p class="mb-0">© 2024 Recordatorio Medicinal. Todos los derechos reservados.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
