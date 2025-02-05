<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Administração - Login e Cadastro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .form-container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 48%;
            margin-bottom: 20px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 3px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
        @media (max-width: 768px) {
            .form-container {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Formulário de Login -->
        <div class="form-container">
            <h2>Login Administrativo</h2>
            <?php if (isset($login_error)): ?>
                <p class="error"><?php echo htmlspecialchars($login_error); ?></p>
            <?php endif; ?>
            <form action="admin_login.php" method="post">
                <input type="text" name="username" placeholder="Nome de usuário" required>
                <input type="password" name="password" placeholder="Senha" required>
                <input type="submit" value="Entrar">
            </form>
        </div>
        
        <!-- Formulário de Cadastro -->
        <div class="form-container">
            <h2>Cadastro Administrativo</h2>
            <?php if (isset($register_error)): ?>
                <p class="error"><?php echo htmlspecialchars($register_error); ?></p>
            <?php endif; ?>
            <form action="admin_register.php" method="post">
                <input type="text" name="first_name" placeholder="Nome" required>
                <input type="text" name="last_name" placeholder="Sobrenome" required>
                <input type="text" name="username" placeholder="Nome de usuário" required>
                <input type="password" name="password" placeholder="Senha" required>
                <input type="password" name="confirm_password" placeholder="Confirmar Senha" required>
                <input type="submit" value="Cadastrar">
            </form>
        </div>
    </div>
</body>
</html>
