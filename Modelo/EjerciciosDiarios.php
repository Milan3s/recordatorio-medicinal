<?php
require_once __DIR__ . '/ModeloBase.php';

class EjerciciosDiarios extends ModeloBase {
    public function __construct() {
        parent::__construct();
    }

    // Obtener todos los registros de ejercicios con el nombre del usuario
    public function obtenerTodos() {
        $sql = "SELECT registro_ejercicio.*, usuarios.nombre AS usuario_nombre
                FROM registro_ejercicio
                JOIN usuarios ON registro_ejercicio.usuario_id = usuarios.usuario_id";
        return $this->ejecutarConsulta($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un ejercicio por ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM registro_ejercicio WHERE ejercicio_id = :id";
        return $this->ejecutarConsulta($sql, [':id' => $id])->fetch(PDO::FETCH_ASSOC);
    }

    // Agregar un nuevo ejercicio
    public function agregar($usuario_id, $fecha, $hora_salida, $hora_llegada, $sitio_salida, $sitio_llegada ,$pasos, $calorias_perdidas, $kilos_perdidos) {
        $sql = "INSERT INTO registro_ejercicio (usuario_id, fecha, hora_salida, hora_llegada, sitio_salida, sitio_llegada, pasos, calorias_perdidas, kilos_perdidos)
                VALUES (:usuario_id, :fecha, :hora_salida, :hora_llegada, :sitio_salida, :sitio_llegada, :pasos, :calorias_perdidas, :kilos_perdidos)";
        $params = [
            ':usuario_id' => $usuario_id,
            ':fecha' => $fecha,
            ':hora_salida' => $hora_salida,
            ':hora_llegada' => $hora_llegada,
            ':sitio_salida' => $sitio_salida,
            ':sitio_llegada' => $sitio_llegada,
            ':pasos' => $pasos,
            ':calorias_perdidas' => $calorias_perdidas,
            ':kilos_perdidos' => $kilos_perdidos
        ];
        return $this->ejecutarConsulta($sql, $params);
    }

    // Actualizar un ejercicio existente
    public function actualizar($id, $usuario_id, $fecha, $hora_salida, $hora_llegada, $sitio_salida, $sitio_llegada , $pasos, $calorias_perdidas, $kilos_perdidos) {
        $sql = "UPDATE registro_ejercicio SET 
                    usuario_id = :usuario_id, 
                    fecha = :fecha, 
                    hora_salida = :hora_salida, 
                    hora_llegada = :hora_llegada, 
                    sitio_salida = :sitio_salida, 
                    sitio_llegada = :sitio_llegada, 
                    pasos = :pasos, 
                    calorias_perdidas = :calorias_perdidas, 
                    kilos_perdidos = :kilos_perdidos 
                WHERE ejercicio_id = :id";
        $params = [
            ':id' => $id,
            ':usuario_id' => $usuario_id,
            ':fecha' => $fecha,
            ':hora_salida' => $hora_salida,
            ':hora_llegada' => $hora_llegada,
            ':sitio_salida' => $sitio_salida,
            ':sitio_llegada' => $sitio_llegada,
            ':pasos' => $pasos,
            ':calorias_perdidas' => $calorias_perdidas,
            ':kilos_perdidos' => $kilos_perdidos
        ];
        return $this->ejecutarConsulta($sql, $params);
    }

    // Eliminar un ejercicio
    public function eliminar($id) {
        $sql = "DELETE FROM registro_ejercicio WHERE ejercicio_id = :id";
        return $this->ejecutarConsulta($sql, [':id' => $id]);
    }
}
