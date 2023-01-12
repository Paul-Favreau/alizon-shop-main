
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, inditial-scale=1.0">
    <meta property="og:title" content="Alizon">
    <meta property="og:image" content="./favicon.ico">
    <meta property="shortcut icon" type="image/png" href="favicon.ico">
    <link rel="icon" href="img/icon/logo.svg"/>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="stopHover.css">

    <title>Alizon - Adresse</title>
</head>

<body style="background-color:#eee">
    <?php
    // include header
    include "header.php";
    //$_SESSION['id'] = $_GET['id']; //debug
    if (!isset($_SESSION['id'])) { // si pas de session, redirige vers connexion avec message
        header('Location: connexion.php?notlogged=1');
    }
    $db = new DB();
    $client = $db->query('SELECT * FROM _client WHERE idClient = ?', array($_SESSION['id'])); //prendre toutes les infos du client pour récupérer que son adresse, ville et code postal. je sais que c'est pas très opti mais hein bon
    $adresse = $client[0]->adresse;
    $ville = $client[0]->ville;
    $codePostal = $client[0]->codePostal;
    $i = 0; // compteur
    ?>

    <!-- Il se peut qu'on ai besoin de moins d'infos que ce que j'ai mis, donc si jamais c'est le cas hésitez pas a les enlever -->

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h5 class="mb-0">Livraison</h5>
                    <div class="form-check d-flex mb-2">
                        <input class="form-check-input me-2" type="checkbox" value="" id="disable" onclick="disable();
                            if (document.getElementById('disable').checked) {
                                document.getElementById('adresse').value = '<?php echo $adresse ?>';
                                document.getElementById('codePostal').value = '<?php echo $codePostal ?>';
                                document.getElementById('ville').value = '<?php echo $ville ?>'; 
                            } else {
                                document.getElementById('adresse').value = '';
                                document.getElementById('codePostal').value = '';
                                document.getElementById('ville').value = '';
                            }"/>
                        <label class="form-check-label" for="disable">
                            Adresse de livraison identique à celle indiquée sur votre compte?
                        </label>
                    </div>
                </div>
                <div class="card-body" id="stuff">
                    <form action="#" method="post">
                        <!-- Text input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="adresse" class="form-control actualform" required="required"/>
                            <label class="form-label" for="adresse">Adresse</label>
                        </div>

                        <!-- 2 column grid layout with text inputs -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="codePostal" class="form-control actualform" required="required"/>
                                    <label class="form-label" for="codePostal">Code Postal</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="ville" class="form-control actualform" required="required"/>
                                    <label class="form-label" for="ville">Ville</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h5 class="mb-0">Récapitulatif</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php
                        //selectionne les produits que le client a dans son panier
                        $prixTotal = 0;// prix total du panier, on l'init
                        $idtab = $DB->query('SELECT idProduit FROM _panier WHERE idClient = ?', array($_SESSION['id']));
                        $ids=array();
                        foreach ($idtab as $id) {
                            $ids[] = $id->idProduit;
                        }
                        if(empty($ids)){
                            $products=array();
                        }
                        else{
                            

                           
                            
                            $products = $DB->query('SELECT * FROM _produit WHERE idProduit IN ('.implode(',',$ids).')');
                            $getPanier = $DB->query('SELECT * FROM _panier WHERE idClient = ?', array($_SESSION['id']));
                        }
                        foreach ($products as $i) { // $value est mentionné uniquement pour utiliser la clé $i.
                            //var_dump($i);
                            $idCOOL=$i->idProduit; //pour recuperer l'id du produit

                            
                            
                            $quantiteTAB=$DB->query('SELECT qte FROM _panier WHERE idProduit = ? AND idClient = ?', array($idCOOL, $_SESSION['id']));

                           $quantite=$quantiteTAB[0]->qte; //pour recup la quantite, avant c'est sous forme de tableau bizarre
                           $prix=$i->prixTotal; //on recup le prix du produit
                           $prixTotalArticle=$prix*$quantite; //pour chaque article on regarde le total
                           $prixTotal=$prixTotalArticle+$prixTotal; //prix total panier update

                            
                            echo "<li class='list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0'>" . "<span>".$i->nom."</span>"."<span>".$quantite."</span>". $prixTotalArticle . "€</li>" . PHP_EOL;

                                                       
                        }


                        /*
                        foreach ($products as $i) { // $value est mentionné uniquement pour utiliser la clé $i.
                            foreach ($getPanier as $ii){
                                echo "<li class='list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0'>" . $i->nom ."<span>"."</span>". $ii->qte. "<span>". $i->prixTotal . "€</span></li>" . PHP_EOL;

                            }                            
                        }*/
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Frais de livraison
                            <span>-.--€</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                            <div>
                                <strong>Total</strong>
                            </div>
                            <span><strong><?=$prixTotal?>€</strong></span>
                        </li>
                    </ul>
                    <a href="valid_paie.php">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Valider</button>
                    </a>
                    <a href="panier.php">
                    <button type="button" class="btn btn-secondary btn-lg btn-block" onclick="header('Location: connect.php')">Retour au panier</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="./js/main.js"></script>
        
        <?php include "./footer.php"; ?>
</body>

</html>