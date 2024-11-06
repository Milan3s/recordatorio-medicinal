<?php
class Database {
    private $host = '192.168.18.120';
    private $port = '3308';
    private $db_name = 'recordatorio_medicinal';
    private $username = 'root';
    private $password = 'milanes';
    private $conn;

    // Método para establecer la conexión
    public function conectar() {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name;
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }

        return $this->conn;
    }

    // Método para probar la conexión
    public function probarConexion() {
        if ($this->conectar()) {
            echo "Conexión a la base de datos establecida correctamente.";
        } else {
            echo "No se pudo establecer la conexión a la base de datos.";
        }
    }
}

// Crear instancia y probar la conexión
/*$db = new Database();
$db->probarConexion();*/
