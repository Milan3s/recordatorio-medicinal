<?php
require_once __DIR__ . '/ModeloBase.php';

class FichaMedica extends ModeloBase {
    public function __construct() {
        parent::__construct();
    }

    // Método para obtener los datos de un usuario en particular
    public function obtenerDatosUsuario($usuario_id) {
        $sql = "SELECT nombre, edad, genero, telefono FROM usuarios WHERE usuario_id = :usuario_id";
        $stmt = $this->ejecutarConsulta($sql, [':usuario_id' => $usuario_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para obtener el historial médico del usuario
    public function obtenerHistorialMedico($usuario_id) {
        $sql = "SELECT enfermedades_cronicas, alergias, medicamentos_actuales, observaciones FROM historial_medico WHERE usuario_id = :usuario_id";
        $stmt = $this->ejecutarConsulta($sql, [':usuario_id' => $usuario_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para obtener los datos de control corporal del usuario
    public function obtenerControlCorporal($usuario_id) {
        $sql = "SELECT peso, semana, year FROM control_corporal WHERE usuario_id = :usuario_id ORDER BY fecha DESC LIMIT 1";
        $stmt = $this->ejecutarConsulta($sql, [':usuario_id' => $usuario_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para obtener los datos de tensión arterial del usuario
    public function obtenerTensionArterial($usuario_id) {
        $sql = "SELECT sistolica, diastolica, pulso FROM tension WHERE usuario_id = :usuario_id ORDER BY fecha DESC LIMIT 1";
        $stmt = $this->ejecutarConsulta($sql, [':usuario_id' => $usuario_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Métodos de actualización

    public function actualizarDatosUsuario($usuario_id, $nombre, $edad, $genero, $telefono, $foto) {
        $sql = "UPDATE usuarios SET nombre = :nombre, edad = :edad, genero = :genero, telefono = :telefono = WHERE usuario_id = :usuario_id";
        return $this->ejecutarConsulta($sql, [
            ':usuario_id' => $usuario_id,
            ':nombre' => $nombre,
            ':edad' => $edad,
            ':genero' => $genero,
            ':telefono' => $telefono
        ]);
    }

    public function actualizarHistorialMedico($usuario_id, $enfermedades_cronicas, $alergias, $medicamentos_actuales, $observaciones) {
        $sql = "UPDATE historial_medico SET enfermedades_cronicas = :enfermedades, alergias = :alergias, medicamentos_actuales = :medicamentos, observaciones = :observaciones WHERE usuario_id = :usuario_id";
        return $this->ejecutarConsulta($sql, [
            ':usuario_id' => $usuario_id,
            ':enfermedades' => $enfermedades_cronicas,
            ':alergias' => $alergias,
            ':medicamentos' => $medicamentos_actuales,
            ':observaciones' => $observaciones
        ]);
    }

    public function actualizarControlCorporal($usuario_id, $peso, $semana, $year) {
        $sql = "UPDATE control_corporal SET peso = :peso, semana = :semana, year = :year WHERE usuario_id = :usuario_id ORDER BY fecha DESC LIMIT 1";
        return $this->ejecutarConsulta($sql, [
            ':usuario_id' => $usuario_id,
            ':peso' => $peso,
            ':semana' => $semana,
            ':year' => $year
        ]);
    }

    public function actualizarTensionArterial($usuario_id, $sistolica, $diastolica, $pulso) {
        $sql = "UPDATE tension SET sistolica = :sistolica, diastolica = :diastolica, pulso = :pulso WHERE usuario_id = :usuario_id ORDER BY fecha DESC LIMIT 1";
        return $this->ejecutarConsulta($sql, [
            ':usuario_id' => $usuario_id,
            ':sistolica' => $sistolica,
            ':diastolica' => $diastolica,
            ':pulso' => $pulso
        ]);
    }
}
