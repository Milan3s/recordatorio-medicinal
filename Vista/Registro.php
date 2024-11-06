<?php
require_once __DIR__ . '/../Controlador/RegistroControlador.php';

$message = ""; // Variable para almacenar el mensaje
$messageClass = ""; // Clase CSS para el color del mensaje

// Procesar el formulario de registro cuando se envíe
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Instanciar la clase y llamar al método registrarUsuario
    $registroControlador = new RegistroControlador();
    $registroExitoso = $registroControlador->registrarUsuario($nombre, $email, $password);

    if ($registroExitoso) {
        $message = "Registro exitoso. Bienvenido a la aplicación.";
        $messageClass = "alert alert-success"; // Clase para color verde
    } else {
        $message = "Error al registrar el usuario.";
        $messageClass = "alert alert-danger"; // Clase para color rojo
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../assets/logo.png" alt="Logo" width="30" height="30" class="me-2">
                Recordatorio Medicinal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="Login.php"><i class="bi bi-box-arrow-in-right me-1"></i>Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="Registro.php"><i class="bi bi-person-plus me-1"></i>Registrar usuario</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal de registro -->
    <div class="container d-flex flex-grow-1 justify-content-center align-items-center">
        <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
            <!-- Logo -->
            <div class="text-center mb-4">
            <i class="bi bi-person-plus" style="font-size: 3rem; color: #0d6efd;"></i>
                <h1 class="h4 mt-2">Registro de Usuario</h1>
                <p class="text-muted">Completa tus datos para registrarte en la aplicación</p>
            </div>

            <!-- Mostrar mensaje de registro -->
            <?php if ($message): ?>
                <div class="<?php echo $messageClass; ?> text-center mb-3">
                    <?php echo $message; ?>
                    <?php if ($messageClass === "alert alert-success"): ?>
                        <a href="../Vista/Login.php" class="text-decoration-none">Iniciar sesión</a>.
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Formulario de registro -->
            <form action="" method="POST">
                <div class="form-group mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group mb-4">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Registrar</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto">
        &copy; 2024 Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
