<?php
session_start(); // Iniciar la sesión

// Incluir el archivo de conexión o el modelo necesario para interactuar con la base de datos
require_once __DIR__ . '/../Modelo/ModeloBase.php';

// Crear una instancia de la conexión a la base de datos
class LogoutControlador extends ModeloBase {
    public function actualizarEstado($usuario_id, $estado) {
        $sql = "UPDATE usuarios SET estado = :estado WHERE usuario_id = :usuario_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
    }
}

// Verificar si el usuario está en sesión
if (isset($_SESSION['usuario_id'])) {
    // Crear una instancia de LogoutControlador y actualizar el estado a 'off'
    $logoutControlador = new LogoutControlador();
    $logoutControlador->actualizarEstado($_SESSION['usuario_id'], 'off');

    // Establecer el mensaje de cierre de sesión
    $_SESSION['logout_message'] = "Ha cerrado correctamente la sesión.";

    // Destruir las variables de sesión sin eliminar el mensaje de cierre de sesión
    $nombre_usuario = $_SESSION['nombre_usuario']; // Guardar el nombre de usuario para el mensaje
    unset($_SESSION['usuario_id']);
    unset($_SESSION['nombre_usuario']);
}

// Redirigir al usuario a la página de inicio de sesión con el mensaje de cierre de sesión
header("Location: ../index.php");
exit();
?>
