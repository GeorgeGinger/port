<?php
require "./data.php";

//defaut
$idStranky = "domu";


if (array_key_exists("id-stranky", $_GET)) {
	$idStranky = $_GET["id-stranky"];
}



?>

<!DOCTYPE html>
<html lang="cs">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Sauna Slaný</title>
	<!--ikony socialních síti-->
	<link rel="stylesheet" href="css/all.min.css">

	<link rel="stylesheet" href="css/reset-css.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/section.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/kontakt.css">
	<link rel="stylesheet" href="css/galerie.css">

	<!--nalinkování ikony zobrazené u tytulku záložky-->
	<link rel="shortcut icon" href="favicon.png" type="image/x-icon">
	<!--fonty-->
	<!-- <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet"> -->
</head>

</head>

<body>
	<header>
			<div>
				<div class="headerTop">
					<div class="container">
						<div class="adresa">
							Kynského 122, Slaný
						</div>

						<a class="odkaz" href="tel:+420 776 740 434">tel.: +420/ 776 740 434</a>
					</div>
				</div>
				<div class="headerMidl">
					<div class="container">
						<h2>
							<a href="index.php">Sauna&nbsp;Klub<br>Slaný</a>
						</h2>

						<!-- <img src="img/spojeni-fotek-30.png" alt="obývák"> -->
					</div>
				</div>
			</div>

				<nav>
					<div class="container">
						<?php
						require "./menu.php";
						?>
					</div>
				</nav>



	</header>
	<section>
		<?php
		require "./{$poleStranek[$idStranky]->getId()}.html";
		?>
	</section>

	<footer>
		<div class="kontakty">
			<div class="container">
				<div class="kontaktyTop">
				<h2>KONTAKTY pro objednání:</h2>
				<p>
					<a class="odkaz" href="tel:+420 776 740 434">
						<i class="fa-solid fa-phone"></i>
						+420 776 740 434
					</a>
				</p>
				<p>
					<a class="odkaz" href="https://mapy.cz/s/lelonubete" target="_blank">
						<i class="fa-solid fa-location-dot"></i>
						Kynskeho 122, Slany
					</a>
				</p>
				<p>
					<a class="odkaz" href="mailto:saunaslany@seznam.cz">
						<i class="fa-regular fa-envelope"></i>
						saunaslany@seznam.cz
					</a>
				</p>
				</div>
				

				<div class="soc">
					<a href="https://www.facebook.com/profile.php?id=100083707954063" target="_blank"><i
							class="fa-brands fa-facebook"></i></a>
					<a href="https://instagram.com/saunaklubslany?igshid=NTc4MTIwNjQ2YQ==" target="_blank"><i
							class="fa-brands fa-instagram"></i></a>
				</div>

			</div>
		</div>
	</footer>
</body>

</html>