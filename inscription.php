<!doctype html>
<html lang="en">

<head>
	<title>Alizon - Inscription</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=no">
	<link rel="icon" href="img/icon/logo.svg"/>
	<link href="inscription.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-grid.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-reboot.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-grid.css.map" rel="">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"> <!-- Font Awesome importé pour pouvoir changer la classe facilement -->
</head>

<body>
	<style>
		body {
			position: relative;
		}
	</style>
	<header>
		<?php include "header.php"; ?>
	</header>
	<?php
	if (isset($_GET['fail'])) {
		echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Veuillez vérifier vos informations.</div>';
	}
	?>
	<br>
	<main>
		<div class="container">
			<div class="card justify-content-center m-4">
				<form method="post" action="verificationInscription.php">
					<h2 class="text-center">Informations Personnelles</h2>
					<div class="form-group row m-2">
						<label class="col-sm-2 col-form-label"><abbr>*</abbr>Nom</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="Nom" placeholder="Nom" required>
						</div>
					</div>
					<div class="form-group row m-2">
						<label class="col-sm-2 col-form-label"><abbr>*</abbr>Prenom</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="Prenom" placeholder="Prenom" required>
						</div>
					</div>
					<div class="form-group row m-2">
						<label class="col-sm-2 col-form-label"><abbr>*</abbr>Numéro de Téléphone</label>
						<div class="col-sm-10">
							<input type="text" name="Tel" class="form-control" placeholder="Téléphone" required>
						</div>
					</div>
					<div class="form-group row m-2">
						<label class="col-sm-2 col-form-label"><abbr>*</abbr>Date de Naissance</label>
						<div class="col-sm-10">
							<input type="date" name="Date" placeholder="Date Naissance" class="form-control" required>
						</div>
					</div>
					<div class="form-group row m-2">
						<label class="col-sm-2 col-form-label"><abbr>*</abbr>Adresse de Facturation</label>
						<div class="col-sm-10">
							<input type="text" name="Adresse" placeholder="Adresse Facturation" class="form-control" required>
						</div>
					</div>
					<div class="form-group row m-2">
						<label class="col-sm-2 col-form-label"><abbr>*</abbr>Code Postale</label>
						<div class="col-sm-10">
							<input type="text" name="Code" placeholder="Code Postale" class="form-control" required>
						</div>
					</div>
					<div class="form-group row m-2">
						<label class="col-sm-2 col-form-label"><abbr>*</abbr>Ville</label>
						<div class="col-sm-10">
							<input type="text" name="Ville" placeholder="Ville" class="form-control" required>
						</div>
					</div>
					<h2 class="text-center">Informations de connexion</h2>
					<div class="form-group row m-2">
						<label class="col-sm-2 col-form-label"><abbr>*</abbr>E-Mail</label>
						<div class="col-sm-10">
							<input type="text" name="Mail" placeholder="E-Mail" class="form-control" required>
						</div>
					</div>
					<div class="form-group row m-2">
						<label class="col-sm-2 col-form-label"><abbr>*</abbr>Mot de Passe</label>
						<div class="col-sm-10 mb-10">
							<input type="password" name="Password" placeholder="Mot de Passe" id="id_password" class="form-control" required>
							<i class="far fa-eye" id="togglePassword" style="float: right;margin-top: -58px;position: relative;z-index: 2;margin-right: 10px;"></i>
						</div>
					</div>
					<div class="form-group row m-2">
						<label class="col-sm-2 col-form-label"><abbr>*</abbr>Confirmer mot de passe</label>
						<div class="col-sm-10 mb-10">
							<input type="password" name="ConfirmPassword" placeholder="Confirmer mot de passe" class="form-control" required>
						</div>
					</div>
					<div class="form-group m-5">
						<input type="checkbox" class="form-check-input">
						<label class="form-check-label" for="form-check-input">J'accepte les <a href="cgu.php">Conditions Générales d'Utilisation </a></label>
					</div>
					<div class="form-group text-center">
						<button class="btn bg-primary float-center text-light button" onclick="stateHandle();" id="bouton">Inscription</button>
					</div>

				</form>

			</div>
		</div>
	</main>
	<br>
	<br>
	<br>
	<br>
	<br>
	<?php include "footer.php" ?>
	<script>
		// Check si les cgu sont acceptés
		let input = document.querySelector(".form-check-input");
		let button = document.querySelector(".button");
		button.disabled = true;
		input.addEventListener("change", stateHandle);

		function stateHandle() {
			if (document.querySelector(".form-check-input:checked") == null) {
				button.disabled = true;
			} else {
				button.disabled = false;
			}
		}

		// Oeil pour afficher le mdp
		const togglePassword = document.querySelector('#togglePassword');
		const password = document.querySelector('#id_password');

		togglePassword.addEventListener('click', function(e) {
			// toggle l'attribut
			const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
			password.setAttribute('type', type);
			// toggle l'oeil (barré ou non)
			this.classList.toggle('fa-eye-slash');
		});
	</script>
</body>
</html>