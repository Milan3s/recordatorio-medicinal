<?php
require_once __DIR__ . '/ModeloBase.php';

class Tension extends ModeloBase {
    public function __construct() {
        parent::__construct();
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM tension";
        $resultado = $this->ejecutarConsulta($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM tension WHERE tension_id = :id";
        $params = [':id' => $id];
        $resultado = $this->ejecutarConsulta($sql, $params);
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    public function agregar($usuario_id, $fecha, $sistolica, $diastolica, $pulso) {
        $sql = "INSERT INTO tension (usuario_id, fecha, sistolica, diastolica, pulso) 
                VALUES (:usuario_id, :fecha, :sistolica, :diastolica, :pulso)";
        $params = [
            ':usuario_id' => $usuario_id,
            ':fecha' => $fecha,
            ':sistolica' => $sistolica,
            ':diastolica' => $diastolica,
            ':pulso' => $pulso
        ];
        return $this->ejecutarConsulta($sql, $params);
    }

    public function actualizar($id, $fecha, $sistolica, $diastolica, $pulso) {
        $sql = "UPDATE tension SET 
                    fecha = :fecha, 
                    sistolica = :sistolica, 
                    diastolica = :diastolica, 
                    pulso = :pulso 
                WHERE tension_id = :id";
        $params = [
            ':id' => $id,
            ':fecha' => $fecha,
            ':sistolica' => $sistolica,
            ':diastolica' => $diastolica,
            ':pulso' => $pulso
        ];
        return $this->ejecutarConsulta($sql, $params);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM tension WHERE tension_id = :id";
        $params = [':id' => $id];
        return $this->ejecutarConsulta($sql, $params);
    }
}
?>
