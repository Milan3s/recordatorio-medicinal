<?php
require_once __DIR__ . '/../Modelo/FichaMedica.php';

class FichaControlador {
    private $fichaMedica;

    public function __construct() {
        $this->fichaMedica = new FichaMedica();
    }

    public function obtenerDatosFicha($usuario_id) {
        $datosUsuario = $this->fichaMedica->obtenerDatosUsuario($usuario_id);
        $historialMedico = $this->fichaMedica->obtenerHistorialMedico($usuario_id);
        $controlCorporal = $this->fichaMedica->obtenerControlCorporal($usuario_id);
        $tensionArterial = $this->fichaMedica->obtenerTensionArterial($usuario_id);

        return [
            'datosUsuario' => $datosUsuario,
            'historialMedico' => $historialMedico,
            'controlCorporal' => $controlCorporal,
            'tensionArterial' => $tensionArterial
        ];
    }

    public function actualizarFicha($usuario_id, $datosUsuario, $historialMedico, $controlCorporal, $tensionArterial) {
        $resultadoUsuario = $this->fichaMedica->actualizarDatosUsuario(
            $usuario_id,
            $datosUsuario['nombre'],
            $datosUsuario['edad'],
            $datosUsuario['genero'],
            $datosUsuario['telefono']
        );
    
        $resultadoHistorial = $this->fichaMedica->actualizarHistorialMedico(
            $usuario_id,
            $historialMedico['enfermedades_cronicas'],
            $historialMedico['alergias'],
            $historialMedico['medicamentos_actuales'],
            $historialMedico['observaciones']
        );
    
        $resultadoControlCorporal = $this->fichaMedica->actualizarControlCorporal(
            $usuario_id,
            $controlCorporal['peso'],
            $controlCorporal['semana'],
            $controlCorporal['year']
        );
    
        $resultadoTension = $this->fichaMedica->actualizarTensionArterial(
            $usuario_id,
            $tensionArterial['sistolica'],
            $tensionArterial['diastolica'],
            $tensionArterial['pulso']
        );
    
        // Verificar si todas las actualizaciones fueron exitosas
        return $resultadoUsuario && $resultadoHistorial && $resultadoControlCorporal && $resultadoTension;
    }
    
}
