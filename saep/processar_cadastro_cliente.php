<?php
session_start();

// Verificar se o gerente está autenticado
if (!isset($_SESSION['id_professor'])) {
    header('Location: index.php');
    exit();
}

// Incluir a conexão com o banco de dados
include 'conexao.php';

// Obter os dados do formulário
$professor_id = $_POST['professor_id'];
$nome_cliente = isset($_POST['nome']) ? $_POST['nome'] : '';
$qtd_aluno = isset($_POST['qtd_aluno']) ? $_POST['qtd_aluno'] : '';

// Verificar se os campos obrigatórios não estão vazios
if (empty($nome_cliente) || empty($qtd_aluno)) {
    echo "Erro: Preencha todos os campos obrigatórios.";
    exit();
}

// Inserir o novo cliente no banco de dados
$sql_inserir_cliente = "INSERT INTO turma (nome, qtd_aluno, professor_id) 
                        VALUES ('$nome_cliente', '$qtd_aluno', '".$_SESSION['id_professor']."')";

if ($conn->query($sql_inserir_cliente) === TRUE) {
    echo "Cliente cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar o cliente: " . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
