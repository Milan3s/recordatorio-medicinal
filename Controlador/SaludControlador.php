<?php
require_once __DIR__ . '/../Model/SaludModelo.php';

class TensionControlador {
    private $model;

    public function __construct() {
        $this->model = new TensionModel();
    }

    public function listar() {
        return $this->model->listar();
    }

    public function agregar($usuario_id, $fecha, $sistolica, $diastolica, $pulso) {
        return $this->model->agregar($usuario_id, $fecha, $sistolica, $diastolica, $pulso);
    }

    public function obtenerPorId($tension_id) {
        return $this->model->obtenerPorId($tension_id);
    }

    public function actualizar($tension_id, $fecha, $sistolica, $diastolica, $pulso) {
        return $this->model->actualizar($tension_id, $fecha, $sistolica, $diastolica, $pulso);
    }

    public function eliminar($tension_id) {
        return $this->model->eliminar($tension_id);
    }
}
