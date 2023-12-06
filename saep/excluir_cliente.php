<?php
session_start();

// Verificar se o gerente está autenticado
if (!isset($_SESSION['id_professor'])) {
    header('Location: index.php');
    exit();
}

// Incluir a conexão com o banco de dados
include 'conexao.php';

// Verificar se o ID da turma foi fornecido na URL
if (!isset($_GET['turma_id'])) {
    echo "ID da turma não fornecido.";
    exit();
}

// Obter o ID da turma da URL
$id_turma = $_GET['turma_id'];

// Excluir a turma do banco de dados
$sql_excluir_turma = "DELETE FROM turma WHERE id = $id_turma";

if ($conn->query($sql_excluir_turma) === TRUE) {
    echo "Turma excluída com sucesso!";
} else {
    echo "Erro ao excluir a turma: " . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
