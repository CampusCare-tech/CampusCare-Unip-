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

// Inclui a conexão com o banco de dados
include_once '../01-includes/db_connection.php';
$dbConnection = conectar();

// Define o filtro (padrão: 'aberto')
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'aberto';

// Função para calcular a porcentagem de chamados concluídos
function calcularPorcentagemConcluidos($dbConnection, $tabela) {
    $queryTotal = "SELECT COUNT(*) as total FROM $tabela";
    $queryConcluidos = "SELECT COUNT(*) as concluidos FROM $tabela WHERE status = 'Concluído'";

    $total = $dbConnection->query($queryTotal)->fetch_assoc()['total'];
    $concluidos = $dbConnection->query($queryConcluidos)->fetch_assoc()['concluidos'];

    return ($total > 0) ? round(($concluidos / $total) * 100, 2) : 0;
}

// Consulta os totais dos chamados para todas as áreas
$tabelas = ['chamados_manutencao', 'chamados_limpeza', 'chamados_saude', 'chamados_seguranca'];
$totalAbertos = 0;
$totalConcluidos = 0;

foreach ($tabelas as $tabela) {
    $queryAbertos = "SELECT COUNT(*) as abertos FROM $tabela WHERE status != 'Concluído'";
    $queryConcluidos = "SELECT COUNT(*) as concluidos FROM $tabela WHERE status = 'Concluído'";

    $totalAbertos += $dbConnection->query($queryAbertos)->fetch_assoc()['abertos'];
    $totalConcluidos += $dbConnection->query($queryConcluidos)->fetch_assoc()['concluidos'];
}

$porcentagemConcluidos = ($totalAbertos + $totalConcluidos > 0) ? round(($totalConcluidos / ($totalAbertos + $totalConcluidos)) * 100, 2) : 0;

// Fecha a conexão com o banco
$dbConnection->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Administrativa - CampusCare</title>
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
        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 60px;
            justify-content: center;
        }
        .card {
            background-color: white;
            border-radius: 25px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
            padding: 30px;
            flex: 1;
            text-align: center;
            max-width: 200px;
            cursor: pointer;
            transition: border 0.3s ease;
        }
        .card.active {
            border: 3px solid #375ab4;
        }
        .card h2 {
            margin: 0;
            font-size: 20px;
            color: #4e73df;
            font-weight: bold;
            padding: 10px 30px;
        }
        .card p {
            font-size: 24px;
            font-weight: bold;
            color: #333333;
            margin-top: 30px;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 60px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
        .buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .buttons a {
            text-decoration: none;
        }
        .buttons button {
            padding: 25px 30px;
            font-size: 22px;
            background-color: #4e73df;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: bold;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 200px;
        }
        .buttons button:hover {
            background-color: #375ab4;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Administrativa - CampusCare</h1>
        <button class="logout-button" onclick="window.location.href='admin_logout.php'">
            <i class="fas fa-power-off"></i>
        </button>
    </div>

    <div class="container">
        <div class="cards">
            <div class="card <?php echo ($filter=='aberto' ? 'active' : ''); ?>" onclick="window.location.href='admin_home.php?filter=aberto'">
                <h2>Chamados Abertos</h2>
                <p><?php echo $totalAbertos; ?></p>
            </div>
            <div class="card <?php echo ($filter=='concluido' ? 'active' : ''); ?>" onclick="window.location.href='admin_home.php?filter=concluido'">
                <h2>Chamados Concluídos</h2>
                <p><?php echo $totalConcluidos; ?></p>
            </div>
            <div class="card">
                <h2>Taxa de Resolução</h2>
                <p><?php echo $porcentagemConcluidos; ?>%</p>
            </div>       
        </div>
        <h2>Selecione a área de serviço para manipular os chamados</h2>
        <div class="buttons">
            <a href="admin_service.php?service=manutencao&filter=<?php echo $filter; ?>"><button>Manutenção</button></a>
            <a href="admin_service.php?service=limpeza&filter=<?php echo $filter; ?>"><button>Limpeza</button></a>
            <a href="admin_service.php?service=saude&filter=<?php echo $filter; ?>"><button>Saúde</button></a>
            <a href="admin_service.php?service=seguranca&filter=<?php echo $filter; ?>"><button>Segurança</button></a>
        </div>
    </div>
</body>
</html>
