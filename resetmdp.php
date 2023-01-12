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

    <title>Alizon - Changer de mot de passe</title>
</head>

<body style="background-color:#eee">
<style>
    body{
        position:relative;
    }
</style>
    <?php include "header.php"; ?>
    <?php
        if (isset($_GET['token'])) { // On bouge le token du get a une session pour pas qu'il puisse être volé après
            $_SESSION['token'] = $_GET['token'];
            header("Location:resetmdp.php");
        }
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
            $currenttime = date('Y-m-d H:i:s', strtotime('now'));
            //$verify = $DB->query("select * from _client where resettoken='$token'");
            //if ($verify[0]->resettokenexp < $currenttime) {
                //echo "whoops, token expired at ".$verify[0]->resettokenexp.". Current time is ".$currenttime.".";
                //header('Location:forgotmdp.php?expired=1');
            //}
        } if (isset($_GET['fail'])){
            echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Token invalide.</div>'.PHP_EOL;
        } if (isset($_GET['oops'])) {
            echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Les mots de passe ne correspondent pas.</div>'.PHP_EOL;
        } if (isset($_GET['sent'])){
            echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Un mail vous a été envoyé avec votre token pour réinitialiser votre mot de passe.</div>'.PHP_EOL;
        }
    ?>

    <section class="h-100 gradient-form">
        <div class="position-relative">
            <h2 class="text-center" style="padding-top:.5em;">Réinitialiser mon mot de passe</h2>
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-7">
                        <div class="card rounded-3 text-black">
                            <a type="button" class="btn-close position-relative top-0 start-0" href="index.php" aria-label="Close"></a>
                            <div class="row g-0">
                                
                                    <div class="card-body p-md-5 mx-md-4">
                                        <form action="verificationReset.php" method="post">
                                            <div class="form-outline mb-4">
                                                <input name="token" class="form-control" placeholder="Token" <?php if(isset($_SESSION['token'])) { echo "type='hidden' value=".$_SESSION['token'];} else { echo "type='text'";}; ?> required/>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <input type="password" name="mdp" class="form-control" placeholder="Nouveau mot de passe" required/>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <input type="password" name="confirmmdp" class="form-control" placeholder="Confirmer mot de passe" required/>
                                            </div>
                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <input class="btn btn-primary btn-block fa-lg mb-3" type="submit" value="Changer mot de passe"/>
                                            </div>
                                        </form>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="./main.js"></script>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    <?php include 'footer.php' ?>
</body>

</html>