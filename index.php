
<?php

require('header.php');

$query = $DB->query('SELECT * FROM _produit LIMIT 12');
$query2 = $DB->query('SELECT * FROM _produit LIMIT 3');
unset($_SESSION);

?>
<html>
    <head>
        <title>Alizon</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="card.css">
        <link rel="icon" href="img/icon/logo.svg"/>
        <link href="bootstrap/css/bootstrap-grid.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap-reboot.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div class=" row text-center">
        <?php
        if (isset($_SESSION['nom'])) {
            echo '<h3> Bonjour ', $_SESSION['nom'], ' ,
					Bienvenue Sur Alizon </h3>';
            echo "<div class='ml-3'><form action='clear_session.php'> <input type='submit' value='Se déconnecter'/> </form></div>" . PHP_EOL;
        }
        ?>
    </div>

        <div class="bandeau-presentation">
            <div class="panneau-gauche">
                <style>
                    .panneau-gauche h2{
                        color: #fff;
                    }
                </style>
                <h2>Bienvenue sur Alizon</h2>
            </div>
            <div class="panneau-droit">
                <p>Découvrez l'histoire passionnante de notre entreprise bretonne</p>
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley" target="_blank" id="bouton-bandeau-decouvrir">Découvrir</a>
            </div>
        </div>

        <div class="bandeau-categorie">
            <a href="resultatrecherche.php?keywords=bol">
                <img src="img/bandeau-index/bol-breton-card.png" alt="Bandeau de présentation des bols bretons personnalisés">
            </a>
            <a href="resultatrecherche.php?keywords=alcool">
                <img src="img/bandeau-index/alcool-card.png" alt="Bandeau de présentation des alcools de bretagne">
            </a>
            <a href="resultatrecherche.php?keywords=gateau">
                <img src="img/bandeau-index/gateau-breton-card.png" alt="Bandeau de présentation des gâteaux bretons">
            </a>
        </div>
        <div class="conteneur-carte-produit" id="ascenseur">
            <?php foreach( $query as $produit):?>
            <article class="carte-produit-super-trop-belle">
                <a id="image-produit" href="detail.php?idprod=<?= $produit->idProduit; ?>" class="bouton-detail-produit">
                    <img src="<?=$produit->photo1;?>" alt="Image du produit" width="200" height="200" id="img-prod">
                </a>
                <h3><?php echo $produit->nom;?></h3>
                <p><?php echo $produit->prixTotal; ?> €</p>
                <div class="bouton-carte">
                    <a href="detail.php?idprod=<?= $produit->idProduit; ?>" class="bouton-detail-produit">Détail</a>
                    <a href="addpanier.php?idprod=<?= $produit->idProduit; ?>"class="addPanier">
                        <img src="img/icon/cart.svg" alt="Ajouter au panier" height="35px" width="35px">
                    </a>
                </div>
            </article>
            <?php endforeach;?>
        </div>
        <!--POUR LA NOTIF AJOUT PANIER-->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
                    <div class="toast-header">
                        <img src="img/icon/cart.svg" class="rounded me-2" alt="notification ajouter panier">
                        <strong class="me-auto">Notification</strong>
                        <small>Maintenant</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <strong>Produit ajouté au panier !</strong>
                    </div>
                </div>
        </div>
        <!--FIN NOTIF AJOUT PANIER-->
    <?php 
    require('footer.php');
    ?>
    <script src="./js/jquery.min.js"></script> <!-- Promis c'est que pour Bootstrap 😇 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>