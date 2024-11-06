<?php
require_once __DIR__ . '/../Modelo/ModeloBase.php';

class LoginControlador extends ModeloBase {
    public function verificarLogin($nombre, $password) {
        // Preparar la consulta SQL para buscar al usuario por su nombre
        $sql = "SELECT * FROM usuarios WHERE nombre = :nombre";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y si la contraseña es correcta
        if ($usuario && password_verify($password, $usuario['password'])) {
            // Guardar el usuario_id y nombre del usuario en la sesión
            $_SESSION['usuario_id'] = $usuario['usuario_id'];
            $_SESSION['nombre_usuario'] = $usuario['nombre'];

            // Actualizar el estado del usuario a 'on' en la base de datos
            $this->actualizarEstado($usuario['usuario_id'], 'on');

            return true; // Inicio de sesión exitoso
        } else {
            return false; // Error en las credenciales
        }
    }

    private function actualizarEstado($usuario_id, $estado) {
        $sql = "UPDATE usuarios SET estado = :estado WHERE usuario_id = :usuario_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
    }
}
?>
