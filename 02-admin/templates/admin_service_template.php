<?php
// Verificação condicional para inicio de sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o administrador está autenticado
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Verifica se o parâmetro 'service' foi informado
if (!isset($_GET['service'])) {
    die("Serviço não especificado.");
}

$service = $_GET['service'];

// Mapeamento dos parâmetros para os nomes das tabelas correspondentes
$validServices = [
    'manutencao' => 'chamados_manutencao',
    'limpeza'    => 'chamados_limpeza',
    'saude'      => 'chamados_saude',
    'seguranca'  => 'chamados_seguranca'
];

// Valida se o serviço informado é válido
if (!array_key_exists($service, $validServices)) {
    die("Serviço inválido.");
}

$tableName = $validServices[$service];

// Inclui a conexão com o banco de dados
include '../01-includes/db_connection.php';
$dbConnection = conectar();

// Consulta os registros da tabela selecionada, ordenando os mais recentes primeiro
$query = "SELECT * FROM $tableName ORDER BY data_criacao DESC";
$result = $dbConnection->query($query);

if (!$result) {
    die("Erro na consulta: " . $dbConnection->error);
}

$records = [];
while ($row = $result->fetch_assoc()) {
    $records[] = $row;
}

// Fecha a conexão com o banco
$dbConnection->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Área Administrativa - Serviço</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fc;
        }
        .navbar {
            background-color: #4e73df;
            color: white;
            padding: 20px 20px;
            display: flex;
            justify-content: flex-end; /* Alinha o botão de logout à direita */
            align-items: center;
            position: relative; /* Permite posicionamento absoluto dentro do navbar */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Sombra no navbar */
            margin-bottom: 40px; /* Espaço maior abaixo do título */
        }
        .navbar h1 {
            margin: 0;
            font-size: 24px;
            position: absolute; /* Posiciona o título */
            left: 50%; /* Move o título para o centro */
            transform: translateX(-50%); /* Ajusta o posicionamento exato */
            font-weight: bold; /* Deixa o texto em negrito */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Sombra no texto */
        }
        .logout-button {
            background: none;
            border: none;
            color: white;
            font-size: 25px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .logout-button:hover {
            transform: scale(1.1); /* Efeito ao passar o mouse */
        }
        .container {
            padding: 20px;
            text-align: center; /* Centraliza todo o conteúdo dentro do container */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px; /* Espaço maior abaixo da tabela */
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #4e73df;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .action-buttons button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .action-buttons button.edit {
            background-color: #ffc107;
            color: white;
        }
        .action-buttons button.complete {
            background-color: #28a745;
            color: white;
        }
        .action-buttons button.delete {
            background-color: #dc3545;
            color: white;
        }
        .action-buttons button:hover {
            opacity: 0.8;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #4e73df;
            text-decoration: none;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Administrativa - CampusCare</h1> <!-- Título centralizado -->
        <button class="logout-button" onclick="window.location.href='admin_logout.php'">
            <i class="fas fa-power-off"></i> <!-- Ícone de power do FontAwesome -->
        </button>
    </div>

    <div class="container">
        <a class="back-link" href="admin_home.php">&larr; Voltar para Home</a>
        <h1>Chamados de <?php echo ucfirst($service); ?></h1>

        <?php if (count($records) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bloco</th>
                        <th>Local Tipo</th>
                        <th>Local Identificação</th>
                        <th>Descrição</th>
                        <th>Data Criação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['id']); ?></td>
                            <td><?php echo htmlspecialchars($record['bloco']); ?></td>
                            <td><?php echo htmlspecialchars($record['local_tipo']); ?></td>
                            <td><?php echo htmlspecialchars($record['local_identificacao']); ?></td>
                            <td><?php echo htmlspecialchars($record['descricao']); ?></td>
                            <td><?php echo htmlspecialchars($record['data_criacao']); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="edit" onclick="editarChamado(<?php echo $record['id']; ?>)">
                                        <i class="fas fa-pencil-alt"></i> <!-- Ícone de edição -->
                                    </button>
                                    <button class="complete" onclick="concluirChamado(<?php echo $record['id']; ?>)">
                                        <i class="fas fa-check"></i> <!-- Ícone de concluído -->
                                    </button>
                                    <button class="delete" onclick="excluirChamado(<?php echo $record['id']; ?>)">
                                        <i class="fas fa-trash"></i> <!-- Ícone de lixeira -->
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum registro encontrado.</p>
        <?php endif; ?>
    </div>

    <script>
        function editarChamado(id) {
            alert("Editar chamado " + id);
            // Aqui você pode redirecionar para uma página de edição ou abrir um modal
        }

        function concluirChamado(id) {
            if (confirm("Deseja marcar este chamado como concluído?")) {
                window.location.href = `admin_concluir_chamado.php?id=${id}&service=<?php echo $service; ?>`;
            }
        }

        function excluirChamado(id) {
            if (confirm("Deseja excluir este chamado?")) {
                window.location.href = `admin_excluir_chamado.php?id=${id}&service=<?php echo $service; ?>`;
            }
        }
    </script>
</body>
</html>