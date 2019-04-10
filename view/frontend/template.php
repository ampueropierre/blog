<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?= $title ?></title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="public/css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<header>
			<div class="container-fluid">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<a class="navbar-brand" href="#">Ampuero Pierre</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
						<div class="navbar-nav ml-auto">
							<a class="nav-item nav-link active" href="#">Accueil</a>
							<a class="nav-item nav-link" href="#">Blog</a>
							<a class="nav-item nav-link" href="#">Contact</a>
						</div>
					</div>
				</nav>
			</div>
		</header>

		<div class="bloc-title-page bg-dark d-flex" style="height: 240px">
			<div class="title-page m-auto">Blog</div>
		</div>

		<div class="wrapp-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-10 mx-auto">
						<?= $content ?>
					</div>
				</div>
				
			</div>
		</div>	
		
		<footer>
			<div class="container-fluid">
				<div class="row py-2">
					<div class="col-md">
						<h5>Description</h5>
						<p style="width: 400px">Projet réaliser pour la formation OpenClassroom PHP / Symfony, ce site a été réaliser en programmation orienté objet</p>
					</div>
					<div class="col-md">
						<h5>Suivez-moi</h5>
						<a href="">Github</a>
						<a href="">Linkedin</a>		
					</div>
				</div>	
			</div>	
		</footer>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>