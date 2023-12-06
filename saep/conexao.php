<?php
// Substitua os valores apropriados pelos dados do seu banco de dados
$host = 'localhost';
$usuario = 'root';
$senha_bd = '';
$banco = 'saep_database';

$conn = new mysqli($host, $usuario, $senha_bd, $banco);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>