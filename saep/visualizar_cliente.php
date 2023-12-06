<?php
// Iniciar a sessão
session_start();

// Verificar se o gerente está autenticado
if (!isset($_SESSION['id_professor'])) {
    header('Location: index.php');
    exit();
}

// Incluir a conexão com o banco de dados
include 'conexao.php';

// Verificar se o ID da turma foi fornecido na URL
if (!isset($_GET['turma_id']) || empty($_GET['turma_id'])) {
    echo "ID da turma não fornecido.";
    exit();
}

// Obter o ID da turma da URL
$id_turma = $_GET['turma_id'];

// Consulta SQL para obter as informações da turma
$sql_turma = "SELECT * FROM turma WHERE id = $id_turma";
$resultado_turma = $conn->query($sql_turma);

// Verificar se a turma existe
if ($resultado_turma->num_rows === 0) {
    echo "Turma não encontrada.";
    exit();
}

$turma = $resultado_turma->fetch_assoc();

// Consulta SQL para obter as atividades da turma
$sql_atividades = "SELECT * FROM atividade WHERE id_turma = $id_turma";
$resultado_atividades = $conn->query($sql_atividades);

// Verificar se há atividades para exibir
if ($resultado_atividades->num_rows > 0) {
    $atividades = $resultado_atividades->fetch_all(MYSQLI_ASSOC);
} else {
    $atividades = array();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vizualizar.css">
    <title>Visualizar Turma</title>
</head>
<body>

<div class="container">
    <h2>Atividades da Turma <?php echo $turma['nome']; ?></h2>

    <table>
        <tr>
            <th>ID da Atividade</th>
            <th>Nome da Atividade</th>
        </tr>
        <?php
        foreach ($atividades as $atividade) {
            echo '<tr>';
            echo '<td>' . $atividade['id'] . '</td>';
            echo '<td>' . $atividade['nome'] . '</td>';
            echo '</tr>';
        }
        ?>
    </table>

    <br>
    <a href="adicionar_atividade.php?turma_id=<?php echo $id_turma; ?>" class="botao">Adicionar Atividade</a>
    <br>
    <a href="tela_gerente.php" class="botao">Voltar</a>
</div>

</body>
</html>
