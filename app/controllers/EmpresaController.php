<?php
require_once __DIR__ . '/../models/Empresa.php';

class EmpresaController {
    
    //Função para cadastro de empresa
    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];

            // Validações
            if (empty($nome)) {
                $mensagem = 'O nome da empresa é obrigatório!';
                include __DIR__ . '/../views/cadastrar.php';
                return;
            }

           
            $empresaModel = new Empresa();
            $empresaModel->cadastrar($nome);

            
            $mensagem = 'Empresa cadastrada com sucesso!';
            include __DIR__ . '/../views/cadastrar_empresa.php';
            return;
        }
        include __DIR__ . '/../views/cadastrar_empresa.php';
    }
}
