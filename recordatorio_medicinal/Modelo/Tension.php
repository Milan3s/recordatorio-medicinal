<?php
require_once __DIR__ . '/ModeloBase.php';

class Tension extends ModeloBase {
    public function __construct() {
        parent::__construct();
    }

    // Método para listar todos los registros de tensión con el nombre del usuario
    public function obtenerTodos() {
        $sql = "SELECT tension.*, usuarios.nombre AS usuario_nombre
                FROM tension
                JOIN usuarios ON tension.usuario_id = usuarios.usuario_id";
        $resultado = $this->ejecutarConsulta($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener un registro por ID incluyendo el nombre del usuario
    public function obtenerPorId($id) {
        $sql = "SELECT tension.*, usuarios.nombre AS usuario_nombre
                FROM tension
                JOIN usuarios ON tension.usuario_id = usuarios.usuario_id
                WHERE tension.tension_id = :id";
        $params = [':id' => $id];
        $resultado = $this->ejecutarConsulta($sql, $params);
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    // Método para actualizar un registro
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

    // Método para eliminar un registro
    public function eliminarTension($id) {
        $sql = "DELETE FROM tension WHERE tension_id = :id";
        $params = [':id' => $id];
        return $this->ejecutarConsulta($sql, $params);
    }

    // Método para insertar un nuevo registro de tensión
    public function insertarRegistroDeTension($usuario_id, $fecha, $sistolica, $diastolica, $pulso) {
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
}
?>
