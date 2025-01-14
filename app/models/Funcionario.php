<?php

require_once __DIR__ . '/../config/database.php';

class Funcionario
{
    // Propriedade para armazenar a instância de conexão com o banco de dados
    private $db;

    // Construtor da classe. Estabelece a conexão com o banco de dados.
    public function __construct()
    {
       
        $database = new Database();
        $this->db = $database->connect();
    }

    // Função para salvar os dados de um novo funcionário no banco de dados
    // Ela também calcula a bonificação do funcionário com base no tempo de empresa

    
    public function salvar($nome, $cpf, $rg, $email, $id_empresa, $data_cadastro, $salario, $bonificacao)
    {
        $bonificacaoCalculada = $this->calcularBonificacao($data_cadastro, $salario);

        $query = "INSERT INTO tbl_funcionario (nome, cpf, rg, email, id_empresa, data_cadastro, salario, bonificacao) 
                  VALUES (:nome, :cpf, :rg, :email, :id_empresa, :data_cadastro, :salario, :bonificacao)";

     
        $stmt = $this->db->prepare($query);

      
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':rg', $rg);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id_empresa', $id_empresa);
        $stmt->bindParam(':data_cadastro', $data_cadastro);
        $stmt->bindParam(':salario', $salario);
        $stmt->bindParam(':bonificacao', $bonificacaoCalculada);

        return $stmt->execute();
    }

    // Função para listar todos os funcionários, incluindo o nome da empresa associada
    public function listar()
    {
        try {
          
            $query = "SELECT f.*, e.nome AS empresa 
                      FROM tbl_funcionario f
                      INNER JOIN tbl_empresa e ON f.id_empresa = e.id_empresa";

           
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
        
            error_log("Erro ao listar funcionários: " . $e->getMessage());
            return [];
        }
    }

    // Função para buscar um funcionário específico pelo ID
    public function buscarPorId($id)
    {
       
        $query = "SELECT * FROM tbl_funcionario WHERE id_funcionario = :id";

      
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Função para atualizar os dados de um funcionário
    public function atualizar($id, $nome, $cpf, $rg, $email, $id_empresa, $salario, $bonificacao)
    {
       
        $query = "UPDATE tbl_funcionario SET nome = :nome, cpf = :cpf, rg = :rg, email = :email, 
                  id_empresa = :id_empresa, salario = :salario, bonificacao = :bonificacao 
                  WHERE id_funcionario = :id";

        // Prepara a query para execução
        $stmt = $this->db->prepare($query);

      
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':rg', $rg);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id_empresa', $id_empresa);
        $stmt->bindParam(':salario', $salario);
        $stmt->bindParam(':bonificacao', $bonificacao);

       
        return $stmt->execute();
    }

    // Função para excluir um funcionário com base no ID
    public function excluir($id)
    {
       
        $query = "DELETE FROM tbl_funcionario WHERE id_funcionario = :id";

      
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

       
        return $stmt->execute();
    }

    // Função para calcular a bonificação com base na data de cadastro e salário
    public function calcularBonificacao($data_cadastro, $salario)
    {
       
        $data_cadastro = new DateTime($data_cadastro);

      
        $hoje = new DateTime();

      
        $intervalo = $hoje->diff($data_cadastro);

       
        $anosDeEmpresa = $intervalo->y;

        
        if ($anosDeEmpresa > 5) {
            return $salario * 0.20;
        } 
        
        elseif ($anosDeEmpresa > 1) {
            return $salario * 0.10;
        }
        
        
        return 0;
    }
}
?>
