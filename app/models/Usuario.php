<?php
// Classe responsável pela gestão do usuário (login, validação, etc)
class Usuario
{

    private $db;

    // Construtor da classe. Estabelece a conexão com o banco de dados.
    public function __construct()
    {
        // Instancia a classe Database para obter a conexão com o banco
        $database = new Database();


        $this->db = $database->connect();
    }

    // Método para realizar o login do usuário. Verifica se o login e a senha são válidos.
    public function login($login, $senha)
    {
        // Query SQL para selecionar o usuário, com a senha criptografada (MD5) para comparação
        $sql = "SELECT * FROM tbl_usuario WHERE login = :login AND senha = MD5(:senha)";


        $stmt = $this->db->prepare($sql);


        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha);

        // Executa a query no banco de dados
        $stmt->execute();


        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
