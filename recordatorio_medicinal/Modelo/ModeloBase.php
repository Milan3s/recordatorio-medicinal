<?php
require_once __DIR__ . '/../Configuracion/base_datos.php';

class ModeloBase {
    protected $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->conectar();
    }

    protected function ejecutarConsulta($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
?>
