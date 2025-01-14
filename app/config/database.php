<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'funcionariosphp';
    private $user = 'root'; 
    private $password = ''; 
    public $conn;
   
    // Conectando ao banco de dados
    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }

        return $this->conn;
    }
}
