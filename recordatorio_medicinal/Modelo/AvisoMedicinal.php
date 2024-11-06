<?php
require_once __DIR__ . '/ModeloBase.php';

class AvisoMedicinal extends ModeloBase
{
    protected $table = 'tomar_medicinas';

    // Método para listar avisos
    public function listarAvisos()
    {
        $sql = "
            SELECT 
                tm.id,
                tm.fecha,
                tm.hora,
                tm.mes,
                tm.toma,
                m.marca AS medicamento_nombre,
                m.medicamento_id,
                u.nombre AS usuario_nombre
            FROM tomar_medicinas tm
            JOIN medicamentos m ON tm.medicamento_id = m.medicamento_id
            JOIN usuarios u ON tm.usuario_id = u.usuario_id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener un aviso por ID
    public function obtenerAvisoPorId($id)
    {
        $sql = "
            SELECT 
                tm.id,
                tm.fecha,
                tm.hora,
                tm.mes,
                tm.toma,
                tm.medicamento_id,
                m.marca AS medicamento_nombre,
                u.nombre AS usuario_nombre
            FROM tomar_medicinas tm
            JOIN medicamentos m ON tm.medicamento_id = m.medicamento_id
            JOIN usuarios u ON tm.usuario_id = u.usuario_id
            WHERE tm.id = :id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para agregar un aviso
    public function agregarAviso($usuario_id, $fecha, $hora, $mes, $toma, $medicamento_id)
    {
        $sql = "
            INSERT INTO tomar_medicinas (usuario_id, fecha, hora, mes, toma, medicamento_id)
            VALUES (:usuario_id, :fecha, :hora, :mes, :toma, :medicamento_id)
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora', $hora);
        $stmt->bindParam(':mes', $mes); // Convertido a YYYY-MM-DD en el controlador
        $stmt->bindParam(':toma', $toma);
        $stmt->bindParam(':medicamento_id', $medicamento_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Método para actualizar un aviso
    public function actualizarAviso($id, $fecha, $hora, $mes, $toma, $medicamento_id)
    {
        $sql = "
            UPDATE tomar_medicinas 
            SET fecha = :fecha, hora = :hora, mes = :mes, toma = :toma, medicamento_id = :medicamento_id
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora', $hora);
        $stmt->bindParam(':mes', $mes);
        $stmt->bindParam(':toma', $toma);
        $stmt->bindParam(':medicamento_id', $medicamento_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Método para eliminar un aviso
    public function eliminarAviso($id)
    {
        $sql = "DELETE FROM tomar_medicinas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
