<?php
// Conectar ao banco de dados (substitua os valores conforme necessário)
$host = 'localhost';
$usuario = 'root';
$senha_bd = '';
$banco = 'saep_database';

$conn = new mysqli($host, $usuario, $senha_bd, $banco);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Obter os valores do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Consulta SQL para verificar a autenticação
$sql = "SELECT * FROM professor WHERE email = '$email' AND senha = '$senha'";
$resultado = $conn->query($sql);

// Verificar se a autenticação foi bem-sucedida
if ($resultado->num_rows > 0) {
    // Iniciar a sessão
    session_start();

    // Armazenar o ID do gerente na sessão
    $row = $resultado->fetch_assoc();
    $_SESSION['id_professor'] = $row['id'];

    // Redirecionar para a tela principal do gerente
    header('Location: tela_gerente.php');
} else {
    // Redirecionar de volta para a tela de autenticação com mensagem de aviso
    header('Location: index.php?erro=1');
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
