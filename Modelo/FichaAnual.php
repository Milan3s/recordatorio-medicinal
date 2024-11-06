<?php
require_once __DIR__ . '/../Modelo/ModeloBase.php';

class FichaAnual extends ModeloBase {
    public function obtenerFichaAnual($usuario_id, $year) {
        $sql = "SELECT 
                    YEAR(fecha) AS year,
                    COUNT(ejercicio_id) AS total_sesiones,
                    SUM(pasos) AS total_pasos,
                    SUM(calorias_perdidas) AS total_calorias,
                    SUM(kilos_perdidos) AS total_kilos_perdidos
                FROM 
                    registro_ejercicio
                WHERE 
                    usuario_id = :usuario_id AND YEAR(fecha) = :year
                GROUP BY 
                    YEAR(fecha)";
        
        try {
            $params = [
                ':usuario_id' => $usuario_id,
                ':year' => $year
            ];
            $stmt = $this->ejecutarConsulta($sql, $params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar el error de conexión o consulta
            error_log("Error al obtener la ficha anual: " . $e->getMessage());
            return false;
        }
    }
}
?>
