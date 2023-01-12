<?php
    include("header.php");
    //echo 'resultat recherche';

    //on recupère les données du formulaire
    $keywords=$_GET['keywords'];
    

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
        <div id="nbr" class="p-2 text-center">
            <h3><?=count($listeProd)." ".(count($listeProd)>1?"résultats":"résultat")?></h3>
            pour la recherche "<?= $keywords?>"
            <?php
                if(isset($_GET['tri'])){
                    echo'<br>';
                    if($tri=="croissant"){
                        echo " triés par prix croissant";
                    }
                    if($tri=="decroissant"){
                        echo " triés par prix décroissant";
                    }
                }
            ?>
        </div>

        
        
        <?php if(count($listeProd)==0)://si il ne trouve rien pour la recherche?>
            <div class='text-center align-middle p-5'>
            <img src='img/recherche_vide.svg' alt='recherche vide' width='40%' height='40%'>
        </div>
        
        <?php else:?>
            <div class="text-end p-3">
                <a href="resultatrecherche.php?keywords=<?= $keywords?>&tri=croissant"><button class="btn btn-light" id="croissant"name="croissant">Trier par prix croissant</button></a>
                <a href="resultatrecherche.php?keywords=<?= $keywords?>&tri=decroissant"><button class="btn btn-light" name="decroissant">Trier par prix décroissant</button></a>
            </div>
            <div class="conteneur-carte-produit">
                    <?php foreach( $listeProd as $produit):?>
                        <article class="carte-produit-super-trop-belle">
                            <a id="image-produit" href="detail.php?idprod=<?= $produit->idProduit; ?>" class="bouton-detail-produit">
                                <img src="<?=$produit->photo1;?>" alt="Image du produit" width="200" height="200" id="img-prod">
                            </a>                            <h3><?=$produit->nom?></h3>
                            <p><?=$produit->prixTotal?>€</p>
                            <div class="bouton-carte">
                                <a href="detail.php?idprod=<?=$produit->idProduit; ?>" class="bouton-detail-produit">Détail</a>
                                <a href="addpanier.php?idprod=<?= $produit->idProduit; ?>" class="btn addPanier">
                                    <img src="img/icon/cart.svg" alt="Ajouter au panier" height="35px" width="35px">
                                </a>
                            </div>
                        </article>
                    <?php endforeach;?>
                    
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
    <script>
        //regarder ce que vaut la variable $tri
        var tri = "<?= $tri?>";
        //si tri vaut croissant
        if(tri=="croissant"){
            //on récupère le bouton croissant
            var croissant = document.querySelector("button[name='croissant']");
            //on lui ajoute la classe btn-primary
            croissant.classList.add("btn-primary");
            //on lui enlève la classe btn-light
            croissant.classList.remove("btn-light");
        }
        //si tri vaut decroissant
        if(tri=="decroissant"){
            //on récupère le bouton decroissant
            var decroissant = document.querySelector("button[name='decroissant']");
            //on lui ajoute la classe btn-primary
            decroissant.classList.add("btn-primary");
            //on lui enlève la classe btn-light
            decroissant.classList.remove("btn-light");
        }
        
        

    </script>
</body>
</html>