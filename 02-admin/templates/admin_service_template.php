<?php
// Inicia a sessão se necessário
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o administrador está autenticado
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Verifica se os parâmetros necessários foram informados
if (!isset($_GET['service'])) {
    die("Serviço não especificado.");
}

$service = $_GET['service'];
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'aberto';
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
            padding: 20px;
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
        .filter-buttons {
            margin-bottom: 20px;
        }
        .filter-buttons a {
            text-decoration: none;
        }
        .filter-buttons button {
            padding: 10px 20px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #4e73df;
            color: white;
        }
        .filter-buttons button.active {
            background-color: #375ab4;
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
            background-color: rgb(92, 243, 128) !important;
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
        /* Botão de exclusão removido */
        .action-buttons button.delete {
            display: none;
        }
        .action-buttons button:hover {
            opacity: 0.8;
        }
        .highlight-concluido {
            animation: highlightConcluido 1.5s ease;
        }
        @keyframes highlightConcluido {
            0% { background-color: #f2f2f2; }
            50% { background-color: #d4edda; }
            100% { background-color: #d4edda; }
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
        <a class="back-link" href="admin_home.php?filter=<?php echo $filter; ?>">
            <i class="fa-solid fa-house"></i>
            <i class="fas fa-arrow-left"></i> Voltar para Home
        </a>
        <h1>Chamados de <?php echo ucfirst($service); ?></h1>

        <div class="filter-buttons">
            <a href="admin_service.php?service=<?php echo $service; ?>&filter=aberto">
                <button class="<?php echo ($filter=='aberto' ? 'active' : ''); ?>">Abertos</button>
            </a>
            <a href="admin_service.php?service=<?php echo $service; ?>&filter=concluido">
                <button class="<?php echo ($filter=='concluido' ? 'active' : ''); ?>">Concluídos</button>
            </a>
        </div>

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
                                    <!-- Botão de exclusão removido -->
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
        function concluirChamado(id) {
            if (confirm("Deseja marcar este chamado como concluído?")) {
                const chamado = document.getElementById(`chamado-${id}`);
                chamado.classList.add('concluido', 'highlight-concluido');
                setTimeout(() => {
                    window.location.href = `admin_concluir_chamado.php?id=${id}&service=<?php echo $service; ?>&filter=<?php echo $filter; ?>`;
                }, 1500);
            }
        }
    </script>
</body>
</html>
