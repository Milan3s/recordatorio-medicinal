<?php
require_once __DIR__ . '/../Modelo/Tension.php';

class TensionControlador {
    private $modelo;

    public function __construct() {
        $this->modelo = new Tension();
    }

    // Método para listar todos los registros
    public function listar() {
        return $this->modelo->obtenerTodos();
    }

    // Método para obtener un registro por ID
    public function obtenerPorId($id) {
        return $this->modelo->obtenerPorId($id);
    }

    // Método para actualizar un registro
    public function actualizar($id, $fecha, $sistolica, $diastolica, $pulso) {
        return $this->modelo->actualizar($id, $fecha, $sistolica, $diastolica, $pulso);
    }

    // Método para eliminar un registro
    public function eliminar($id) {
        return $this->modelo->eliminar($id);
    }

    // Método para insertar un nuevo registro de tensión
    public function insertarRegistroDeTension($usuario_id, $fecha, $sistolica, $diastolica, $pulso) {
        return $this->modelo->insertarRegistroDeTension($usuario_id, $fecha, $sistolica, $diastolica, $pulso);
    }
}
