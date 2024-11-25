<?php
require_once '../01-includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexão com o banco de dados
    $dbConnection = conectar();

    // Receber os dados do formulário
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $assunto = $_POST['subject'];
    $mensagem = $_POST['message'];

    // Define a tabela chamados_contate
    $tabela = 'chamados_contate';
    
    // Query para inserir os dados na tabela
    $sql = "INSERT INTO $tabela (nome, email, assunto, mensagem) VALUES (?, ?, ?, ?)";

    // Prepara a execução da query
    $stmt = $dbConnection->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssss", $nome, $email, $assunto, $mensagem);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Mensagem enviada com sucesso!');
                    window.location.href = '../00-public/index.php';;
                  </script>";
        } else {
            echo "<script>
                    alert('Erro ao enviar mensagem.');
                    window.history.back();
                  </script>";
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        echo "<script>
                alert('Erro ao preparar a consulta.');
                window.history.back();
              </script>";
    }

    // Fecha a conexão com o banco de dados
    $dbConnection->close();
} else {
    // Caso o método não seja POST
    echo "<script>
            alert('Requisição inválida.');
            window.location.href = '../00-public/index.php';
          </script>";
}
