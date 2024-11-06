<?php
require_once __DIR__ . '/../Modelo/PerfilUsuario.php';

class PerfilUsuarioControlador {
    private $perfilUsuario;

    public function __construct() {
        $this->perfilUsuario = new PerfilUsuario();
    }

    public function obtenerPerfil($usuario_id) {
        return $this->perfilUsuario->obtenerPerfil($usuario_id);
    }

    public function crearPerfil($datos) {
        return $this->perfilUsuario->crearPerfil($datos);
    }

    public function actualizarPerfil($usuario_id, $datos) {
        return $this->perfilUsuario->actualizarPerfil($usuario_id, $datos);
    }

    public function eliminarPerfil($usuario_id) {
        return $this->perfilUsuario->eliminarPerfil($usuario_id);
    }

    // Método para obtener todos los roles disponibles
    public function obtenerRoles() {
        return $this->perfilUsuario->obtenerRoles();
    }
}
