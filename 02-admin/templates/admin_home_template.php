<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .content {
            margin: 20px;
        }
        .logout {
            text-align: right;
            margin: 20px;
        }
        .logout a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bem-vindo ao Painel Administrativo</h1>
    </div>
    <div class="content">
        <p>Olá, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>! Você está logado.</p>
        <!-- Conteúdo adicional do painel administrativo -->
    </div>
    <div class="logout">
        <a href="admin_logout.php">Sair</a>
    </div>
</body>
</html>
