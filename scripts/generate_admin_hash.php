<?php
// Defina a senha desejada para o administrador
$senha = "admin";

// Gere o hash da senha
$hash = password_hash($senha, PASSWORD_DEFAULT);

// Exiba o hash gerado
echo "Hash da senha '$senha': $hash";
?>
