<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Alizon">
    <meta property="og:image" content="./favicon.ico">
    <meta property="shortcut icon" type="image/png" href="favicon.ico">
    <link rel="icon" href="img/icon/logo.svg"/>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">

    <title>Alizon - Mot de Passe oublié</title>
</head>

<body style="background-color:#eee">
<style>
    body{
        position:relative;
    }
</style>
    <?php include "header.php"; ?>
    <?php
        if (isset($_SESSION['id'])) {
            header('Location: index.php');
        } if (isset($_GET['fail'])){
            echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Aucun compte existe avec ce mail.</div>'.PHP_EOL;
        } if (isset($_GET['sent'])){ // plus utilisé
            echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Un mail vous a été envoyé.</div>'.PHP_EOL;
        } if (isset($_GET['expired'])) {
            echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Token expiré. Veuillez réésayer.</div>'.PHP_EOL;
        }
    ?>

    <section class="h-100 gradient-form">
        <div class="position-relative">
            <h2 class="text-center" style="padding-top:.5em;">Retrouver mon mot de passe</h2>
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-7">
                        <div class="card rounded-3 text-black">
                            <a type="button" class="btn-close position-relative top-0 start-0" href="index.php" aria-label="Close"></a>
                            <div class="row g-0">
                                
                                    <div class="card-body p-md-5 mx-md-4">
                                        <form action="verificationForgot.php" method="post">
                                            <h4 class="mb-4">Entrez l'adresse email associé au compte perdu.</h4>
                                            <div class="form-outline mb-4">
                                                <input type="email" name="email" class="form-control" placeholder="Adresse E-Mail" required/>
                                            </div>
                                            <p>Si un compte existe avec cet email, un mail sera envoyé à cette adresse avec un lien pour réinitialiser votre mot de passe.</p>
                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <input class="btn btn-primary btn-block fa-lg mb-3" type="submit" value="Envoyer mail"/>
                                            </div>
                                        </form>
                                        <a class="text-muted" href="inscription.php">Pas encore inscrit ?</a>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    <?php include 'footer.php' ?>
</body>

</html>