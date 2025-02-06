<?php
// Ativar exibição de erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verificação condicional para inicio de sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o administrador está autenticado
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Incluir o template da página inicial do administrador
include 'templates/admin_home_template.php';
?>
