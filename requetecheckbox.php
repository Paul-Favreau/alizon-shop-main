<?php
    //la page va servir uniquement a faire les requetes bdd pour les checkbox dans la page resultatrecherche
    include("_header.php");

    //selectionner produit categorie alimentation
    
    
    @$keywords=$_SESSION['keywords'];
    
    @$mots=explode(" ",trim($keywords));//on enleve les espaces
    for($i=0;$i<count($mots);$i++){
        $kw[$i]="nom like '%".$mots[$i]."%'";
    }

    $requete="SELECT * FROM _produit WHERE ".implode(" AND ",$kw);


    if(isset($_POST['checkalimentation'])){//si la checkbox est cochée
        
        $etat=$_POST['checkalimentation']; //on regarde son etat, si elle est encore coché ou non, 
        //(si elle nest plus coché checkalimentation sera quand meme encore set, mais son etat sera a false)

        if($etat=="true"){
            
            //si elle est encore coché on ajoute a la requete la condition pour la categorie alimentation
            $requete= $requete." AND categorie='alimentation'";
            
            
        }
        

        
    }
    

    if(isset($_POST['checktextile'])){
        $etat=$_POST['checktextile'];
        if($etat=="true"){
            
            

            $requete= $requete." AND categorie='textile'";
        }
        
    }

    if(isset($_POST['checksouvenir'])){
        $etat=$_POST['checksouvenir'];
        if($etat=="true"){
            $requete= $requete." AND categorie='souvenir'";
        }
        
        
    }



    //pour récupérer la valeur des deux range, si un est set les deux sont forcément set (voir produit.js)
    if(isset($_POST['rangeMin'])&&isset($_POST['rangeMax'])){
        $valeurmin=$_POST['rangeMin'];
        $valeurmax=$_POST['rangeMax'];
        echo "Prix minimum : ".$valeurmin." €<br>";
        echo "Prix maximum : ".$valeurmax." €<br>";


        $requete= $requete." AND prixTotal>=".$valeurmin." AND prixTotal<=".$valeurmax;
    }


    if(isset($_POST['tris'])){
        $type=$_POST['tris'];
        if($type=="croissant"){
            $requete= $requete." ORDER BY prixTotal ASC";
        }
        if($type=="decroissant"){
            $requete= $requete." ORDER BY prixTotal DESC";
        }
    }

    //on envoie la requete finale
    $listeProd=$DB->query($requete);
    
    
?>
<html>
    <body>
    
    <?php if(count($listeProd)>0): ?>
            <div class="conteneur-carte-produit">
                <?php foreach( $listeProd as $produit):?>
                    <article class="carte-produit-super-trop-belle">
                        <a id="image-produit" href="detail.php?idprod=<?= $produit->idProduit; ?>" class="bouton-detail-produit">
                            <img src="<?=$produit->photo1;?>" alt="Image du produit" width="200" height="200" id="img-prod">
                        </a>                            <h3><?=$produit->nom?></h3>
                        <p><?=$produit->prixTotal?>€</p>
                        <div class="bouton-carte">
                            <a href="detail.php?idprod=<?=$produit->idProduit; ?>" class="bouton-detail-produit" id="madmad">Détail</a>
                            <a href="addpanier.php?idprod=<?= $produit->idProduit; ?>" class="btn addPanier">
                                <img src="img/icon/cart.svg" alt="Ajouter au panier" height="35px" width="35px">
                            </a>
                        </div>
                    </article>
                <?php endforeach;?>
                        
            </div>
        
    <?php else: ?>
        <p class="m-5"><strong>Désolé, nous ne trouvons pas de produit correspondant à votre recherche</p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
            
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




    <script src="js/produit.js"></script>
    <script src="js/main.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>

    
</body>

</html>

