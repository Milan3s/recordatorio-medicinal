<?php
require_once __DIR__ . '/../Modelo/DatosCorporales.php';

class DatosCorporalesControlador {
    private $modelo;

    public function __construct() {
        $this->modelo = new DatosCorporales();
    }

    public function listar() {
        return $this->modelo->obtenerTodos();
    }

    public function agregar($usuario_id, $fecha, $peso, $semana, $year) {
        return $this->modelo->agregar($usuario_id, $fecha, $peso, $semana, $year);
    }

    public function obtenerPorId($id) {
        return $this->modelo->obtenerPorId($id);
    }

    public function actualizar($id, $usuario_id, $fecha, $peso, $semana, $year) {
        return $this->modelo->actualizar($id, $usuario_id, $fecha, $peso, $semana, $year);
    }

    public function eliminar($id) {
        return $this->modelo->eliminar($id);
    }
}
?>
