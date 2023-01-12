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

    <title>Alizon - Portail de connexion</title>
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
        }
        if (isset($_GET['fail'])){
            echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Identifiants incorrects</div>'.PHP_EOL;
        }
        if (isset($_GET['notlogged'])){
            echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Vous devez être connecté pour accéder à cette page</div>'.PHP_EOL;
        }
        if (isset($_GET['blocked'])){
            echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Votre compte est bloqué. Veuillez contacter votre administrateur.</div>'.PHP_EOL;
        }
        if (isset($_GET['resetsuccess'])){
            echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Votre mot de passe a été changé avec succès.</div>'.PHP_EOL;
        }
    ?>

    <section class="h-100 gradient-form">
        <div class="position-relative">
            <h1 class="text-center" style="padding-top:.5em;">Accès client</h1>
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black">
                            <a type="button" class="btn-close position-relative top-0 start-0" href="index.php" aria-label="Close"></a>
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">
                                        <form action="verificationConnexion.php" method="post">
                                            <h4 class="mb-4">Connectez-vous <img src="img/logo.png" alt="Logo Alizon" width="50" height="50"></h4>
                                            <div class="form-outline mb-4">
                                                <input type="email" name="email" class="form-control" placeholder="Adresse E-Mail" />
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="password" name="password" class="form-control" placeholder="Mot de passe" />
                                            </div>

                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <input class="btn btn-primary btn-block fa-lg mb-3" type="submit" value="Connexion"/>
                                            </div>
                                        </form>
                                        <a class="text-muted" href="forgotmdp.php">Mot de passe oublié ?</a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card-body px-3 py-4 p-md-5 mx-md-4">
                                        <h4 class="mb-4">Inscrivez-vous</h4>
                                        <p class="mb-0">Vous n'avez pas de compte ? Inscrivez-vous !</p>
                                        <p class="mb-0">Pour commander sur Alizon vous devez être connecté.</p>
                                        <form class="text-center pt-1 mb-5 pb-1" action="inscription.php">
                                        <input class="btn btn-primary btn-block fa-fg mb-3" style="margin-top: 48px;" type="submit" value="Inscription"/>
                                    </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script src=".bootstrap/js/bootstrap.min.js"></script>
    
        <br>
        <br>
        <br>
        <br>
        <br>
    <?php include 'footer.php' ?>
</body>

</html>