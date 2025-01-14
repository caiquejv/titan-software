<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionários</title>
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
        }

        .container {
            width: 80%;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 5px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .btn-editar:hover {
            background-color: rgb(0, 34, 187);
        }

        .btn-excluir:hover {
            background-color: rgb(255, 9, 9);
        }
    
        .btn-container {
            margin-bottom: 20px;
        }

        .btn-editar {
            background-color: #2196F3;
         
        }

        .btn-excluir {
            background-color: #F44336;
         /
        }

        .btn-pdf {
            padding: 5px 15px;
            background-color:rgb(255, 115, 34);
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn-pdf:hover {
            background-color: rgb(255, 115, 34);
        }

    </style>
</head>

<body>

    <h1>Lista de Funcionários</h1>
    <div class="btn-container">
        <a href="index.php?action=cadastrar_funcionario" class="btn">Cadastrar Funcionário</a>
        <a href="index.php?action=cadastrar_empresa" class="btn">Cadastrar Empresa</a>
        <a href="index.php?action=exportarPdf" class="btn-pdf"">Gerar PDF</a>
    </div>

    <div class=" container">
         <!-- Tabela com os dados do funcionário -->
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>Email</th>
                        <th>Empresa</th>
                        <th>Data de Cadastro</th>
                        <th>Salário</th>
                        <th>Bonificação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($funcionarios) && is_array($funcionarios)): ?>
                        <?php foreach ($funcionarios as $funcionario): ?>
                            <?php
                            // Calculando a diferença de anos entre a data de cadastro e a data atual
                            $dataCadastro = new DateTime($funcionario['data_cadastro']);
                            $hoje = new DateTime();
                            $diferenca = $hoje->diff($dataCadastro); //
                            $bonificacao = 0;
                            $classeCor = '';

                            if ($diferenca->y > 5) {
                                $bonificacao = $funcionario['salario'] * 0.20;
                                $classeCor = 'style="background-color: red;"';
                            } elseif ($diferenca->y > 1) {
                                $bonificacao = $funcionario['salario'] * 0.10;
                                $classeCor = 'style="background-color: blue;"';
                            }
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($funcionario['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($funcionario['cpf'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($funcionario['rg'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($funcionario['email'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($funcionario['empresa'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= date('d/m/Y', strtotime($funcionario['data_cadastro'])) ?></td>
                                <td>R$ <?= number_format($funcionario['salario'], 2, ',', '.') ?></td>
                                <td <?= $classeCor ?>>R$ <?= number_format($bonificacao, 2, ',', '.') ?></td> <!-- Aplica a cor apenas na célula da bonificação -->
                                <td>
                                    <a href="index.php?action=editar&id=<?php echo $funcionario['id_funcionario']; ?>" class="btn btn-editar">Editar</a>
                                    <a href="index.php?action=excluir&id=<?php echo $funcionario['id_funcionario']; ?>" class="btn btn-excluir" onclick="return confirm('Tem certeza que deseja excluir este funcionário?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
    </div>

</body>

</html>