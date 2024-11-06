<?php
require_once __DIR__ . '/ModeloBase.php';

class PerfilUsuario extends ModeloBase {
    public function __construct() {
        parent::__construct();
    }

    // Método para obtener el perfil de un usuario por ID, incluyendo el rol
    public function obtenerPerfil($usuario_id) {
        $sql = "SELECT usuarios.*, roles.nombre_rol 
                FROM usuarios 
                LEFT JOIN roles ON usuarios.rol_id = roles.rol_id 
                WHERE usuarios.usuario_id = :usuario_id";
        return $this->ejecutarConsulta($sql, [':usuario_id' => $usuario_id])->fetch(PDO::FETCH_ASSOC);
    }

    // Método para obtener todos los roles disponibles
    public function obtenerRoles() {
        $sql = "SELECT rol_id, nombre_rol FROM roles";
        return $this->ejecutarConsulta($sql)->fetchAll(PDO::FETCH_ASSOC);
    }


    // Método para crear un nuevo perfil de usuario
    public function crearPerfil($datos) {
        $sql = "INSERT INTO usuarios (nombre, email, telefono) VALUES (:nombre, :email, :telefono)";
        return $this->ejecutarConsulta($sql, $datos);
    }

    // Método para actualizar el perfil de un usuario
    public function actualizarPerfil($usuario_id, $datos) {
        $sql = "UPDATE usuarios SET nombre = :nombre, email = :email, telefono = :telefono, rol_id = :rol_id 
                WHERE usuario_id = :usuario_id";
        $datos[':usuario_id'] = $usuario_id;
        return $this->ejecutarConsulta($sql, $datos);
    }

    // Método para eliminar el perfil de un usuario
    public function eliminarPerfil($usuario_id) {
        $sql = "DELETE FROM usuarios WHERE usuario_id = :usuario_id";
        return $this->ejecutarConsulta($sql, [':usuario_id' => $usuario_id]);
    }
}
