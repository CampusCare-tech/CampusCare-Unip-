<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Área Administrativa - CampusCare</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .buttons { margin-top: 20px; }
        .buttons a { text-decoration: none; margin-right: 10px; }
        .buttons button { padding: 10px 20px; font-size: 16px; }
    </style>
</head>
<body>
    <h1>Bem-vindo, Administrador!</h1>
    <p>Selecione a área de serviço para manipular os chamados:</p>
    <div class="buttons">
        <a href="admin_service.php?service=manutencao"><button>Manutenção</button></a>
        <a href="admin_service.php?service=limpeza"><button>Limpeza</button></a>
        <a href="admin_service.php?service=saude"><button>Saúde</button></a>
        <a href="admin_service.php?service=seguranca"><button>Segurança</button></a>
    </div>
    <br>
    <a href="admin_logout.php">Logout</a>
</body>
</html>
