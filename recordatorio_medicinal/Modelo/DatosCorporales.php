<?php
require_once __DIR__ . '/ModeloBase.php';

class DatosCorporales extends ModeloBase {
    public function __construct() {
        parent::__construct();
    }

    // Método para obtener todos los registros de control corporal con el nombre del usuario
    public function obtenerTodos() {
        $sql = "SELECT control_corporal.*, usuarios.nombre AS usuario_nombre
                FROM control_corporal
                JOIN usuarios ON control_corporal.usuario_id = usuarios.usuario_id";
        $resultado = $this->ejecutarConsulta($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener un registro por ID incluyendo el nombre del usuario
    public function obtenerPorId($id) {
        $sql = "SELECT control_corporal.*, usuarios.nombre AS usuario_nombre
                FROM control_corporal
                JOIN usuarios ON control_corporal.usuario_id = usuarios.usuario_id
                WHERE control_corporal.control_id = :id";
        $params = [':id' => $id];
        $resultado = $this->ejecutarConsulta($sql, $params);
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    // Método para agregar un registro
    public function agregar($usuario_id, $fecha, $peso, $semana, $year) {
        $sql = "INSERT INTO control_corporal (usuario_id, fecha, peso, semana, year) 
                VALUES (:usuario_id, :fecha, :peso, :semana, :year)";
        $params = [
            ':usuario_id' => $usuario_id,
            ':fecha' => $fecha,
            ':peso' => $peso,
            ':semana' => $semana,
            ':year' => $year
        ];
        return $this->ejecutarConsulta($sql, $params);
    }

    // Método para actualizar un registro
    public function actualizar($id, $usuario_id, $fecha, $peso, $semana, $year) {
        $sql = "UPDATE control_corporal SET 
                    usuario_id = :usuario_id, 
                    fecha = :fecha, 
                    peso = :peso, 
                    semana = :semana, 
                    year = :year 
                WHERE control_id = :id";
        $params = [
            ':id' => $id,
            ':usuario_id' => $usuario_id,
            ':fecha' => $fecha,
            ':peso' => $peso,
            ':semana' => $semana,
            ':year' => $year
        ];
        return $this->ejecutarConsulta($sql, $params);
    }

    // Método para eliminar un registro
    public function eliminar($id) {
        $sql = "DELETE FROM control_corporal WHERE control_id = :id";
        $params = [':id' => $id];
        return $this->ejecutarConsulta($sql, $params);
    }
}
?>
