<?php
// Iniciar a sessão
session_start();


// Verificar se o usuário está autenticado
if (!isset($_SESSION['id_professor'])) {
    header('Location: index.php');
    exit();
}


// Incluir a conexão com o banco de dados
include 'conexao.php';


// Consulta SQL para obter o nome do gerente
$id_gerente = $_SESSION['id_professor'];
$sql_gerente = "SELECT nome FROM professor WHERE id = $id_gerente";
$resultado_gerente = $conn->query($sql_gerente);


if ($resultado_gerente->num_rows > 0) {
    $dados_gerente = $resultado_gerente->fetch_assoc();
    $gerente_nome = $dados_gerente['nome'];
} else {
    // Caso o gerente não seja encontrado, use um valor padrão
    $gerente_nome = "Nome do Professor";
}


// Consulta SQL para obter a lista de clientes do gerente logado
$sql_clientes = "SELECT id, nome FROM turma WHERE professor_id = $id_gerente";


// Se o parâmetro de pesquisa estiver presente, adiciona à consulta
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_term = $_GET['search'];
    $sql_clientes .= " AND nome LIKE '%$search_term%'";
}


$resultado_clientes = $conn->query($sql_clientes);
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <style>
    /* Adicione este código ao seu arquivo gerente.css */

body {
    font-family: Arial, sans-serif;
    background-color: #7A7A7A;
    margin: 0;
    padding: 0;
}

.container {
    background-color: #2A2931;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 70%;
    margin: 50px auto;
}

h2 {
    text-align: center;
    color: #007bff;
}

.sair {
    display: inline-block;
    color: #dc3545;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    border-radius: 4px;
    margin-bottom: 20px;
}

.sair:hover {
    text-decoration: underline;
}
h3 {
    color: #007bff;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
    color: #fff;
    background-color: #2A2931;
}

th {
    background-color: #007bff;
    color: #fff;
}

form {
    margin-bottom: 20px;
}

label {
    margin-right: 10px;
    color: #fff;
}

input[type="text"] {
    padding: 8px;
}

button, a.botao {
    display: inline-block;
    background: rgb(9, 38, 121);
    background: linear-gradient(90deg, rgba(9, 38, 121, 1) 35%, rgba(0, 172, 255, 1) 100%);
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
}

button:hover, a.botao:hover {
    background-color: #2baa51;
}

a {
    color: #007bff;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

h2, .sair {
    margin: 0;
}

a.excluir {
    color: #dc3545;
}

a.visualizar {
    color: #007bff;
}
   </style>
   <link rel="shortcut icon" type="imagex/png" href="img/iconeEscola.png">
    <title>Tela do Gerente</title>
</head>
<body>
    
    <div class="container">
    <img src="img/logoEscola.png" alt="">
        <div class="header">
            <h2>Bem-vindo, <?php echo $gerente_nome; ?>!</h2>
            <a href="logout.php" class="sair">Sair do Sistema</a>
        </div>

        

        <!-- Formulário de pesquisa -->
        <form action="" method="get">
             
            <label for="search">Pesquisar por Nome:</label>
            <input type="text" id="search" name="search" placeholder="Digite o nome do cliente" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit" class="button-pesquisar">Pesquisar</button>
        </form>

        <table>
    <tr>
        <th>Número</th>
        <th>Nome</th>
        <th>Ações</th>
    </tr>
    <?php
    while ($row = $resultado_clientes->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nome'] . '</td>';
        echo '<td>';
        echo '<a href="excluir_cliente.php?turma_id=' . $row['id'] . '" class="excluir">Excluir</a> | ';
        echo '<a href="visualizar_cliente.php?turma_id=' . $row['id'] . '" class="visualizar">Visualizar</a>';
        echo '  <a href="adicionar_cartao.php?id_cliente=' . $row['id'] . '" class="adicionar-cartao"></a>';
        echo '</td>';
        echo '</tr>';
    }
    ?>
</table>
<br>
        <a href="cadastro_cliente.php" class="botao">Cadastrar Turma</a>
    </div>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
