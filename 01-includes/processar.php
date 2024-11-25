<?php
require_once '../01-includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexão com o banco de dados
    $dbConnection = conectar();

    // Verifica se os campos obrigatórios foram enviados
    if (!isset($_POST['tipo_assistencia'], $_POST['bloco'], $_POST['local_tipo'], $_POST['local_identificacao'], $_POST['descricao'])) {
        echo "<script>
                alert('Por favor, preencha todos os campos.');
                window.history.back();
              </script>";
        exit;
    }

    // Recebe os dados enviados pelo formulário
    $tipo_assistencia = $_POST['tipo_assistencia'];
    $bloco = $_POST['bloco'];
    $local_tipo = $_POST['local_tipo'];
    $local_identificacao = $_POST['local_identificacao'];
    $descricao = $_POST['descricao'];

    // Define a tabela com base no tipo de assistência
    $tabela = '';
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
            echo "<script>
                    alert('Tipo de assistência inválido.');
                    window.history.back();
                  </script>";
            exit;
    }

    // Query para inserir os dados na tabela
    $sql = "INSERT INTO $tabela (bloco, local_tipo, local_identificacao, descricao) VALUES (?, ?, ?, ?)";

    // Prepara a execução da query
    $stmt = $dbConnection->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssss", $bloco, $local_tipo, $local_identificacao, $descricao);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Chamado registrado com sucesso!');
                    window.location.href = '../00-public/index.php';;
                  </script>";
        } else {
            echo "<script>
                    alert('Erro ao registrar o chamado.');
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
?>