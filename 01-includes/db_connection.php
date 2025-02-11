<?php
if (!function_exists('conectar')) {
    function conectar() {
        // Configurações do banco de dados
        $host = 'localhost'; 
        $user = 'root';      
        $password = '';    
        $dbname = 'unipe_campuscare_db';

        // Criação da conexão
        $dbConnection = new mysqli($host, $user, $password, $dbname);

        // Verifica se há erros na conexão
        if ($dbConnection->connect_error) {
            die("Falha na conexão: " . $dbConnection->connect_error);
        }

        return $dbConnection; // Retorna o objeto de conexão
    }
}
?>