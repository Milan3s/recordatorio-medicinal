<?php 
session_start(); // Iniciar la sesión para capturar el mensaje

// Obtener el mensaje de cierre de sesión si existe y eliminarlo después de mostrarlo
$logoutMessage = isset($_SESSION['logout_message']) ? $_SESSION['logout_message'] : "";
unset($_SESSION['logout_message']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recordatorio Medicinal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Navbar logo */
        .navbar-brand img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        /* Main content styling */
        .content {
            margin-top: 183px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            flex-grow: 1;
        }

        .pricing-header {
            margin-bottom: 50px;
        }

        /* Card styling */
        .card {
            width: 200px;
            height: 200px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            text-decoration: none;
            color: inherit;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0 15px; /* Horizontal spacing between cards */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        .card i {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .card h5 {
            font-size: 14px;
            font-weight: bold;
        }

        /* Logout message styling */
        .logout-message {
            max-width: 600px;
            font-size: 16px;
        }

        /* Footer styling */
        footer {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
            width: 100%;
            font-size: 14px;
            color: #6c757d;
            margin-top: auto;
        }

        /* Layout adjustments for mobile and tablet */
        @media (max-width: 576px) {
            .row {
                flex-direction: column;
                align-items: center;
            }

            .content {
                margin-top: 37px;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                flex-grow: 1;
                margin-bottom: 48px;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/logo.png" alt="Logo"> Recordatorio Medicinal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="Vista/Login.php">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Iniciar sesión
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Vista/Registro.php">
                            <i class="bi bi-person-plus me-1"></i>Registrar usuario
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container content">
        <div class="pricing-header">
            <h1>Recordatorio Medicinal</h1>
            <p class="lead">Bienvenido a la aplicación recordatorio medicinal, acuérdate de tu medicina.</p>
        </div>

        <div class="row justify-content-center">
            <!-- Card de Iniciar sesión -->
            <div class="col-auto my-2">
                <a href="Vista/Login.php" class="card text-center">
                    <i class="bi bi-box-arrow-in-right icon-medicamentos"></i>
                    <h5>Acceder con tus datos</h5>
                </a>
            </div>
            <!-- Card de Registrar usuario -->
            <div class="col-auto my-2">
                <a href="Vista/Registro.php" class="card text-center">
                    <i class="bi bi-person-plus icon-registro"></i>
                    <h5>Registra tus datos</h5>
                </a>
            </div>
        </div>
    </div>

    <!-- Mostrar mensaje de cierre de sesión -->
    <?php if (isset($logoutMessage) && $logoutMessage): ?>
        <div class="container d-flex justify-content-center mt-3">
            <div class="alert alert-success alert-dismissible fade show logout-message shadow" role="alert">
                <strong><?php echo htmlspecialchars($logoutMessage); ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <script>
            // Ocultar el mensaje después de 3 segundos
            setTimeout(function() {
                const alertElement = document.querySelector('.logout-message');
                if (alertElement) {
                    new bootstrap.Alert(alertElement).close();
                }
            }, 3000);
        </script>
    <?php endif; ?>


    <!-- Footer -->
    <footer>
        &copy; <?php echo date("Y"); ?> Recordatorio Medicinal. Todos los derechos reservados.
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
