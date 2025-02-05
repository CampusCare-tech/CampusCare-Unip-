<?php
session_start(); // Inicia ou retoma a sessão existente

// Limpa todas as variáveis de sessão
$_SESSION = array();

// Destrói a sessão
session_destroy();

// Redireciona para a página de login
header("Location: admin_login.php");
exit();
?>
