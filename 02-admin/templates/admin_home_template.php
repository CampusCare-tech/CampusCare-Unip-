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

// Inclui a conexão com o banco de dados
include_once '../01-includes/db_connection.php';
$dbConnection = conectar();

// Função para calcular a porcentagem de chamados concluídos
function calcularPorcentagemConcluidos($dbConnection, $tabela) {
    $queryTotal = "SELECT COUNT(*) as total FROM $tabela";
    $queryConcluidos = "SELECT COUNT(*) as concluidos FROM $tabela WHERE status = 'Concluído'";

    $total = $dbConnection->query($queryTotal)->fetch_assoc()['total'];
    $concluidos = $dbConnection->query($queryConcluidos)->fetch_assoc()['concluidos'];

    return ($total > 0) ? round(($concluidos / $total) * 100, 2) : 0;
}

// Consulta o total de chamados abertos e concluídos
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
        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 60px; /* Espaço maior abaixo dos cartões */
            justify-content: center; /* Centraliza os cards horizontalmente */
        }
        .card {
            background-color: white;
            border-radius: 25px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
            padding: 30px;
            flex: 1;
            text-align: center;
            max-width: 200px; /* Limita a largura dos cards */
        }
        .card h2 {
            margin: 0;
            font-size: 20px;
            color: #4e73df;
            font-weight: bold; /* Texto em negrito */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); /* Sombra no texto */
            padding: 10px 30px;
        }
        .card p {
            font-size: 24px;
            font-weight: bold;
            color: #333333;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Sombra no texto */
            margin-top: 30px;
        }
        h2 {
            font-size: 24px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); /* Sombra no texto */
            margin-bottom: 60px; /* Espaço maior abaixo do título */
        }
        .buttons {
            display: flex;
            gap: 10px;
            justify-content: center; /* Centraliza os botões horizontalmente */
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
            font-weight: bold; /* Texto em negrito */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Sombra no texto */
            width: 200px; /* Largura fixa para todos os botões */
        }
        .buttons button:hover {
            background-color: #375ab4;
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
        <div class="cards">
            <div class="card">
                <h2>Chamados Abertos</h2>
                <p><?php echo $totalAbertos; ?></p>
            </div>
            <div class="card">
                <h2>Chamados Resolvidos</h2>
                <p><?php echo $totalConcluidos; ?></p>
            </div>
            <div class="card">
                <h2>Taxa de Resolução</h2>
                <p><?php echo $porcentagemConcluidos; ?>%</p>
            </div>       
        </div>
        <h2>Selecione a área de serviço para manipular os chamados</h2>
        <div class="buttons">
            <a href="admin_service.php?service=manutencao"><button>Manutenção</button></a>
            <a href="admin_service.php?service=limpeza"><button>Limpeza</button></a>
            <a href="admin_service.php?service=saude"><button>Saúde</button></a>
            <a href="admin_service.php?service=seguranca"><button>Segurança</button></a>
        </div>
    </div>
</body>
</html>