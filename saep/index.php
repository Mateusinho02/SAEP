<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Tela de Autenticação</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="imagex/png" href="img/icone.png">
</head>
<body>
    
    <div class="center-container">
    <img src="img/logoEscola.png" alt="">
    <div class="container">
        <h2>Login</h2>
        <?php
        // Verificar se há uma mensagem de aviso
        if (isset($_GET['erro']) && $_GET['erro'] == '1') {
            echo '<p class="aviso">E-mail ou senha incorretos. Tente novamente.</p>';
        }
        ?>
        <form action="autenticar.php" method="post">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            
            <button type="submit">Entrar</button>
        </form>
        </div>
    </div>
</body>
</html>
