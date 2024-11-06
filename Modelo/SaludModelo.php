<?php
require_once 'Database.php';

class TensionModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function listar() {
        $query = "SELECT * FROM tension";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregar($usuario_id, $fecha, $sistolica, $diastolica, $pulso) {
        $query = "INSERT INTO tension (usuario_id, fecha, sistolica, diastolica, pulso) VALUES (:usuario_id, :fecha, :sistolica, :diastolica, :pulso)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':sistolica', $sistolica);
        $stmt->bindParam(':diastolica', $diastolica);
        $stmt->bindParam(':pulso', $pulso);
        return $stmt->execute();
    }

    public function obtenerPorId($tension_id) {
        $query = "SELECT * FROM tension WHERE tension_id = :tension_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':tension_id', $tension_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($tension_id, $fecha, $sistolica, $diastolica, $pulso) {
        $query = "UPDATE tension SET fecha = :fecha, sistolica = :sistolica, diastolica = :diastolica, pulso = :pulso WHERE tension_id = :tension_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':tension_id', $tension_id);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':sistolica', $sistolica);
        $stmt->bindParam(':diastolica', $diastolica);
        $stmt->bindParam(':pulso', $pulso);
        return $stmt->execute();
    }

    public function eliminar($tension_id) {
        $query = "DELETE FROM tension WHERE tension_id = :tension_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':tension_id', $tension_id);
        return $stmt->execute();
    }
}
