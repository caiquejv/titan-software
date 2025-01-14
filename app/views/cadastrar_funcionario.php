<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 50%;
            padding: 20px;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: bold;
        }

        input,
        select,
        button {
            width: 100%;
            /* Faz todos os elementos terem o mesmo tamanho */
            height: 45px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input:focus,
        select:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            color: #fff;
            background-color: #4CAF50;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        a.btn {
            margin-top: 20px;
            background-color: #f44336;
            text-align: center;
            text-decoration: none;
            padding: 12px;
            border-radius: 5px;
            color: #fff;
            display: inline-block;
            width: auto;
           
        }

        a.btn:hover {
            background-color: #e53935;
        }

        /* Mensagens de sucesso */
        .success-message {
            text-align: center;
            font-size: 14px;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Cadastrar Funcionário</h1>
        <!-- Exibição de mensagens de sucesso -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true') : ?>
            <div class="success-message">
                Funcionário Cadastrado com Sucesso!
            </div>
        <?php endif; ?>
        <!-- Formulário de cadastro do funcionário -->
        <form action="index.php?action=salvar_funcionario" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required>
            </div>

            <div class="form-group">
                <label for="rg">RG:</label>
                <input type="text" id="rg" name="rg" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="id_empresa">Empresa:</label>
                <select id="id_empresa" name="id_empresa" required>
                    <option value="">Selecione uma Empresa</option>
                    <?php if (isset($empresas) && is_array($empresas)) : ?>
                        <?php foreach ($empresas as $empresa) : ?>
                            <option value="<?= $empresa['id_empresa'] ?>">
                                <?= htmlspecialchars($empresa['nome'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <option value="">Nenhuma empresa cadastrada</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="data_cadastro">Data de Cadastro:</label>
                <input type="date" id="data_cadastro" name="data_cadastro" required>
            </div>

            <div class="form-group">
                <label for="salario">Salário:</label>
                <input type="number" id="salario" name="salario" step="0.01" required>
            </div>

            <button type="submit">Cadastrar Funcionário</button>
        </form>

        <a href="index.php?action=funcionarios" class="btn">Voltar à Aba de Funcionários</a>
    </div>
</body>

</html>