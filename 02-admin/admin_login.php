<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../01-includes/db_connection.php'; // Inclui o arquivo de conexão com o banco de dados

// Verifica se o formulário foi submetido via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recebe e sanitiza os dados enviados pelo formulário
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validação básica: os campos não devem estar vazios
    if (empty($username) || empty($password)) {
        $error = "Por favor, preencha todos os campos.";
    } else {
        // Conecta ao banco de dados usando a função 'conectar()' definida em db_connection.php
        $conn = conectar();

        // Prepara uma consulta para buscar o administrador com o nome de usuário informado
        $stmt = $conn->prepare("SELECT id, admin_username, admin_password FROM admin_login WHERE admin_username = ?");
        if ($stmt) {
            // Liga o parâmetro (o nome de usuário) à consulta preparada
            $stmt->bind_param("s", $username);
            $stmt->execute();

            // Armazena o resultado para poder usar num_rows
            $stmt->store_result();

            // Verifica se foi encontrado exatamente um registro
            if ($stmt->num_rows === 1) {
                // Liga as variáveis aos resultados da consulta
                $stmt->bind_result($id, $db_username, $db_password);
                $stmt->fetch();

                // Verifica se a senha digitada confere com o hash armazenado no banco
                if (password_verify($password, $db_password)) {
                    // Autenticação bem-sucedida: regenerar o ID da sessão para evitar fixação de sessão
                    session_regenerate_id(true);
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_id'] = $id;
                    $_SESSION['admin_username'] = $db_username;

                    // Redireciona para a página inicial do painel administrativo
                    header("Location: admin_home.php");
                    exit();
                } else {
                    // Se a senha não corresponder, define uma mensagem de erro
                    $error = "Credenciais inválidas... Tente novamente.";
                }
            } else {
                // Se nenhum registro ou mais de um for encontrado, define uma mensagem de erro
                $error = "Credenciais inválidas... Tente novamente.";
            }
            // Fecha a declaração preparada
            $stmt->close();
        } else {
            // Se a preparação da consulta falhar, define uma mensagem de erro
            $error = "Erro na preparação da consulta. Tente novamente";
        }
        // Fecha a conexão com o banco de dados
        $conn->close();
    }
}

// Inclui o template de login (parte de front-end) que exibirá o formulário e a variável $error
include 'templates/admin_login_template.php';
?>
