<?php
require_once __DIR__ . '/../Modelo/EjerciciosDiarios.php';

class EjerciciosDiariosControlador {
    private $modelo;

    public function __construct() {
        $this->modelo = new EjerciciosDiarios();
    }

    public function listar() {
        return $this->modelo->obtenerTodos();
    }

    public function obtenerPorId($id) {
        return $this->modelo->obtenerPorId($id);
    }

    public function agregar($usuario_id, $fecha, $hora_salida, $hora_llegada, $sitio_salida, $sitio_llegada , $pasos, $calorias_perdidas, $kilos_perdidos) {
        return $this->modelo->agregar($usuario_id, $fecha, $hora_salida, $hora_llegada, $sitio_salida, $sitio_llegada , $pasos, $calorias_perdidas, $kilos_perdidos);
    }

    public function actualizar($id, $usuario_id, $fecha, $hora_salida, $hora_llegada, $sitio_salida, $sitio_llegada , $pasos, $calorias_perdidas, $kilos_perdidos) {
        return $this->modelo->actualizar($id, $usuario_id, $fecha, $hora_salida, $hora_llegada, $sitio_salida, $sitio_llegada , $pasos, $calorias_perdidas, $kilos_perdidos);
    }

    public function eliminar($id) {
        return $this->modelo->eliminar($id);
    }
}
