<?php
require_once '../01-includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = conectar();

    // Lista de tipos de assistência válidos e suas tabelas correspondentes
    $mapa_tabelas = [
        'manutencao' => 'chamados_manutencao',
        'limpeza' => 'chamados_limpeza',
        'seguranca' => 'chamados_seguranca',
        'saude' => 'chamados_saude',
    ];

    // Recebe o tipo de assistência do POST
    $tipo_assistencia = $_POST['tipo_assistencia'];

    // Valida o tipo de assistência
    if (!array_key_exists($tipo_assistencia, $mapa_tabelas)) {
        die('Tipo de assistência inválido.');
    }

    // Define a tabela com base no tipo de assistência válido
    $tabela = $mapa_tabelas[$tipo_assistencia];

    // Recebe os outros dados do formulário
    $bloco = $_POST['bloco'];
    $local_tipo = $_POST['local_tipo'];
    $local_identificacao = $_POST['local_identificacao'];
    $descricao = $_POST['descricao'];

    // Prepara a query SQL
    $sql = "INSERT INTO $tabela (bloco, local_tipo, local_identificacao, descricao) 
            VALUES (?, ?, ?, ?)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $bloco, $local_tipo, $local_identificacao, $descricao);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Chamado registrado com sucesso!');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            throw new Exception("Erro ao registrar chamado.");
        }
    } catch (Exception $e) {
        echo "<script>
                alert('Erro ao registrar chamado: " . $e->getMessage() . "');
                window.history.back();
              </script>";
    }

    // Fecha o statement e a conexão
    $stmt->close();
    $conn->close();
}
?>
