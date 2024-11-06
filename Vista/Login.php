<?php
// Activate debugging to see potential errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the Login controller
require_once __DIR__ . '/../Controlador/LoginControlador.php';

session_start(); // Start the session

// Process the login form when it is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];

    // Instantiate the class and call the method to verify login
    $loginControlador = new LoginControlador();
    $loginExitoso = $loginControlador->verificarLogin($nombre, $password);

    // Redirect if login is successful, or show an error message
    if ($loginExitoso) {
        header("Location: ../Listado/Aplicaciones.php");
        exit();
    } else {
        $mensajeError = "Error: Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../assets/logo.png" alt="Logo" width="30" height="30" class="me-2">
                <span class="fw-bold">Recordatorio Medicinal</span>
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

    <!-- Main content for login -->
    <div class="container d-flex flex-grow-1 justify-content-center align-items-center">
        <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
            <div class="text-center mb-4">
                <i class="bi bi-person" style="font-size: 4rem; color: #0d6efd;"></i>
                <h1 class="h4 mt-2">Iniciar sesión</h1>
                <p class="text-muted">Introduce tus datos para acceder a la aplicación</p>
            </div>

            <!-- Login form -->
            <form action="" method="POST">
                <!-- Error message if credentials are incorrect -->
                <?php if (isset($mensajeError)): ?>
                    <div class="alert alert-danger text-center mb-3">
                        <?php echo $mensajeError; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group mb-3">
                    <label for="nombre" class="form-label">Usuario</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
                <div class="form-group mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Acceder</button>
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
