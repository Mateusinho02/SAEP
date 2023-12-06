<?php
session_start();

// Destruir a sessão
session_destroy();

// Redirecionar para a tela de autenticação
header('Location: index.php');
exit();
?>
