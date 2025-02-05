<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// verifica se o usuário está autenticado.
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}
include 'templates/admin_home_template.php'
// Resto do código abaixo
?>
