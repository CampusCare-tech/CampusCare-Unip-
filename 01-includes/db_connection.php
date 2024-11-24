<?php
function conectar() {
    // Configurações do banco de dados
    $host = 'localhost'; 
    $user = 'root';      
    $password = '';    
    $dbname = 'unipe_campuscare_db';
    
    // Criação da conexão
    $conn = new mysqli($host, $user, $password, $dbname);

    // Verifica se há erros na conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    return $conn; // Retorna o objeto de conexão
}
?>
