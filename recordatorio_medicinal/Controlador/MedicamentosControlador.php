<?php
require_once __DIR__ . '/../Modelo/Medicamento.php';

class MedicamentosControlador {
    private $medicamentoModel;

    public function __construct() {
        $this->medicamentoModel = new Medicamento();
    }

    public function listarMedicamentos() {
        return $this->medicamentoModel->obtenerTodos();
    }

    public function agregarMedicamento($marca, $cantidad_pastillas, $precio, $compras_mensuales, $medico) {
        $usuario_id = $_SESSION['usuario_id'];
        return $this->medicamentoModel->agregarMedicamento($marca, $cantidad_pastillas, $precio, $compras_mensuales, $medico, $usuario_id);
    }

    // Método para obtener el detalle de un medicamento por ID, incluyendo el nombre del usuario
    public function obtenerMedicamentoPorId($id) {
        return $this->medicamentoModel->obtenerPorId($id);
    }

    public function actualizarMedicamento($id, $marca, $cantidad_pastillas, $precio, $compras_mensuales, $medico) {
        return $this->medicamentoModel->actualizarMedicamento($id, $marca, $cantidad_pastillas, $precio, $compras_mensuales, $medico);
    }

    public function eliminarMedicamento($id) {
        return $this->medicamentoModel->eliminarMedicamento($id);
    }
}
?>
