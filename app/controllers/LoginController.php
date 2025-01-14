<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';

class LoginController {
    public function index() {
        include __DIR__ . '/../views/login.php';
    }
    // Função para autenticar o usuário
    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'] ?? '';
            $senha = $_POST['senha'] ?? '';

            if (filter_var($login, FILTER_VALIDATE_EMAIL) && !empty($senha)) {
                $usuarioModel = new Usuario();
                $usuario = $usuarioModel->login($login, $senha);
                var_dump($usuario);
                if ($usuario) {
                    // Sucesso no login
                    header('Location: index.php?action=funcionarios');  
                    exit;
                } else {
                    $erro = "Usuário ou senha inválidos!";
                }
            } else {
                $erro = "Preencha todos os campos corretamente!";
            }
        }

        include __DIR__ . '/../views/login.php';  
    }
}
?>
