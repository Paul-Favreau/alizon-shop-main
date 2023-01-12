<?php
include("_header.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta charset="utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        
        <title>Alizon | Administration</title>
        <link rel="icon" type="image/png" sizes="16x16" href="icon.png">    <!-- Icone de la page -->
        <link rel="stylesheet" href="style.css">    <!-- Feuille de style -->
        <!-- Intégration des fichiers Bootstrap -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">   <!-- définition d'un conteneur fluid -->
            <div class="row" >          <!-- ligne définie avec 2 colonnes -->
                <nav class="col-3 vingt">     <!-- colonne de navigation -->
                    <div class="d-flex justify-content-around">
                        <!-- <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href='index.php'">Accueil</button> -->
                        <a href="index.php" id="dashboard-title">DashBoard</a>
                    </div>
                    <div class="alignez-vous-bordel">
                        <a href="user.php">Gestion des comptes</a>
                        <a href="comment.php">Gestion des commentaires</a>
                    </div>
                </nav>
            <main class="col-9">
                <header>
                    <h1>Accueil</h1>
                </header>
                <h2>Statistiques globales :</h2>
                <div class="d-flex justify-content-around">
                    <article>
                        <?php
                        $req = $DB->query('SELECT COUNT(*) as col FROM _client');
                        echo $req[0]->col;
                        ?>
                        <h5>Compte client</h5>
                    </article>
                    <article>
                    <?php
                        $req = $DB->query('SELECT COUNT(*) as col FROM _commentaire');
                        echo $req[0]->col;
                        ?>
                        <h5>Commentaires</h5>
                    </article>
                    <article>
                    <?php
                        $req = $DB->query('SELECT COUNT(*) as col FROM _commentaire');
                        echo $req[0]->col;
                        ?>
                        <h5>Commentaire signalé</h5>
                    </article>
                </div>
                <br/>
                <h2>Notifications : </h2>
            </main>
        </div>
    </div>
    </body>
</html>