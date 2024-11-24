<?php
require_once '../01-includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbConnection = conectar();

    // Recebe o tipo de assistência do POST
    $tipo_assistencia = $_POST['tipo_assistencia'];

    // Define a tabela com base no tipo de assistência
    switch ($tipo_assistencia) {
        case 'manutencao':
            $tabela = 'chamados_manutencao';
            break;
        case 'limpeza':
            $tabela = 'chamados_limpeza';
            break;
        case 'seguranca':
            $tabela = 'chamados_seguranca';
            break;
        case 'saude':
            $tabela = 'chamados_saude';
            break;
        default:
            die('Tipo de assistência inválido.');
    }

    // Recebe os outros dados do formulário (POST)
    $bloco = $_POST['bloco'];
    $local_tipo = $_POST['local_tipo'];
    $local_identificacao = $_POST['local_identificacao'];
    $descricao = $_POST['descricao'];

    // Define a consulta SQL (query) para inserir os dados na tabela especificada
    $sql = "INSERT INTO $tabela (bloco, local_tipo, local_identificacao, descricao) 
            VALUES (?, ?, ?, ?)";

    try {
        // Prepara a consulta SQL para execução
        $stmt = $dbConnection->prepare($sql);

        // Associa os parâmetros fornecidos pelo usuário às variáveis na query SQL.
        $stmt->bind_param("ssss", $bloco, $local_tipo, $local_identificacao, $descricao);

        // Executa a query preparada.
        if ($stmt->execute()) {
            // Se a execução for bem-sucedida, exibe um alerta informando que o chamado foi registrado.
            // Redireciona o usuário para a página inicial (`index.php`).
            echo "<script>
                    alert('Chamado registrado com sucesso!');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            // Caso algo dê errado ao executar o comando SQL, lança uma exceção com uma mensagem de erro.
            throw new Exception("Erro ao registrar chamado.");
        }
    } catch (Exception $errorMessage) {
        // Captura qualquer exceção lançada no bloco `try`.
        // Exibe uma mensagem de erro ao usuário e permite que ele volte à página anterior.
        echo "<script>
                alert('Erro ao registrar chamado: " . $errorMessage->getMessage() . "');
                window.history.back();
              </script>";
    }

    // Fecha o statement e a conexão
    $stmt->close();
    $dbConnection->close();
}
?>

