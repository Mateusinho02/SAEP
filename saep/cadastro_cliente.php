<?php
session_start();

// Verificar se o gerente está autenticado
if (!isset($_SESSION['id_professor'])) {
    header('Location: index.php');
    exit();
}

$professor_id = $_SESSION['id_professor'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Cadastro de Turma</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #2A2931;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.container {
    background-color: #2A2931;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 50%; /* ajuste conforme necessário */
}

h2 {
    text-align: center;
    color: #007bff;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #fff;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
}

button {
    background: rgb(9, 38, 121);
    background: linear-gradient(90deg, rgba(9, 38, 121, 1) 35%, rgba(0, 172, 255, 1) 100%);
    color: #fff;
    padding: 8px; /* Ajuste o tamanho do padding conforme necessário */
    font-size: 14px; /* Ajuste o tamanho da fonte conforme necessário */
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Turma</h2>
        
        <form action="processar_cadastro_cliente.php" method="post">
            <input type="hidden" name="professor_id" value="<?php echo $professor_id; ?>">
            
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="nome">Quantidade de aluno:</label>
            <input type="text" id="qtd_aluno" name="qtd_aluno" required>
                    
            <button type="submit">Cadastrar</button>
            <a href="tela_gerente.php" class="voltar">Voltar</a>
        </form>
    </div>
</body>
</html>
