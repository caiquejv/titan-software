<?php
require_once __DIR__ . '/../models/Funcionario.php';
require_once __DIR__ . '/../libs/fpdf.php';
class FuncionarioController
{

    // Redenrizando para view de listagem de funcionarios
    public function index()
    {
        $funcionario = new Funcionario();
        $funcionarios = $funcionario->listar(); 
        require_once __DIR__ . '/../views/funcionarios.php'; 
    }
   
    // Cadastrando Funcionario
    public function cadastrarFuncionario()
    {
        $empresaModel = new Empresa(); 
        $empresas = $empresaModel->listarEmpresas(); 
        require_once __DIR__ . '/../views/cadastrar_funcionario.php'; 
    }

    // Funcão para cadastrar Funcionario
    public function cadastrarFuncionarioAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $rg = $_POST['rg'];
            $email = $_POST['email'];
            $id_empresa = $_POST['id_empresa'];
            $data_cadastro = $_POST['data_cadastro'];
            $salario = $_POST['salario'];
            $bonificacao = $_POST['bonificacao'];

            // Validação
            if (empty($data_cadastro)) {
                echo "A data de cadastro é obrigatória.";
                return;
            }

           
            $funcionario = new Funcionario();
            $funcionario->salvar($nome, $cpf, $rg, $email, $id_empresa, $data_cadastro, $salario, $bonificacao);

            // Passar a mensagem de sucesso através de GET
            header('Location: index.php?action=cadastrar_funcionario&success=true');
            exit; 
        }
    }
    // Função para editar Funcionario
    public function editar()
    {
        $id = $_GET['id'];
        $funcionario = new Funcionario();
        $funcionarioData = $funcionario->buscarPorId($id);

        $empresaModel = new Empresa();
        $empresas = $empresaModel->listarEmpresas();

        if ($funcionarioData) {
            require_once __DIR__ . '/../views/editar_funcionario.php';
        } else {
            echo "Funcionário não encontrado.";
        }
    }

    // Função para atualizar um funcionário
    public function atualizar()
    {
        $mensagem = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $rg = $_POST['rg'];
            $email = $_POST['email'];
            $id_empresa = $_POST['id_empresa'];
            $salario = $_POST['salario'];
            $bonificacao = $_POST['bonificacao'];

            $funcionario = new Funcionario();
            $atualizado = $funcionario->atualizar($id, $nome, $cpf, $rg, $email, $id_empresa, $salario, $bonificacao);

            if ($atualizado) {
                $mensagem = "Funcionário Editado com Sucesso!"; 
            } else {
                $mensagem = "Erro ao atualizar o funcionário.";
            }
        }
        $id = $_POST['id'];
        $funcionario = new Funcionario();
        $funcionarioData = $funcionario->buscarPorId($id);

        $empresaModel = new Empresa();
        $empresas = $empresaModel->listarEmpresas();
        require_once __DIR__ . '/../views/editar_funcionario.php';
    }
    // Função para excluir funcionário
    public function excluir() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $funcionario = new Funcionario();
            $excluido = $funcionario->excluir($id);
    
            if ($excluido) {
                header('Location: index.php?action=funcionarios&delete_success=true'); 
                exit;
            } else {
                echo "Erro ao excluir o funcionário."; 
            }
        } else {
            echo "ID do funcionário não especificado."; 
        }
    }

    // Função para gerar relatório em PDF
    public function gerarPdf()
{
    // Inicia o buffer de saída
    ob_start();

    // Carrega o modelo dos funcionários
    $funcionarioModel = new Funcionario();
    $funcionarios = $funcionarioModel->listar(); // Método que retorna os funcionários

    // Inicia o PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Configura o encoding para UTF-8
    $pdf->SetFont('Arial', '', 16); // Arial regular com suporte a acentos

    // Configuração do título
    $pdf->Cell(0, 10, 'Relatório de Funcionários', 0, 1, 'C');
    $pdf->Ln(10); // Aumenta o espaçamento abaixo do título

    // Definindo as larguras das colunas
    $largura = [40, 30, 30, 50, 25, 25]; // Largura das colunas (nome, cpf, rg, email, salário, bonificação)

    // Calculando a posição para centralizar a tabela
    $larguraTotal = array_sum($largura); // Soma das larguras
    $posicaoX = (210 - $larguraTotal) / 2; // Largura do PDF (210mm) menos a largura total dividida por 2

    // Define a posição inicial para a tabela
    $pdf->SetX($posicaoX);

    // Cabeçalho da tabela
    $pdf->SetFont('Arial', 'B', 12); // Arial bold nos cabeçalhos
    $pdf->Cell($largura[0], 12, 'Nome', 1, 0, 'C');
    $pdf->Cell($largura[1], 12, 'CPF', 1, 0, 'C');
    $pdf->Cell($largura[2], 12, 'RG', 1, 0, 'C');
    $pdf->Cell($largura[3], 12, 'Email', 1, 0, 'C');
    $pdf->Cell($largura[4], 12, 'Salário', 1, 0, 'C');
    $pdf->Cell($largura[5], 12, 'Bonificação', 1, 0, 'C');
    $pdf->Ln(); // Nova linha após o cabeçalho

    // Configuração da fonte para os dados
    $pdf->SetFont('Arial', '', 12); // Arial regular

    // Itera pelos funcionários para adicionar os dados na tabela
    foreach ($funcionarios as $funcionario) {
        // Cálculo da bonificação baseado no tempo de cadastro
        $dataCadastro = new DateTime($funcionario['data_cadastro']);
        $hoje = new DateTime();
        $diferenca = $hoje->diff($dataCadastro);

        $bonificacao = 0;
        if ($diferenca->y > 5) {
            $bonificacao = $funcionario['salario'] * 0.20;
        } elseif ($diferenca->y > 1) {
            $bonificacao = $funcionario['salario'] * 0.10;
        }

        // Define a posição inicial para os dados, sempre mantendo a mesma centralização
        $pdf->SetX($posicaoX);

        // Adiciona as informações dos funcionários às células da tabela
        $pdf->Cell($largura[0], 12, utf8_decode($funcionario['nome']), 1, 0, 'L');
        $pdf->Cell($largura[1], 12, utf8_decode($funcionario['cpf']), 1, 0, 'L');
        $pdf->Cell($largura[2], 12, utf8_decode($funcionario['rg']), 1, 0, 'L');
        $pdf->Cell($largura[3], 12, utf8_decode($funcionario['email']), 1, 0, 'L');
        $pdf->Cell($largura[4], 12, 'R$ ' . number_format($funcionario['salario'], 2, ',', '.'), 1, 0, 'R');
        $pdf->Cell($largura[5], 12, 'R$ ' . number_format($bonificacao, 2, ',', '.'), 1, 0, 'R');
        $pdf->Ln(); // Nova linha após os dados
    }

    // Garante que o PDF seja baixado corretamente
    ob_end_clean(); // Limpa o buffer de saída

    // Definindo a saída do PDF
    $pdf->Output('D', 'relatorio_funcionarios.pdf');
}
}
