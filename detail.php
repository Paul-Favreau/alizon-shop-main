<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="detail.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

	
	
    
    <title>Alizon - Detail</title>
    
</head>
<body>
    
    <header>
    <?php
        
        $idprod = $_GET['idprod'];
        $reponse= $DB->query("SELECT * FROM _produit where idProduit='$idprod'");
	    $query = $DB->query('SELECT * FROM _produit LIMIT 3');
       
                
        
        
	?>
    </header>
    <main>
        <div class="d-flex m-5" id="1">
        <?php foreach($reponse as $produit): ?>
        
            <div class="flex-row ">
                <div class="overlap-group4">
                    <img src="<?= $produit->photo1 ?>" alt="" class="image-2" id="image-2">

                </div>
                <div class="image-container">
                    
                    <?php if($produit->photo2 != 'null'):?>
                        <img src="<?= $produit->photo1 ?>" alt="photo produit 1" class="image-4" onclick="changeImage(this)"  id="prodDetail">
                        <img src="<?= $produit->photo2 ?>" alt="photo produit 2" class="image-3" onclick="changeImage(this)"  id="prodDetail2">
                    <?php endif; ?>
                    <?php if($produit->photo3 != 'null'):?>
                        <img src="<?= $produit->photo3 ?>" alt="photo produit 2" class="image-3" onclick="changeImage(this)"  id="prodDetail2">
                    <?php endif; ?>
                    
                </div>
                
                
            </div>
            
                <div class="justify-content-left" id="card-detail-text">
                    <h2 class="card-text" >
                           <strong>
                                <?php 
                    
                                    
                                    
                                    
                                        
                                    

                                ?>
                            </strong>
                        </h2>
                    
                        <p class="card-text text-danger" id="categorie">
                            <?php echo $produit->categorie;?>
                        </p>
                        <div class="card-text" id="prix">
                            <ul class="card-text">
                                <li class="card-text"><strong>Prix HT: <?php
                                        echo $produit->prixUnit;
                                ?> &euro;</strong>
                                </li>
                                <li><strong> Taux TVA: <?php
                                        echo $produit->tauxTVA;
                                ?> %</strong></li>
                                <li class="card-text"><strong> Prix Livraison: <?php
                                        echo $produit->prixLiv;
                                ?> &euro;</strong></li>
                                <li class="card-text"><strong>Prix TTC: <?php
                                        echo $produit->prixTotal;
                                ?> &euro;</strong></li>
                            </ul>
                        </div>
                        <div id="descrip">
                            <?php echo $produit->descript; ?>
                        
                        </div>
                        <div id="stock" >
                        <ul>
                                <li> 
                                    <?php 
                                        $stock =  $produit->stock; 
                                        if($stock == 0){
                                            echo "Stock Epuisé";
                                        }
                                        else if(($stock < $produit->seuilAlerte && $stock != 0)){
                                            echo "Peu de Stock";
                                        }
                                        else{
                                            echo "En Stock";
                                        }
                                    ?>
                            </li>
                            </ul>
                        </div>
                        
                        
                        <a href="addpanier.php?idprod=<?=$idprod; ?>"  class="btn text-dark text-center justify-content-center addPanier bg-warning" id="bouton" >Ajouter au panier</a>

                        <!-- POUR AJOUTER COMMENTAIRE-->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter un commentaire</button>

                        <!-- POUR ECRIRE LE COMMENTAIRE -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Commentaire</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="script_commentaire.php" method="POST" enctype='multipart/form-data' id="rating-form">
                                            <input type="hidden" name="idproduit" value="<?=$idprod?>">
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Note:</label>
                                                <input type="number" class="form-control" id="recipient-name" name="note" min="0" max="5" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="message-text" class="col-form-label">Commentaire:</label>
                                                <textarea class="form-control" id="message-text" name="commentaire"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="message-text" class="col-form-label">Image:</label>
                                                <input type="file" name="image" accept="image/png, image/jpeg, image/jpg">
                                            </div>
                                            <div class="star-rating">
                                                <i class="fa fa-star star" data-value="1">1</i>
                                                <i class="fa fa-star star" data-value="2"></i>
                                                <i class="fa fa-star star" data-value="3"></i>
                                                <i class="fa fa-star star" data-value="4"></i>
                                                <i class="fa fa-star star" data-value="5"></i>
                                            </div>
                                            <input type="hidden" id="selected-rating" name="rating" value="" />
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--FIN POUR AJOUTER COMMENTAIRE !-->
                        </div>
                    </div>        
        <?php endforeach; ?>
                </div>
              

            </div>


        <style>
            .conteneur-commentaire{
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
                border-top:5px solid #0062AC;
                width: 450px;
                padding: 10px;
                margin-top: 20px;
                margin-bottom: 20px;
            }
            #image-commentaire{
                max-width: 400px;
            }
            #nom-du-client-commentaire{
                align-self: flex-start;
                font-weight: bold;
            }
            #section-commentaires{
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .star-rating {
                display: inline-block;
            }

            .star-rating .fa-star {
            font-size: 2em;
            color: #ccc;
            transition: color 0.3s;
            }
            .star-rating .fa-star-gold {
                color: gold;
            }

            .star-rating .fa-star:hover {
            color: gold;
            }

            .star-rating .fa-star:hover ~ .fa-star {
            color: #ccc;
            }
        </style>
        <section id="section-commentaires">
            <h2>Commentaires</h2>
            <div class="mon-div">
                <?php
                //todo centrer les commentaires
                $idprod = $_GET['idprod'];
                $commentaireSelection = $DB->query("SELECT DISTINCT * FROM `_commentaire` INNER JOIN _client ON _commentaire.idClient=_client.idClient WHERE idProduit='$idprod'");
                //var_dump($commentaireSelection);
                ?>
                <?php foreach($commentaireSelection as $value): ?>
                <div class="conteneur-commentaire">
                    <p id="nom-du-client-commentaire">
                        <?php
                        echo $value->prenom;
                        ?>
                    </p>

                    <p id="contenu-commentaire">
                        <?php
                        echo $value->contenu;
                        // je veux commit !
                        ?>
                    </p>
                    <img id="image-commentaire" src="macron-stp-sort-nous-de-cet-iut.jpg" alt="Image">
                </div>
            </div>
            <?php endforeach; ?>
        </section>




        </div>
		<!--POUR LA NOTIFI AJOUT PANIER-->
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
   <footer>
		<?php
        include 'footer.php';
        ?>
    </footer>
    
    
    <script>
        function changeImage(a){
            document.getElementById('image-2').src = a.src;
        }
        /*var stars = document.querySelectorAll('.star');
        for (var i = 0; i < stars.length; i++) {
            stars[i].addEventListener('click', function(){
                alert('test');
                document.querySelector('#selected-rating').value = this.getAttribute('data-value');
                var selectedStar = document.querySelector('#selected-rating').value;
                var currentStar = this;
                Array.from(stars).forEach(function(star) {
                    star.classList.remove("fa-star-gold");
                });
                for(var i = 0; i < selectedStar; i++){
                    stars[i].classList.add("fa-star-gold");
                }
                
            });
        }*/

        var stars = document.querySelectorAll('.star');
        var selectedStar = document.querySelector('#selected-rating');

        for (var i = 0; i < stars.length; i++) {
            stars[i].addEventListener('mouseover', function(){
                for(var j = 0; j <= parseInt(this.getAttribute('data-value'))-1 ; j++){
                    stars[j].classList.add("fa-star-gold");
                }
            });

            stars[i].addEventListener('mouseout', function(){
                for(var j = 0; j <= parseInt(this.getAttribute('data-value'))-1 ; j++){
                    if(j < selectedStar.value)
                        stars[j].classList.add("fa-star-gold");
                    else 
                        stars[j].classList.remove("fa-star-gold");
                }
            });

            stars[i].addEventListener('click', function(){
                selectedStar.value = this.getAttribute('data-value');
                for(var j = 0; j < stars.length; j++){
                    if(j < selectedStar.value)
                        stars[j].classList.add("fa-star-gold");
                    else 
                        stars[j].classList.remove("fa-star-gold");
                }
            });
        }



        

        




       
    </script>
    
</body>
</html>
