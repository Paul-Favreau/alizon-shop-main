
<?php

require('header.php');

$query = $DB->query('SELECT * FROM _produit LIMIT 6');
$query2 = $DB->query('SELECT * FROM _produit LIMIT 3');
unset($_SESSION);

?>

<!doctype html>
<html lang="en">

<head>
    <title>Alizon</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=no">
    <link rel="icon" href="img/icon/logo.svg"/>
    <link href="index.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-grid.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-reboot.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<style>
    /* Mettre ça car sinon le footer sera mal placé*/
    body{
        position: relative;
    }
</style>
<header>
    <?php

    if (isset($_GET['success'])){
        echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Vous êtes bien inscrit</div>'.PHP_EOL;
    }
    if(isset($_GET['insert'])){
        echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Vos données ont bien été mises à jour</div>'.PHP_EOL;
    }
    if(isset($_GET['idprod'])){
        echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Produit ajouter au panier</div>'.PHP_EOL;
    }
    ?>
</header>
<br>
<main>
    <div class=" row text-center">
        <?php

        if (isset($_SESSION['nom'])) {
            echo '<h3> Bonjour ', $_SESSION['nom'], ' ,
					Bienvenue Sur Alizon </h3>';
            echo "<div class='ml-3'><form action='clear_session.php'> <input type='submit' value='Se déconnecter'/> </form></div>" . PHP_EOL;
        }



        ?>

    </div>

    <div class="container">
        <?php include "carousel.php"; ?>
    </div>

    <h3 class="m-4">Nouveaux Produits</h3>
    <div class="row  col-sm-12 col-xs-12  justify-content-center">
        <?php foreach( $query as $produit):?>
            <div class="card justify-content-center carte  border border-dark" id="index">

                <h2 class="text-center "><?php echo $produit->nom; $idprod = $produit->idProduit; ?></h2>
                <img src="<?=$produit->photo1;?>" class="card-img-top w-50 h-50 " alt="Chouchen" >
                <div class="card-body ">
                    <div class="card-body text-center">
                        <p class="card-text"><?php

                            echo $produit->categorie; ?></p>
                        <p class="card-text text-dark border border-dark  prix mx-auto"><strong><?php echo $produit->prixTotal; ?> &euro;</strong></p>

                        <a href="detail.php?idprod=<?= $idprod; ?>" class="btn  text-white text-center justify-content-center detail" id="btn-violet">Details</a>


                        <a href="addpanier.php?idprod=<?= $idprod; ?>" class="btn addPanier"><img src="img/icon/cart.svg" alt="Ajouter au panier" height="35px" width="35px"></a>

                    </div>


                </div>


            </div>
        <?php endforeach; ?>


    </div>

    <br> <br>
    <h3 class="m-4">Produits les plus vendus</h3>

    <div class="row  col-sm-12 col-xs-12 justify-content-center ">
        <?php foreach( $query2 as $produit):?>
            <div class="card justify-content-center carte  border border-dark "  id="index">

                <h2 class="text-center justify-content-center "><?php echo $produit->nom; $idprod = $produit->idProduit; ?></h2>
                <img src="<?=$produit->photo1;?>" class="card-img-top w-50 h-50 " alt="Chouchen" height="auto" width="auto">
                <div class="card-body ">
                    <div class="card-body text-center">
                        <p class="card-text"><?php

                            echo $produit->categorie; ?></p>
                        <p class="card-text text-dark border border-dark  prix mx-auto"><strong><?php echo $produit->prixTotal; ?> &euro;</strong></p>
                        <div class="ratings">
                            <i class="fa-regular fa-star "></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <a href="detail.php?idprod=<?= $idprod; ?>" class="btn text-white text-center justify-content-center detail" id="btn-violet">Details</a>


                        <a href="addpanier.php?idprod=<?= $idprod; ?>" class="btn addPanier"><img src="img/icon/cart.svg" alt="Ajouter au panier" height="35px" width="35px"></a>

                    </div>


                </div>


            </div>
        <?php endforeach; ?>


    </div>
    </div>

    <br> <br><br> <br><br> <br>
</main>
<?php include 'footer.php';?>
<script src="./js/jquery.min.js"></script> <!-- Promis c'est que pour Bootstrap 😇 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!--<script src="./js/main.js"></script>-->


</body>

</html>
