<?php
// Conexão com o banco de dados
$servername = "localhost";  // Ou o nome do servidor se não for localhost
$username = "root";         // Nome de usuário do banco de dados
$password = "";             // Senha do banco de dados (vazio por padrão em locais como XAMPP)
$dbname = "contato";        // Nome do banco de dados que você criou

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $assunto = $_POST['subject'];
    $mensagem = $_POST['message'];

    // Evitar injeção SQL (usando prepared statements)
    $stmt = $conn->prepare("INSERT INTO mensagens (nome, email, assunto, mensagem) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $email, $assunto, $mensagem);

    // Executar a consulta
    if ($stmt->execute()) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    // Fechar a declaração e a conexão
    $stmt->close();
    $conn->close();
}
?>
