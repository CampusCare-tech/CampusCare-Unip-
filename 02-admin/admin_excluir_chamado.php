<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id']) || !isset($_GET['service'])) {
    die("Parâmetros inválidos.");
}

$id = $_GET['id'];
$service = $_GET['service'];

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

include_once '../01-includes/db_connection.php'; // Usando include_once
$dbConnection = conectar();

$query = "DELETE FROM $tableName WHERE id = ?";
$stmt = $dbConnection->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();

$dbConnection->close();

header("Location: admin_service.php?service=$service");
exit();
?>