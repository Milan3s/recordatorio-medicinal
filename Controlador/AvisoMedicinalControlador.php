<?php
require_once __DIR__ . '/../Modelo/AvisoMedicinal.php';

class AvisoMedicinalControlador
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new AvisoMedicinal();
    }

    public function listar()
    {
        $result = $this->modelo->listarAvisos();
        if ($result === false) {
            error_log("Error al listar avisos medicinales.");
            return "Error al listar avisos.";
        }
        return $result;
    }

    public function obtenerAvisoPorId($id)
    {
        $result = $this->modelo->obtenerAvisoPorId($id);
        if ($result === false) {
            error_log("Error al obtener el aviso por ID.");
            return "Error al obtener el aviso.";
        }
        return $result;
    }

    public function agregarAviso($usuario_id, $fecha, $hora, $mes, $toma, $medicamento_id)
    {
        // Convertir a formato completo de fecha
        $mesCompleto = $mes . "-01";

        return $this->modelo->agregarAviso($usuario_id, $fecha, $hora, $mesCompleto, $toma, $medicamento_id);
    }

    public function actualizarAviso($id, $fecha, $hora, $mes, $toma, $medicamento_id)
    {
        $mesCompleto = $mes . "-01"; // Convertir a YYYY-MM-DD

        return $this->modelo->actualizarAviso($id, $fecha, $hora, $mesCompleto, $toma, $medicamento_id);
    }

    public function eliminarAviso($id)
    {
        return $this->modelo->eliminarAviso($id);
    }
}
