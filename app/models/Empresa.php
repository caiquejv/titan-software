<?php
require_once __DIR__ . '/../config/database.php';

class Empresa
{    // Propriedade para armazenar a instância de conexão com o banco de dados
    private $db;

      // Construtor da classe. Estabelece a conexão com o banco de dados.
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect(); // Conexão com o banco de dados
    }
    // Função para Cadastrar Empresa
    public function cadastrar($nome)
    {
        $sql = "INSERT INTO tbl_empresa (nome) VALUES (:nome)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        return $stmt->execute();
    }

    // Função para listar Empresa
    public function listarEmpresas()
    {
        try {
            $query = "SELECT id_empresa, nome FROM tbl_empresa"; // Consulta para listar empresas
            $stmt = $this->db->query($query); // Executa a consulta
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna as empresas
        } catch (PDOException $e) {
            error_log("Erro ao listar empresas: " . $e->getMessage());
            return []; // Retorna um array vazio em caso de erro
        }
    }
}
