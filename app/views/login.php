<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Controle de Funcionários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-container h1 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            text-align: center;
            color: #343a40;
        }
        .form-group {
            margin-bottom: 15px;
          
        }
        label {
            display: block;
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 5px;
            text-align: left;
        }
        input[type="email"],
        input[type="password"] {
            width: 90%;
            padding: 8px;
            font-size: 0.9rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
            margin: 0 auto;
            display: block;
        }
        button {
            width: 95%;
            padding: 10px;
            font-size: 1rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-bottom: 10px;
            text-align: center;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.8rem;
            color: #6c757d;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Bem vindo ao sistema de funcionários!</h1>

        <?php if (isset($erro)): ?>
            <p class="error-message"><?= $erro ?></p>
        <?php endif; ?>

        <form method="POST" action="index.php?action=autenticar">
            <div class="form-group">
                <label for="login">Email:</label>
                <input type="email" id="login" name="login" required placeholder="Digite seu e-mail">
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required placeholder="Digite sua senha">
            </div>
            <button type="submit">Entrar</button>
        </form>

        <div class="footer">
            <p>Titan Software © <?= date("Y") ?>. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
