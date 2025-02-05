<?php
session_start();
require_once '../01-includes/db_connection.php';

// Inicializa a variável de erro para exibir mensagens caso necessário
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitiza e atribui os dados do formulário às variáveis
    $firstName       = trim($_POST['first_name'] ?? '');
    $lastName        = trim($_POST['last_name'] ?? '');
    $username        = trim($_POST['username'] ?? '');
    $password        = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validação dos campos: todos os campos devem ser preenchidos e as senhas devem coincidir
    if (empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($confirmPassword)) {
        $error = "Todos os campos são obrigatórios.";
    } elseif ($password !== $confirmPassword) {
        $error = "As senhas não conferem.";
    } else {
        // Conecta ao banco de dados
        $conn = conectar();

        // Verifica se o nome de usuário já está cadastrado
        $stmt = $conn->prepare("SELECT id FROM admin_login WHERE admin_username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error = "Nome de usuário já existe.";
            } else {
                $stmt->close();

                // Gera o hash da senha automaticamente
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Prepara a consulta para inserir os dados do novo administrador
                $stmt = $conn->prepare("INSERT INTO admin_login (admin_first_name, admin_last_name, admin_username, admin_password) VALUES (?, ?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param("ssss", $firstName, $lastName, $username, $hashedPassword);
                    if ($stmt->execute()) {
                        // Redireciona para a página de login após o cadastro com sucesso
                        header("Location: admin_login.php");
                        exit();
                    } else {
                        $error = "Erro ao registrar o administrador. Tente novamente.";
                    }
                } else {
                    $error = "Erro na preparação da consulta de inserção. Tente novamente.";
                }
            }
            $stmt->close();
        } else {
            $error = "Erro na preparação da consulta de verificação. Tente novamente.";
        }
        $conn->close();
    }
}

// Inclui o template de exibição do formulário de cadastro (front-end)
include 'templates/admin_login_template.php';
?>
