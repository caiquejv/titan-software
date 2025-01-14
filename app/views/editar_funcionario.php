<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário</title>
    <style>
        /* (Seu CSS aqui - o mesmo da página de cadastro) */
        /* Reset e estrutura */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Formulário */
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
        button,
        a.btn-secondary {
            width: 100%;
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

        /* Botões */
        button {
            color: #fff;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #4CAF50;
            border: none;
            font-size: 16px;
            margin-top: 15px;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #f44336;
            text-align: center;
            text-decoration: none;
            border: none;
            color: #fff;
            display: inline-block;
            margin-top: 15px;
        }

        .btn-secondary:hover {
            background-color: #e53935;
        }

        /* Mensagens de sucesso e erro */
        .message {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 4px;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <h1>Editar Funcionário</h1>
    <div class="container">

        <!-- Exibição de mensagens de sucesso ou erro -->
        <?php if (isset($mensagem)): ?>
            <div class="message <?= ($mensagem == "Funcionário Editado com Sucesso!") ? 'success' : 'error'; ?>">
                <?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <!-- Formulário de edição do funcionário -->
        <?php if (isset($funcionarioData)): ?>
            <form action="index.php?action=atualizar" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($funcionarioData['id_funcionario'], ENT_QUOTES, 'UTF-8') ?>">

                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($funcionarioData['nome'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>

                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($funcionarioData['cpf'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>

                <div class="form-group">
                    <label for="rg">RG:</label>
                    <input type="text" id="rg" name="rg" value="<?= htmlspecialchars($funcionarioData['rg'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($funcionarioData['email'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>

                <div class="form-group">
                    <label for="id_empresa">Empresa:</label>
                    <select id="id_empresa" name="id_empresa" required>
                        <option value="">Selecione uma Empresa</option>
                        <?php foreach ($empresas as $empresa): ?>
                            <option value="<?= $empresa['id_empresa'] ?>" <?= $empresa['id_empresa'] == $funcionarioData['id_empresa'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($empresa['nome'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="salario">Salário:</label>
                    <input type="number" id="salario" name="salario" step="0.01" value="<?= htmlspecialchars($funcionarioData['salario'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>

                <div class="form-group">
                    <label for="bonificacao">Bonificação:</label>
                    <input type="number" id="bonificacao" name="bonificacao" step="0.01" value="<?= htmlspecialchars($funcionarioData['bonificacao'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>

                <button type="submit" class="btn-primary">Salvar Alterações</button>
            </form>
        <?php else: ?>
            <p class="no-data-message"><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

        <a href="index.php?action=funcionarios" class="btn-secondary">Voltar à Aba de Funcionários</a>
    </div>
</body>

</html>

</html>