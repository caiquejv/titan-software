<?php
// Inclusão dos controladores principais da aplicação.
require_once __DIR__ . '/app/controllers/LoginController.php';
require_once __DIR__ . '/app/controllers/FuncionarioController.php';
require_once __DIR__ . '/app/controllers/EmpresaController.php';

// Define a ação que foi passada pela URL ou, caso não exista, define 'login' como ação padrão.
$action = $_GET['action'] ?? 'login';

// Dependendo da ação, um controlador diferente será instanciado e seu método correspondente será executado.
switch ($action) {
    case 'login': // Quando a ação for 'login', chama o método index do LoginController para exibir a tela de login.
        $controller = new LoginController();
        $controller->index();
        break;

    case 'autenticar': // Quando a ação for 'autenticar', o LoginController irá autenticar o usuário.
        $controller = new LoginController();
        $controller->autenticar();
        break;

    case 'funcionarios': // Ação 'funcionarios' irá exibir a listagem de funcionários através do FuncionarioController.
        $controller = new FuncionarioController();
        $controller->index();
        break;

    case 'cadastrar_funcionario': // Exibe o formulário de cadastro de funcionário.
        $controller = new FuncionarioController();
        $controller->cadastrarFuncionario ();  
        break;

    case 'salvar_funcionario': // Ação para salvar um novo funcionário após o preenchimento do formulário de cadastro.
        $controller = new FuncionarioController();
        $controller->cadastrarFuncionarioAction(); 
        break;

    case 'cadastrar_empresa': // Ação 'cadastrar_empresa' chama o método 'cadastrar' do EmpresaController, que exibe o formulário de cadastro de empresas.
        $controller = new EmpresaController();  
        $controller->cadastrar(); 
        break;

    case 'salvar_empresa': // Quando salvar uma nova empresa, executa o mesmo método 'cadastrar' do EmpresaController, pois o comportamento de salvar e exibir o formulário pode ser o mesmo.
        $controller = new EmpresaController();
        $controller->cadastrar(); 
        break;

    case 'editar': // Caso de edição de funcionário, chama o método 'editar' no FuncionarioController.
        $controller = new FuncionarioController();
        $controller->editar();
        break;

    case 'atualizar': // Atualiza um funcionário, chamando o método 'atualizar' no FuncionarioController.
        $controller = new FuncionarioController();
        $controller->atualizar();
        break;

    case 'excluir': // Ação de excluir um funcionário. O método 'excluir' no FuncionarioController é responsável por remover o funcionário.
        $controller = new FuncionarioController();
        $controller->excluir();
        break;

    case 'exportarPdf': // Gera um PDF com os dados do funcionário.
        $controller = new FuncionarioController(); 
        $controller->gerarPdf(); 
        break;

    default: // Caso a ação não corresponda a nenhum dos casos definidos, exibe uma mensagem de erro.
        echo "Ação inválida!";
        break;
}
