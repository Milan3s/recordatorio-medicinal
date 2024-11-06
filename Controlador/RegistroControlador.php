<?php
require_once __DIR__ . '/../Modelo/ModeloBase.php';

class RegistroControlador extends ModeloBase {
    public function registrarUsuario($nombre, $email, $password) {
        // Encriptar la contraseña antes de guardarla
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta SQL
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
        $stmt = $this->db->prepare($sql);

        // Asignar los valores a los parámetros de la consulta
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        // Ejecutar la consulta y manejar el resultado
        if ($stmt->execute()) {
            return true; // Registro exitoso
        } else {
            return false; // Error en el registro
        }
    }
}
