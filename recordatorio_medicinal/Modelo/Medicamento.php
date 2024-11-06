<?php
require_once __DIR__ . '/ModeloBase.php';

class Medicamento extends ModeloBase {
    public function __construct() {
        parent::__construct();
    }

    // Método para obtener todos los registros de medicamentos con el nombre del usuario
    public function obtenerTodos() {
        $sql = "SELECT medicamentos.*, usuarios.nombre AS usuario_nombre
                FROM medicamentos
                JOIN usuarios ON medicamentos.usuario_id = usuarios.usuario_id";
        $resultado = $this->ejecutarConsulta($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener un medicamento por ID, incluyendo el nombre del usuario
    public function obtenerPorId($id) {
        $sql = "SELECT medicamentos.*, usuarios.nombre AS usuario_nombre
                FROM medicamentos
                JOIN usuarios ON medicamentos.usuario_id = usuarios.usuario_id
                WHERE medicamento_id = :id";
        $params = [':id' => $id];
        $resultado = $this->ejecutarConsulta($sql, $params);
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    public function agregarMedicamento($marca, $cantidad_pastillas, $precio, $compras_mensuales, $medico, $usuario_id) {
        $sql = "INSERT INTO medicamentos (marca, cantidad_pastillas, precio, compras_mensuales, medico, usuario_id) 
                VALUES (:marca, :cantidad_pastillas, :precio, :compras_mensuales, :medico, :usuario_id)";
        $params = [
            ':marca' => $marca,
            ':cantidad_pastillas' => $cantidad_pastillas,
            ':precio' => $precio,
            ':compras_mensuales' => $compras_mensuales,
            ':medico' => $medico,
            ':usuario_id' => $usuario_id
        ];
        return $this->ejecutarConsulta($sql, $params);
    }

    public function actualizarMedicamento($id, $marca, $cantidad_pastillas, $precio, $compras_mensuales, $medico) {
        $sql = "UPDATE medicamentos SET 
                    marca = :marca, 
                    cantidad_pastillas = :cantidad_pastillas, 
                    precio = :precio, 
                    compras_mensuales = :compras_mensuales, 
                    medico = :medico 
                WHERE medicamento_id = :id";
        $params = [
            ':id' => $id,
            ':marca' => $marca,
            ':cantidad_pastillas' => $cantidad_pastillas,
            ':precio' => $precio,
            ':compras_mensuales' => $compras_mensuales,
            ':medico' => $medico
        ];
        return $this->ejecutarConsulta($sql, $params);
    }

    public function eliminarMedicamento($id) {
        $sql = "DELETE FROM medicamentos WHERE medicamento_id = :id";
        $params = [':id' => $id];
        return $this->ejecutarConsulta($sql, $params);
    }
}
?>
