<?php
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION['admin_username'])) {
    header('Location: servicos_template.php');
    exit();
}

// Variável para exibir mensagens de erro
$error = '';
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <style>
        /* Estilos globais */
        * {
            box-sizing: border-box;
        }

        body {
            background: #c1bdba;
            font-family: 'Titillium Web', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form {
            background: rgba(19, 35, 47, 0.9);
            padding: 40px;
            max-width: 600px;
            width: 100%;
            margin: 40px auto;
            border-radius: 4px;
            box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);
        }

        .tab-group {
            list-style: none;
            padding: 0;
            margin: 0 0 40px 0;
            display: flex;
        }

        .tab-group li {
            flex: 1;
        }

        .tab-group li a {
            display: block;
            text-decoration: none;
            padding: 15px;
            background: rgba(160, 179, 176, 0.25);
            color: #a0b3b0;
            font-size: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.5s ease;
        }

        .tab-group li a:hover {
            background: #179b77;
            color: #ffffff;
        }

        .tab-group .active a {
            background: #1ab188;
            color: #ffffff;
        }

        .tab-content > div {
            display: none;
        }

        .tab-content > div:first-child {
            display: block;
        }

        h1 {
            text-align: center;
            color: #ffffff;
            font-weight: 300;
            margin: 0 0 40px;
        }

        label {
            position: absolute;
            transform: translateY(6px);
            left: 13px;
            color: rgba(255, 255, 255, 0.5);
            transition: all 0.25s ease;
            font-size: 22px;
            pointer-events: none;
        }

        label.active {
            transform: translateY(50px);
            left: 2px;
            font-size: 14px;
        }

        label.highlight {
            color: #ffffff;
        }

        input, textarea {
            font-size: 22px;
            display: block;
            width: 100%;
            padding: 10px;
            background: none;
            border: 1px solid #a0b3b0;
            color: #ffffff;
            border-radius: 0;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }

        input:focus, textarea:focus {
            outline: 0;
            border-color: #1ab188;
        }

        .field-wrap {
            position: relative;
            margin-bottom: 40px;
        }

        .top-row:after {
            content: "";
            display: table;
            clear: both;
        }

        .top-row > div {
            float: left;
            width: 48%;
            margin-right: 4%;
        }

        .top-row > div:last-child {
            margin-right: 0;
        }

        .button {
            border: 0;
            outline: none;
            border-radius: 0;
            padding: 15px 0;
            font-size: 2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            background: #1ab188;
            color: #ffffff;
            transition: all 0.5s ease;
            cursor: pointer;
            width: 100%;
        }

        .button:hover {
            background: #179b77;
        }

        .forgot {
            margin-top: -20px;
            text-align: right;
        }

        .forgot a {
            color: #a0b3b0;
            text-decoration: none;
            transition: color 0.5s ease;
        }

        .forgot a:hover {
            color: #179b77;
        }

        .error {
            color: #ff6b6b;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="form">
        <!-- Abas de Login e Cadastro -->
        <ul class="tab-group">
            <li class="tab active"><a href="#login">Entrar</a></li>
            <li class="tab"><a href="#signup">Cadastrar</a></li>
        </ul>

        <!-- Conteúdo das abas -->
        <div class="tab-content">
            <!-- Login -->
            <div id="login">
                <h1>Bem-vindo de volta!</h1>
                <?php if ($error): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endif; ?>
                <form action="admin_home_template.php">
                    <div class="field-wrap">
                        <label>Nome de usuário<span class="req">*</span></label>
                        <input type="text" name="username" required autocomplete="off" />
                    </div>
                    <div class="field-wrap">
                        <label>Senha<span class="req">*</span></label>
                        <input type="password" name="password" required autocomplete="off" />
                    </div>
                    <p class="forgot"><a href="#">Esqueceu a senha?</a></p>
                    <button type="submit" class="button">Entrar</button>
                </form>
            </div>

            <!-- Cadastro -->
            <div id="signup">
                <h1>Cadastre-se gratuitamente</h1>
                <form action="admin_signup.php" method="post">
                    <div class="top-row">
                        <div class="field-wrap">
                            <label>Nome<span class="req">*</span></label>
                            <input type="text" name="first_name" required autocomplete="off" />
                        </div>
                        <div class="field-wrap">
                            <label>Sobrenome<span class="req">*</span></label>
                            <input type="text" name="last_name" required autocomplete="off" />
                        </div>
                    </div>
                    <div class="field-wrap">
                        <label>Nome de usuário<span class="req">*</span></label>
                        <input type="text" name="username" required autocomplete="off" />
                    </div>
                    <div class="field-wrap">
                        <label>Senha<span class="req">*</span></label>
                        <input type="password" name="password" required autocomplete="off" />
                    </div>
                    <button type="submit" class="button">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para alternar entre as abas -->
    <script>
        document.querySelectorAll('.tab a').forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();

                // Remove a classe 'active' de todas as abas
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                // Adiciona a classe 'active' à aba clicada
                this.parentElement.classList.add('active');

                // Oculta todo o conteúdo das abas
                document.querySelectorAll('.tab-content > div').forEach(content => {
                    content.style.display = 'none';
                });

                // Exibe o conteúdo da aba clicada
                const target = this.getAttribute('href');
                document.querySelector(target).style.display = 'block';
            });
        });

        // Adiciona interação aos campos de formulário
        document.querySelectorAll('.form input').forEach(input => {
            input.addEventListener('keyup', function () {
                const label = this.previousElementSibling;
                if (this.value !== '') {
                    label.classList.add('active', 'highlight');
                } else {
                    label.classList.remove('active', 'highlight');
                }
            });

            input.addEventListener('focus', function () {
                const label = this.previousElementSibling;
                label.classList.add('highlight');
            });

            input.addEventListener('blur', function () {
                const label = this.previousElementSibling;
                if (this.value === '') {
                    label.classList.remove('highlight');
                }
            });
        });
    </script>
</body>
</html>