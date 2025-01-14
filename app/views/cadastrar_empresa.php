<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Nova Empresa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 600px;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            margin-bottom: 5px;
            display: block;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 15px;
            border-radius: 4px;
            font-size: 16px;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-footer {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-secondary {
            padding: 12px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 4px;
            text-align: center;
            display: inline-block;

        }

        .btn-secondary:hover {
            background-color: #e53935;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Cadastrar Nova Empresa</h1>

        <?php if (!empty($mensagem)): ?>
            <div class="success-message"><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
        <!-- Formulário para cadstro de empresa -->
        <form action="index.php?action=cadastrar_empresa" method="POST">
            <div class="form-group">
                <label for="nome">Nome da Empresa:</label>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome da empresa" required>
            </div>

            <button type="submit">Cadastrar</button>
        </form>

        <div class="form-footer">
            <a href="index.php?action=funcionarios" class="btn-secondary">Voltar à Aba de Funcionários</a>
        </div>
    </div>
</body>

</html>