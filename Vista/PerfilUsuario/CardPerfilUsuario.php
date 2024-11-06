<?php
session_start();
require_once __DIR__ . '/../../Controlador/PerfilUsuarioControlador.php';

$controlador = new PerfilUsuarioControlador();
$usuario_id = $_SESSION['usuario_id'];
$nombre_usuario = $_SESSION['nombre_usuario'];
$perfil = $controlador->obtenerPerfil($usuario_id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <style>
        /* Estilos personalizados */
        body, html {
            height: 100%;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
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
        /* Navbar con sombra y sticky */
        .navbar.sticky-top {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1030; /* para asegurar que quede sobre el contenido */
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
                        <a class="dropdown-item" href="../../Controlador/Logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenido Principal -->
<div class="content-wrap">
    <div class="card">
        <h2 class="text-center text-primary">Perfil de Usuario</h2>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($perfil['nombre']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($perfil['email']); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($perfil['telefono']); ?></p>
        <p><strong>Género:</strong> <?php echo htmlspecialchars($perfil['genero']); ?></p>
        <p><strong>Edad:</strong> <?php echo htmlspecialchars($perfil['edad']); ?></p>
        <p><strong>DNI:</strong> <?php echo htmlspecialchars($perfil['dni']); ?></p>
        <p><strong>Estado:</strong> <?php echo htmlspecialchars($perfil['estado']); ?></p>
        <p><strong>Rol:</strong> <?php echo htmlspecialchars($perfil['nombre_rol']); ?></p>
        <div class="text-center mt-3">
            <a href="EditarUsuario.php?id=<?php echo $usuario_id; ?>" class="btn btn-warning"><i class="bi bi-pencil"></i> Editar Perfil</a>
            <a href="EliminarUsuario.php?id=<?php echo $usuario_id; ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Eliminar Perfil</a>
        </div>
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
