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
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'aberto'; // Filtro: 'aberto' ou 'concluido'

// Mapeamento dos serviços para as tabelas correspondentes
$validServices = [
    'manutencao' => 'chamados_manutencao',
    'limpeza'    => 'chamados_limpeza',
    'saude'      => 'chamados_saude',
    'seguranca'  => 'chamados_seguranca'
];

if (!array_key_exists($service, $validServices)) {
    die("Serviço inválido.");
}

$tableName = $validServices[$service];

// Inclui a conexão com o banco de dados
include_once '../01-includes/db_connection.php';
$dbConnection = conectar();

// Constrói a query com base no filtro
if ($filter === 'concluido') {
    $query = "SELECT * FROM $tableName WHERE status = 'Concluído' ORDER BY data_criacao DESC";
} else {
    $query = "SELECT * FROM $tableName WHERE status != 'Concluído' ORDER BY data_criacao DESC";
}

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

// Inclui o template para exibir os chamados
include 'templates/admin_service_template.php';
?>
