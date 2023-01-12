<?php require '_header.php';
//pour la barre de recherche
header('Cache-Control: no cache'); //disable validation of form by the browser, pour pas qu'il y ait problème quand recherche vide

//le  @pour pas que ça mette qu'il est pas defini
@$keywords = $_POST['keywords'];
@$valider = $_POST['valider'];
?>
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<style>
	.iconClass {
		position: relative;
	}

	.iconClass span {
		position: absolute;
		top: 26%;
		right: 40%;
		font-size: 50%;
		display: block;
		padding: 3px;
	}

	header {
		background-color: white;
	}
</style>
<script>
	//link.href = '';
</script>
<header>
<nav class="navbar navbar-expand-md navbar-expand-sm border-bottom border-primary">
	<a class="navbar-brand regular-a" href="index.php">
		<img src="img/logo.png" alt="Logo Alizon" width="100" height="100" class="d-inline-block align-text-top">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="main-navigation">
		<ul class="navbar-nav">
			<li class="nav-item">
				<form class="d-flex flex-shrink-1 align-contents-center" name="recherche" method="GET" role="search" action="pageproduittest.php" style="margin-bottom:0">
					<input class="form-control me-2 search" name="keywords" value="<?= $keywords ?>" type="search" placeholder="Rechercher un produit">
					<button class="btn btn-outline-primary" name="valider" type="submit" ">Rechercher</button>
				</form>
			</li>
			<li class="nav-item">
				<a class="nav-link regular-a" href="profil.php">
					<?php
					if (isset($_SESSION['id'])) {
						echo '<svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" fill="#0062AC" class="bi bi-person-fill" viewBox="0 0 16 16" alt="Mon profil">';
					} else {
						echo '<svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" fill="#000" class="bi bi-person-fill" viewBox="0 0 16 16" alt="Se connecter">';
					}
					?>
					<path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
					<rect>
						<title>Mon profil</title>
					</rect>
					</svg>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link regular-a iconClass" href="panier.php">
					<svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" fill="#000" class="bi bi-cart3" viewBox="0 0 16 16" alt="Mon panier">
						<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
						<rect>
							<title>Mon panier</title>
						</rect>
					</svg>
					<?php
					if (isset($_SESSION['id'])) { //si user connecté
						$panierco = $DB->query("select count(*) as count from _panier where idClient=:id", array('id' => $_SESSION['id'])); // le as count enlève le "(*)" pour mieux le sélectionner en php
						$badge = $panierco[0]->count;
						if ($badge >= 1) {
							echo '<span class="badge rounded-pill text-bg-danger updateable" id="badge">' . $badge . '</span>' . PHP_EOL;
						}
					} else {
						if ($panier->count() >= 1) {
							$badge = $panier->count();
							echo '<span class="badge rounded-pill text-bg-danger updateable" id="badge">' . $badge . '</span>' . PHP_EOL;
						}
					}

					?>
				</a>
			</li>
		</ul>
	</div>
</nav>
<div class="d-flex justify-content-evenly container">
				<a class="nav-link" href="resultatrecherche.php?keywords=alimentation">Alimentation</a>
				<a class="nav-link" href="resultatrecherche.php?keywords=textile">Textile</a>
				<a class="nav-link" href="resultatrecherche.php?keywords=souvenirs">Souvenirs</a>
</div>
</header>
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>