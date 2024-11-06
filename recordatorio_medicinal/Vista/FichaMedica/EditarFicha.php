<?php 
session_start();

if (!isset($_SESSION['nombre_usuario']) || !isset($_SESSION['usuario_id'])) {
    header("Location: ../../Vista/Login.php");
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];
$usuario_id = $_SESSION['usuario_id'];

require_once __DIR__ . '/../../Controlador/FichaControlador.php';
$fichaControlador = new FichaControlador();
$datosFicha = $fichaControlador->obtenerDatosFicha($usuario_id);

$datosUsuario = $datosFicha['datosUsuario'];
$historialMedico = $datosFicha['historialMedico'];
$controlCorporal = $datosFicha['controlCorporal'];
$tensionArterial = $datosFicha['tensionArterial'];

$mensaje = "";
$mensaje_tipo = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datosUsuario = [
        'nombre' => $_POST['nombre'],
        'edad' => $_POST['edad'],
        'genero' => $_POST['genero'],
        'telefono' => $_POST['telefono'],
        'foto' => $_POST['foto']
    ];

    $historialMedico = [
        'enfermedades_cronicas' => $_POST['enfermedades_cronicas'],
        'alergias' => $_POST['alergias'],
        'medicamentos_actuales' => $_POST['medicamentos_actuales'],
        'observaciones' => $_POST['observaciones']
    ];

    $controlCorporal = [
        'peso' => $_POST['peso'],
        'semana' => $_POST['semana'],
        'year' => $_POST['year']
    ];

    $tensionArterial = [
        'sistolica' => $_POST['sistolica'],
        'diastolica' => $_POST['diastolica'],
        'pulso' => $_POST['pulso']
    ];

    $actualizado = $fichaControlador->actualizarFicha($usuario_id, $datosUsuario, $historialMedico, $controlCorporal, $tensionArterial);

    if ($actualizado) {
        $mensaje = "Se ha actualizado la ficha correctamente.";
        $mensaje_tipo = "success";
    } else {
        $mensaje = "Ha fallado la actualización de la ficha.";
        $mensaje_tipo = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Ficha Médica</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <style>
        .card-hoja {
            max-width: 800px;
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
        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        .form-group {
            flex: 1;
        }
        .form-control-sm {
            width: 100%;
        }
        footer {
            text-align: center;
            padding: 10px 0;
            color: #777;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="../../assets/logo.png" width="30" height="30" alt="Logo" class="mr-2">
            <strong>Ficha Medica</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                 <!-- Botón de Volver -->
                 <li class="nav-item">
                    <a class="nav-link" href="Ficha.php"><i class="bi bi-arrow-left-circle me-1"></i> Volver</a>
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
            <h3 class="text-center">Actualizar Ficha Médica</h3>
        </div>

        <?php if ($mensaje): ?>
            <div class="alert alert-<?php echo $mensaje_tipo; ?> alert-dismissible fade show text-center" role="alert">
                <?php echo htmlspecialchars($mensaje); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <form method="POST" action="EditarFicha.php" class="w-100">
            <!-- Información del Paciente -->
            <div class="section">
                <p class="section-title">Información del Paciente</p>
                <div class="form-row">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control form-control-sm" value="<?php echo htmlspecialchars($datosUsuario['nombre']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Edad:</label>
                        <input type="text" name="edad" class="form-control form-control-sm" value="<?php echo htmlspecialchars($datosUsuario['edad']); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Género:</label>
                        <input type="text" name="genero" class="form-control form-control-sm" value="<?php echo htmlspecialchars($datosUsuario['genero']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Teléfono:</label>
                        <input type="text" name="telefono" class="form-control form-control-sm" value="<?php echo htmlspecialchars($datosUsuario['telefono']); ?>">
                    </div>
                </div>
            </div>

            <!-- Historial Médico -->
            <div class="section">
                <p class="section-title">Historial Médico</p>
                <div class="form-row">
                    <div class="form-group">
                        <label>Enfermedades Crónicas:</label>
                        <input type="text" name="enfermedades_cronicas" class="form-control form-control-sm" value="<?php echo htmlspecialchars($historialMedico['enfermedades_cronicas']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Alergias:</label>
                        <input type="text" name="alergias" class="form-control form-control-sm" value="<?php echo htmlspecialchars($historialMedico['alergias']); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Medicamentos Actuales:</label>
                        <input type="text" name="medicamentos_actuales" class="form-control form-control-sm" value="<?php echo htmlspecialchars($historialMedico['medicamentos_actuales']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Observaciones:</label>
                        <input type="text" name="observaciones" class="form-control form-control-sm" value="<?php echo htmlspecialchars($historialMedico['observaciones']); ?>">
                    </div>
                </div>
            </div>

            <!-- Datos de Control Corporal y Tensión Arterial en Flex -->
            <div class="section">
                <p class="section-title">Datos de Control Corporal y Tensión Arterial</p>
                <div class="form-row">
                    <div class="form-group">
                        <label>Peso:</label>
                        <input type="text" name="peso" class="form-control form-control-sm" value="<?php echo htmlspecialchars($controlCorporal['peso']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Semana:</label>
                        <input type="text" name="semana" class="form-control form-control-sm" value="<?php echo htmlspecialchars($controlCorporal['semana']); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Año:</label>
                        <input type="text" name="year" class="form-control form-control-sm" value="<?php echo htmlspecialchars($controlCorporal['year']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Sistólica:</label>
                        <input type="text" name="sistolica" class="form-control form-control-sm" value="<?php echo htmlspecialchars($tensionArterial['sistolica']); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Diastólica:</label>
                        <input type="text" name="diastolica" class="form-control form-control-sm" value="<?php echo htmlspecialchars($tensionArterial['diastolica']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Pulso:</label>
                        <input type="text" name="pulso" class="form-control form-control-sm" value="<?php echo htmlspecialchars($tensionArterial['pulso']); ?>">
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Actualizar Ficha</button>
                <button type="button" class="btn btn-secondary"><i class="bi bi-printer"></i> Imprimir</button>
            </div>
        </form>
    </div>
</div>

<footer class="bg-light text-center py-3 mt-4">
    <p class="mb-0">© 2024 Recordatorio Medicinal. Todos los derechos reservados.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
