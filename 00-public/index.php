<!DOCTYPE HTML>

<html lang="pt-br">
	<head>
		<title>CampusCare Unipe</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<script>
        function selecionarBloco(bloco) {
            document.getElementById('bloco').value = bloco;
            document.getElementById('etapaLugar').style.display = 'block';
        }

        function selecionarLugar(lugar) {
            document.getElementById('lugar').value = lugar;
            document.getElementById('etapaDetalhes').style.display = 'block';
        }
    </script>
	</head>
	<body class="is-preload">

		<!-- Wrapper-->
			<div id="wrapper">

				<!-- Nav -->
					<nav id="nav">
						<a href="#" class="icon solid fa-home"><span>Home</span></a>
						<a href="#work" class="icon solid fa-folder"><span>Denúncias</span></a>
						<a href="#contact" class="icon solid fa-envelope"><span>Contato</span></a>
						
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Me -->
							<article id="home" class="panel intro">
								<header>
									<h1>CampusCare Unipe</h1>
									<p>Seu Site de enúncias</p>
								</header>
								<a href="#work" class="jumplink pic">
									<span class="arrow icon solid fa-chevron-right"><span>See my work</span></span>
									<img src="/CampusCare-Unipe1/00-public/assets/images/me.jpg" alt="" />

								</a>
							</article>

						<!-- Work -->
							<article id="work" class="panel">
							<form action="processar.php" method="post">
								<header>
								<h2>Escolha o Bloco</h2>
								</header>
								<p>
									Blocos da UNIPÊ
								</p>
							</form>
							<section>
			<div>					
            <button type="button" onclick="selecionarBloco('Bloco A')">Bloco A</button>
            <button type="button" onclick="selecionarBloco('Bloco B')">Bloco B</button>
            <button type="button" onclick="selecionarBloco('Bloco C')">Bloco C</button>
            <button type="button" onclick="selecionarBloco('Bloco D')">Bloco D</button>
            <br>
			<button type="button" onclick="selecionarBloco('Bloco E')">Bloco E</button>
            <button type="button" onclick="selecionarBloco('Bloco F')">Bloco F</button>
            <button type="button" onclick="selecionarBloco('Bloco G')">Bloco G</button>
            <button type="button" onclick="selecionarBloco('Bloco H')">Bloco H</button>
            <br>
            <button type="button" onclick="selecionarBloco('Bloco I')">Bloco I</button>
            <button type="button" onclick="selecionarBloco('Bloco J')">Bloco J</button>
            <button type="button" onclick="selecionarBloco('Bloco K')">Bloco K</button>
            <button type="button" onclick="selecionarBloco('Bloco L')">Bloco L</button>
            <br>
            <button type="button" onclick="selecionarBloco('Bloco M')">Bloco M</button>
            <button type="button" onclick="selecionarBloco('Bloco N')">Bloco N</button>
            <button type="button" onclick="selecionarBloco('Bloco O')">Bloco O</button>
            <button type="button" onclick="selecionarBloco('Bloco P')">Bloco P</button>
            <br>
            <button type="button" onclick="selecionarBloco('Bloco Q')">Bloco Q</button>
            <button type="button" onclick="selecionarBloco('Bloco R')">Bloco R</button>
            <button type="button" onclick="selecionarBloco('Bloco S')">Bloco S</button>
            <button type="button" onclick="selecionarBloco('Bloco CT')">Bloco CT</button>
            <br>
            <button type="button" onclick="selecionarBloco('Bloco EVA')">Bloco EVA</button>
            <button type="button" onclick="selecionarBloco('Auditório')">Auditório</button>
            <button type="button" onclick="selecionarBloco('Reitoria')">Reitoria</button>
            <button type="button" onclick="selecionarBloco('Biblioteca')">Biblioteca</button>
            <br>
            <button type="button" onclick="selecionarBloco('Ginásio')">Ginásio</button>

			<div id="etapaLugar" style="display: none;">
			<h2>Escolha o Local</h2>
            <button type="button" onclick="selecionarLugar('Sala')">Sala</button>
            <button type="button" onclick="selecionarLugar('Banheiro')">Banheiro</button>
            <button type="button" onclick="selecionarLugar('Elevador')">Elevador</button>

			<div id="etapaDetalhes" style="display: none;">
            <h2>Detalhes do Problema</h2>
            <label for="ponto">Descreva qual o lugar.</label><br>
            <textarea name="ponto" id="ponto" rows="2" cols="50" required></textarea><br><br>
            <label for="descricao">Descreva qual o problema.</label><br>
            <textarea name="descricao" id="descricao" rows="4" cols="50" required></textarea><br><br>
            <button type="submit" name="enviar">Enviar</button>
			</div>

			<div id="etapaDetalhes" style="display: none;">
            <h2>Detalhes do Problema</h2>
            <label for="ponto">Descreva qual o lugar.</label><br>
            <textarea name="ponto" id="ponto" rows="2" cols="50" required></textarea><br><br>
            <label for="descricao">Descreva qual o problema.</label><br>
            <textarea name="descricao" id="descricao" rows="4" cols="50" required></textarea><br><br>
            <button type="submit" name="enviar">Enviar</button>
        	</div>

			<input type="hidden" id="bloco" name="bloco">
			<input type="hidden" id="lugar" name="lugar">
								</section>
							</article>

						<!-- Contact -->
							<article id="contact" class="panel">
								<header>
									<h2>Contate-nos</h2>
								</header>
								<form action="#" method="post">
									<div>
										<div class="row">
											<div class="col-6 col-12-medium">
												<input type="text" name="name" placeholder="Name" />
											</div>
											<div class="col-6 col-12-medium">
												<input type="text" name="email" placeholder="Email" />
											</div>
											<div class="col-12">
												<input type="text" name="subject" placeholder="Subject" />
											</div>
											<div class="col-12">
												<textarea name="message" placeholder="Message" rows="6"></textarea>
											</div>
											<div class="col-12">
												<input type="submit" value="Send Message" />
											</div>
										</div>
									</div>
								</form>
							</article>

					</div>

				<!-- Footer -->
					<div id="footer">
						<ul class="copyright">
							<li>&copy; CampusCare.</li>
						</ul>
					</div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>