<!DOCTYPE HTML>

<html lang="pt-br">
	<head>
		<title>CampusCare Unipe</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/buttons.css" />
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
			<h1>CampusCare Unipê</h1>
			<p>Seu Site de enúncias</p>
		</header>
		<a href="#work" class="jumplink pic">
			<span class="arrow icon solid fa-chevron-right"><span>Clique aqui</span></span>
			<img src="/CampusCare-Unipe/00-public/assets/images/me.jpg"/>
		</a>
	</article>

						<!-- Denúncias -->
							<article id="work" class="panel">
							<form action="processar.php" method="post">

							</form>
							<section>
							<?php include 'blocos.php'; ?>
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