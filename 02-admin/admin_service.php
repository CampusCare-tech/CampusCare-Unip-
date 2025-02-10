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

// Inclui o template para exibir os chamados
include 'templates/admin_service_template.php';
?>