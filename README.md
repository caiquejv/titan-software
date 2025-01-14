# Sistema de Controle de Funcionários

Este projeto é um **sistema de controle de funcionários** desenvolvido em PHP com a arquitetura **MVC** (Model-View-Controller), utilizando **MySQL** como banco de dados. A funcionalidade principal é permitir o cadastro, edição, listagem e exclusão de funcionários em uma empresa.
De acordo com as regras de négocios solicitadas pelo desafio.

---

## 🚀 Tecnologias Utilizadas

### Backend
- PHP (Puro)
- MySQL (Banco de dados)

### Frontend
- HTML
- CSS (Estilização no próprio arquivo HTML, embora não seja a melhor prática de desenvolvimento.)

---

## ⚙️ Configuração do Projeto

Siga as instruções abaixo para executar o projeto localmente usando **WAMP** ou **XAMPP**.

### 📥 1. Clone o Repositório

```bash
git clone https://github.com/caiquejv/titan-software.git
cd titan-software
```
🛠 2. Configurando o Banco de Dados
Acesse o phpMyAdmin ou qualquer outro administrador de MySQL. Crie o banco de dados e as tabelas necessárias:
CREATE DATABASE funcionariosphp;
```bash
USE funcionariosphp;

CREATE TABLE tbl_funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    rg VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    id_empresa INT NOT NULL,
    salario DECIMAL(10,2) NOT NULL,
    data_cadastro DATE NOT NULL
);

CREATE TABLEtbl_ empresas (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    nome_empresa VARCHAR(100) NOT NULL
);

CREATE TABLE tbl_usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL
);
```
Em seguida, adicione um usuário de login para teste:
```bash
INSERT INTO tbl_usuario (login, senha)
VALUES ('teste@gmail.com.br', '1234'); -- ou para senha MD5: 81dc9bdb52d04dc20036dbd8313ed055
````

3. Configurando o Projeto
Este projeto não depende de ferramentas como Node.js ou React. Basta ter o WAMP ou XAMPP rodando para funcionar. Coloque o código dentro da pasta www (WAMP) ou htdocs (XAMPP).

WAMP: C:\wamp\www\titan-software
XAMPP: C:\xampp\htdocs\titan-software
## 🧭 4. Rodando o Servidor
Com o WAMP ou XAMPP em execução, basta acessar http://localhost/titan-software para ver o sistema em funcionamento.

## 🎯 Funcionalidades
Cadastro de funcionários com nome, CPF, RG, email, empresa e salário.
Edição de dados de funcionários cadastrados.
Exclusão de funcionários.
Controle de acesso via login para segurança.

## 🗂 Estrutura de Diretórios
```bash
sistema-controle-funcionarios/
├── app/              # Arquivo de configuração do banco de dados
├── config/              # Arquivo de configuração do banco de dados
├── controllers/         # Controllers responsáveis pela lógica das ações
├── Lib/                 # Biblioteca para gerar o FPDF
├── models/              # Models responsáveis pelas interações com o banco de dados
├── views/               # Views contendo o HTML para exibição
└──  index.php            # Arquivo de entrada principal do sistema
```
