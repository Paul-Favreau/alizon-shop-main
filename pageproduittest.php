<?php
    include("header.php");
    //echo 'resultat recherche';

    //on recupère les données du formulaire
    @$keywords=$_GET['keywords'];

    //pour pouvoir l'utiliser dans requetecheckbox.php
    $_SESSION['keywords']=$keywords;

    @$mots=explode(" ",trim($keywords));//on enleve les espaces
    for($i=0;$i<count($mots);$i++){
        $kw[$i]="nom like '%".$mots[$i]."%'";
    }
    

    //pour trier
    $tripar=" ";
    if(isset($_GET['tri'])){
        $tri=$_GET['tri']; //on regarde quel tri a été choisi
        if($tri=="croissant"){
            $tripar=" ORDER BY prixTotal ASC";
        }
        if($tri=="decroissant"){
            $tripar=" ORDER BY prixTotal DESC";
        }
    }


    //si un produit a exactement le nom recherché on le selectionne, il aura comme cela la première place lors de l'affichage

    $listeProd=$DB->query("SELECT * FROM _produit WHERE nom='$keywords'".$tripar);
    if(count($listeProd)>0){
        //dans notre base de donnée deux produits ne peuvent pas avoir le même nom donc on peut faire comme cela
        //on garde cette variable car après on va faire une recherche sans prendre en compte ce produit
        $nomProdexact=$listeProd[0]->nom;
    }
    else{
        //si il n'y a pas de produit avec le nom exact recherché on met une variable vide pour éviter tout bug
        $nomProdexact="";
    }

    //on fait ensuite la recherche avec ce qui a été entré dans la barre de recherche
    if($keywords=="alimentation"||$keywords=="alimentations"){
        $requete=$DB->query("SELECT * FROM _produit WHERE categorie='alimentation'".$tripar);
    }
    else if($keywords=="textile"||$keywords=="textiles"){
        $requete=$DB->query("SELECT * FROM _produit WHERE categorie='textile'".$tripar);
    }
    else if($keywords=="souvenirs"||$keywords=="souvenir"){
        $requete=$DB->query("SELECT * FROM _produit WHERE categorie='souvenir'".$tripar);
    }
    else if($keywords==""){
        $requete=$DB->query("SELECT * FROM _produit".$tripar);
    }
    else{
        //$kdr=$DB->query("SELECT * FROM _produit WHERE ".implode(" OR ",$kw).$tripar);
        
        $requete=$DB->query("SELECT * FROM _produit WHERE ".implode(" OR ",$kw).$tripar);
        

        
    }
    //on fusionne les deux tableaux, si le produit a exactement le nom recherché il sera en premier
    //si il n'y a pas de produit avec le nom exact recherché on aura juste le tableau de la recherche
    $listeProd=array_merge($listeProd,$requete);
    $listeProd=array_unique($listeProd,SORT_REGULAR);


    $_SESSION['listeProd']=$listeProd;


?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/icon/logo.svg" />
        <link rel="stylesheet" href="card.css">
        <link rel="stylesheet" href="index.css">
        <link href="bootstrap/css/bootstrap-grid.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap-reboot.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <title>Alizon - Recherche</title>
    </head>
    <body>
        <main>
            <?php if(count($listeProd)==0)://si il ne trouve rien pour la recherche?>
                <div class='text-center align-middle p-5'>
                <img src='img/recherche_vide.svg' alt='recherche vide' width='50%' height='50%'>
                <p class="m-5"><strong>Désolé, aucun produit ne correspond à votre recherche:</strong> "<i><?=$keywords?></i>"<strong>, <a href="index.php">retourner à l'accueil</a></strong></p>
            </div>
            
            <?php else:?>
                <style>
                    .on-centre-tous-ca-bozo-stp{
                        display: flex;
                        justify-content: space-evenly;
                        align-items: center;
                        flex-wrap: wrap;

                    }
                </style>
            <div class="on-centre-tous-ca-bozo-stp">
                <div class="">
                    <label>Alimentation</label>
                    <input type="checkbox" id="checkalimentation" >

                </div>
                <div class="div">
                    <input type="checkbox" id="checktextile" >
                    <label>Souvenir</label>
                </div>
                <div class="">
                    <label>Textile</label>
                    <input type="checkbox" id="checksouvenir" >

                </div>
                <div class="">
                    <label>Prix Minimum</label>
                    <input type="range" id="rangeMin" min="0" max="100" value="0">

                </div>
                <div class="">
                    <label>Prix Maximum</label>
                    <input type="range" id="rangeMax" min="0" max="100" value="100">

                </div>
                <div class="">
                    <label for="tris">Tris</label>
                    <select name="tris" id="tris">
                        <option value="defaut">Par défaut</option>
                        <option value="croissant">Du moins cher au plus cher</option>
                        <option value="decroissant">Du plus cher au moins cher</option>
                    </select>
                </div>

            </div>

                <?php //recuperer valeur range min
                    
                ?>

                <div id="didier"></div><!--C'est ici que seront affiche les produits en ajax, grace a l'id didider-->

                <div class='conteneur'>
        <!-- <h1>Confirmation de votre paiement</h1>
        <p>Votre paiement de $price € a bien été accepté par notre organisme de paiement</p>
        <p>Alizon vous remercie de votre confiance</p>
        <button type='button' id='livraisons' name='submit' class='btn btn-primary'  onclick='window.location.href = `./listeCommandes.php`'>Voir les commandes effectués</button>
        <button type='button' id='accueil' name='submit' class='btn btn-primary'  onclick='window.location.href = `./index.php`'>Retour à l'accueil</button> -->
    </div>

            <?php endif; ?>
            


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
        </main>
        <?php include("footer.php"); ?>

        
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap.bundle.min.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="./js/produit.js"></script>
        <script src="./js/main.js"></script>
    </body>
</html>


