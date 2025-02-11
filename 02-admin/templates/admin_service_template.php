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
include_once '../01-includes/db_connection.php';
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
            justify-content: flex-end;
            align-items: center;
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            margin-bottom: 40px;
        }
        .navbar h1 {
            margin: 0;
            font-size: 24px;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
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
            transform: scale(1.1);
        }
        .container {
            padding: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
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
        .concluido {
            background-color: rgb(92, 243, 128) !important; /* Verde claro */
            transition: background-color 0.5s ease;
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
            position: relative;
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
        .action-buttons button::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: white;
            padding: 5px;
            border-radius: 3px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        .action-buttons button:hover::after {
            opacity: 1;
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
        .fade-out {
            animation: fadeOut 0.5s ease forwards;
        }
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
                transform: translateX(-100%);
            }
        }
        .highlight-concluido {
            animation: highlightConcluido 1.5s ease;
        }
        @keyframes highlightConcluido {
            0% {
                background-color: #f2f2f2;
            }
            50% {
                background-color: #d4edda;
            }
            100% {
                background-color: #d4edda;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Área Administrativa - CampusCare</h1>
        <button class="logout-button" onclick="window.location.href='admin_logout.php'">
            <i class="fas fa-power-off"></i>
        </button>
    </div>

    <div class="container">
        <a class="back-link" href="admin_home.php">
            <i class="fa-solid fa-house"></i>
            <i class="fas fa-arrow-left"></i> Voltar para Home
        </a>
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
                    <?php
                    // Recupera os IDs dos chamados excluídos do localStorage
                    echo "<script>
                        const chamadosExcluidos = JSON.parse(localStorage.getItem('chamadosExcluidos')) || [];
                    </script>";

                    foreach ($records as $record):
                        echo "<script>
                            if (chamadosExcluidos.includes({$record['id']})) {
                                document.write('');
                            } else {
                        </script>";
                    ?>
                        <tr id="chamado-<?php echo $record['id']; ?>" class="<?php echo ($record['status'] === 'Concluído') ? 'concluido' : ''; ?>">
                            <td><?php echo htmlspecialchars($record['id']); ?></td>
                            <td><?php echo htmlspecialchars($record['bloco']); ?></td>
                            <td><?php echo htmlspecialchars($record['local_tipo']); ?></td>
                            <td><?php echo htmlspecialchars($record['local_identificacao']); ?></td>
                            <td><?php echo htmlspecialchars($record['descricao']); ?></td>
                            <td><?php echo htmlspecialchars($record['data_criacao']); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="complete" data-tooltip="Marcar como Concluído" onclick="concluirChamado(<?php echo $record['id']; ?>)">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="delete" data-tooltip="Excluir" onclick="excluirChamado(<?php echo $record['id']; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php
                        echo "<script>}</script>";
                    endforeach;
                    ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum registro encontrado.</p>
        <?php endif; ?>
    </div>

    <script>
        function concluirChamado(id) {
            if (confirm("Deseja marcar este chamado como concluído?")) {
                const chamado = document.getElementById(`chamado-${id}`);
                chamado.classList.add('concluido', 'highlight-concluido');
                setTimeout(() => {
                    window.location.href = `admin_concluir_chamado.php?id=${id}&service=<?php echo $service; ?>`;
                }, 1500); // Tempo da animação
            }
        }

        function excluirChamado(id) {
            if (confirm("Deseja remover este chamado?")) {
                const chamado = document.getElementById(`chamado-${id}`);
                chamado.classList.add('fade-out');
                setTimeout(() => {
                    // Remove o chamado
                    chamado.remove();
                    // Armazena o ID do chamado excluído no localStorage
                    const chamadosExcluidos = JSON.parse(localStorage.getItem('chamadosExcluidos')) || [];
                    if (!chamadosExcluidos.includes(id)) {
                        chamadosExcluidos.push(id);
                        localStorage.setItem('chamadosExcluidos', JSON.stringify(chamadosExcluidos));
                    }
                }, 500); // Tempo da animação
            }
        }

        // Filtra os chamados excluídos ao carregar a página
        document.addEventListener('DOMContentLoaded', () => {
            const chamadosExcluidos = JSON.parse(localStorage.getItem('chamadosExcluidos')) || [];
            chamadosExcluidos.forEach(id => {
                const chamado = document.getElementById(`chamado-${id}`);
                if (chamado) {
                    chamado.remove();
                }
            });
        });
    </script>
</body>
</html>