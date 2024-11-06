<?php
session_start();
require_once __DIR__ . '/../../Controlador/PerfilUsuarioControlador.php';

$controlador = new PerfilUsuarioControlador();
$usuario_id = $_SESSION['usuario_id'];
$nombre_usuario = $_SESSION['nombre_usuario'];
$perfil = $controlador->obtenerPerfil($usuario_id);
$roles = $controlador->obtenerRoles();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'nombre' => $_POST['nombre'],
        'email' => $_POST['email'],
        'telefono' => $_POST['telefono'],
        'rol_id' => $_POST['rol_id']
    ];
    $controlador->actualizarPerfil($usuario_id, $datos);
    header("Location: CardPerfilUsuario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <style>
        body, html {
            height: 100%;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
            margin: 0;
        }
        .content-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        footer {
            text-align: center;
            padding: 10px 0;
            color: #777;
            background-color: #e9ecef;
            width: 100%;
        }
        h2 {
            text-align: center;
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 20px;
        }
        /* Navbar con sombra y sticky */
        .navbar.sticky-top {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1030;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
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
                <li class="nav-item">
                    <a class="nav-link" href="../../Listado/Aplicaciones.php"><i class="bi bi-house-door me-1"></i> Inicio</a>
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
                        <a class="dropdown-item" href="../Vista/PerfilUsuario/CardPerfilUsuario.php"><i class="bi bi-person"></i> Perfil</a>
                        <a class="dropdown-item" href="../Controlador/Logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenido Principal -->
<div class="content-wrap">
    <div class="card">
        <h2>Editar Perfil de Usuario</h2>
        <form method="POST">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($perfil['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($perfil['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($perfil['telefono']); ?>" required>
            </div>
            <div class="form-group">
                <label for="rol_id">Rol</label>
                <select class="form-control" id="rol_id" name="rol_id" required>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?php echo $rol['rol_id']; ?>" <?php echo ($perfil['rol_id'] == $rol['rol_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($rol['nombre_rol']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Guardar Cambios</button>
                <a href="CardPerfilUsuario.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Cancelar</a>
            </div>
        </form>
    </div>
</div>

<!-- Footer -->
<footer>
    <p class="mb-0">© 2024 Recordatorio Medicinal. Todos los derechos reservados.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
