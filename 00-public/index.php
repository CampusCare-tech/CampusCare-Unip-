<!DOCTYPE HTML>
<html lang="pt-br">
	
	<head>
		<title>CampusCare Unipê</title> <!-- Título da página que aparece na aba do navegador -->
		<meta charset="utf-8" /> <!-- Define a codificação de caracteres para UTF-8 -->
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" /> <!-- Configura a exibição em dispositivos móveis -->
		<link rel="stylesheet" href="assets/css/main.css" /> <!-- Link para o arquivo principal de estilos CSS -->
		<link rel="stylesheet" href="assets/css/buttons.css" /> <!-- Link para o arquivo de estilos específicos para botões -->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript> <!-- Se o JavaScript não estiver habilitado, carrega um CSS alternativo -->
		<script>
            // Função para selecionar o bloco e exibir a próxima etapa
            function selecionarBloco(bloco) {
                document.getElementById('bloco').value = bloco; // Define o valor do campo oculto com o bloco selecionado
                document.getElementById('etapaLugar').style.display = 'block'; // Exibe a etapa do "Lugar"
            }

            // Função para selecionar o lugar e exibir a próxima etapa
            function selecionarLugar(lugar) {
                document.getElementById('lugar').value = lugar; // Define o valor do campo oculto com o lugar selecionado
                document.getElementById('etapaDetalhes').style.display = 'block'; // Exibe a etapa dos "Detalhes"
            }
        </script>
	</head>

	<body class="is-preload"> <!-- Define uma classe para o corpo da página, provavelmente usada para animações ou efeitos de preload -->

		<!-- Wrapper: Contém toda a estrutura da página -->
			<div id="wrapper">

				<!-- Nav: Barra de navegação -->
					<nav id="nav">
						<a href="#" class="icon solid fa-home"><span>Home</span></a> <!-- Link para a página inicial -->
						<a href="#work" class="icon solid fa-folder"><span>Chamados</span></a> <!-- Link para a seção de denúncias -->
					</nav>

				<!-- Main: Área principal da página -->
				<div id="main">

					<!-- Me: Introdução ou seção inicial da página -->
						<article id="home" class="panel intro">
							<header>
								<h1>Campus Care Unipê</h1> <!-- Título principal da página -->
								<p>Central de Suporte</p> <!-- Descrição do site -->
							</header>
							<a href="#work" class="jumplink pic"> <!-- Link para a seção de denúncias -->
								<span class="arrow icon solid fa-chevron-right"><span>Clique aqui</span></span>
								<img src="assets/images/campus.jpg" alt="Campus"> <!-- Imagem representando o campus -->
							</a>
						</article>

					<!-- Chamados: Seção para reportar problemas -->
						<article id="work" class="panel">
							<form action="processar.php" method="post"> <!-- Formulário para processar as denúncias -->
							</form>
							<section>
								<?php include 'blocos.php'; ?> <!-- Inclui o arquivo PHP 'blocos.php', provavelmente para carregar uma lista de blocos ou opções -->
							</section>
						</article>

				</div>

				<!-- Footer: Rodapé da página -->
				<div id="footer">
					<ul class="copyright">
						<li>&copy; CampusCare</li> <!-- Informações de copyright -->
					</ul>
					<div class="footer-email">
						<a href="https://mail.google.com/mail/?view=cm&fs=1&to=campuscare.tech@gmail.com" target="_blank">campuscare.tech@gmail.com</a>
					</div>
				</div>

			</div>

		<!-- Scripts: Inclusão dos arquivos JavaScript para funcionalidades da página -->
			<script src="assets/js/jquery.min.js"></script> <!-- Biblioteca jQuery -->
			<script src="assets/js/browser.min.js"></script> <!-- Script para detectar o navegador -->
			<script src="assets/js/breakpoints.min.js"></script> <!-- Responsividade, ajustando a página para diferentes tamanhos de tela -->
			<script src="assets/js/util.js"></script> <!-- Utilitários adicionais para o site -->
			<script src="assets/js/main.js"></script> <!-- Script principal do site -->
	</body>
</html>