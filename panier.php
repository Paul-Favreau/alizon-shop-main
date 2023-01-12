<html>
    <head>
        <title>Alizon - Panier</title>
        <meta charset="utf-8">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="panier.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <link rel="icon" href="img/icon/logo.svg"/>
        <script src=bootstrap/js/bootstrap.bundle.min.js></script>
        <script src=bootstrap/js/bootstrap.bundle.js></script>
        <script src=bootstrap/js/bootstrap.min.js></script>
    </head>
    <body>
        <style>
            body{
                position:relative;
            }
        </style>

        <?php require('header.php');
            if(!isset($_SESSION['id'])){ //si l'utilisateur est pas co
                $prixTotal = $panier->total();// Pour que noah récupère le prix total
                //var_dump($prixTotal);// ok marche bien
            }
            
            
        
        
        
            //ATTENTION DANS CE FICHIER ON VA DES LE DEBUT REGARDER SI LA PERSONNE EST CONNECTEE OU NON
            // CA NOUS MULTIPLIE LES LIGNES DE CODE PRESQUE PAR 2 MAIS CEST VISUELLEMENT PLUS SIMPLE A COMPRENDRE
            // JAURAIS PU FAIRE AUTREMENT MAIS IL Y AURAIT EU ENORMEMENT DE IF ET DE ELSE, ON S'Y SERAIT PERDU RAPIDEMENT
            //ATTENTION CEST PAS LE VRAI HEADER NI FOOTER
            //DANS LA TABLE PANIER LE PRIX affiché pour le produit est le prix tva comprise, pareil pour le prix total ?>
        <main>
            
           

            <?php if(!isset($_SESSION['id'])): //si lutilisateur nest pas connecte?>

                <?php if($panier->count()<1): //on regarde si son panier est vide?>
                    <div class="text-center align-middle p-5">
                        
                        <img src="img/panier_vide.svg" alt="panier vide" width="30%" height="30%">
                        <br><br>
                        <p><strong>Oups on dirait que votre panier est vide, <a href="index.php">retourner à l'accueil</a></strong></p>
                    </div>
                <?php else: //sinon on affiche le panier?>
                    <div class="m-5 pb-1 pt-1 shadow-sm">
                        <h3>Mon Panier</h3>
                        <form method="POST" action="panier.php">
                            <table class="table table">
                                
                                <trbody>
                                    <?php
                                    
                                        $ids = array_keys($_SESSION['panier']); //on récupère les clés du panier
                                      
                                        
                                        if(empty($ids)){
                                            $products = array(); //sinon bug 
                                        }
                                        else{
                                            $products = $DB->query('SELECT * FROM _produit WHERE idProduit IN ('.implode(',',$ids).')'); //on récupère les produits qui ont les id du panier dynamiquement
                                            //$product=$DB->query('SELECT * FROM produit WHERE idProduit IN (1,2)'); // CA CEST SI CETAIT PAS EN DYNAMIQUE
                                        }
                                        
                                        
                                        //var_dump($products);
                                        foreach($products as $produit):
                                    ?>
                                        <tr class="col-md-1">
                                            <th scope="row" width="200px"><img src="<?=$produit->photo1?>" alt="produit<?=$produit->idProduit ?>" width="100" height="100" class="d-block mx-auto"></th>
                                            <td class="text-center align-middle"><strong class="d-sm-block d-none">nom du produit</strong><p><?= $produit->nom ?></p></td>
                                            
                                            <td class="text-center align-middle" width="200px"><strong class="d-sm-block d-none">quantité</strong><p><input type="number" class="text-center form-control" name="panier[quantite][<?= $produit->idProduit; ?>]" value="<?= $_SESSION['panier'][$produit->idProduit];?>" min="0"></p></td>
                                            <td class="text-center align-middle" width="200px"><strong class="d-sm-block d-none">prix</strong><p><?=number_format($produit->prixTotal,2,',',' '); ?>€</p></td>
                                            <td class="text-center" width="200px"><a href="panier.php?delPanier=<?=$produit->idProduit?>"><img class="mt-4" src="img/icon/poubelle.svg" width="50" height="50"></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                

                                </trbody>
                            </table>
                            <input type="submit" value="recalculer" class="btn text-light d-none" id="btn-violet"><!-- je le met en invisible on doit l'avoir
                            pour pouvoir modifier la quantitée -->
                        </form>
                        <div class="text-end">
                            <strong>Total: <?= number_format($panier->total(),2,',',' ');?> € &nbsp; </strong>
                        </div>
                    </div>
                            <div class="text-end m-5">
                                
                                <!--<input type="submit" name="deltout" value ="Vider tout" class="btn btn-primary ">-->
                                <form action="panier.php" method="post">
                                    <input type="hidden" name="deltout" >
                                    
                                    <button type="button" class="btn btn-danger btn-lg me-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Vider tout</button>
                                    <a href="connexion.php" class="btn btn-primary btn-lg ">Valider</a>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Attention !</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    
                                                    Voulez-vous vraiment supprimer tout le panier ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-lg " data-bs-dismiss="modal">Non</button>
                                                    <button type="submit" class="btn btn-primary btn-lg" aria-label="Close">Oui</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        
                <?php endif; //fin afficher panier?>





            <?php else: //sinon si le client est connecté?>
                <?php
                
                //on regarde si le client est dans la table panier et dona a un panier
                $existe= $DB->query('select * from _panier where idClient=:id', array('id'=>$_SESSION['id']));
               
                if(empty($existe)): //si le client n'a pas de panier?>
                    <div class="text-center align-middle p-5">
                        
                        <img src="img/panier_vide.svg" alt="panier vide" width="50%" height="50%">
                        <br><br>
                        <p><strong>Oups on dirait que votre panier est vide, <a href="index.php">retourner à l'accueil</a></strong></p>
                    </div>
                    <?php $prixTotal=0;?>
                <?php else: //sinon on affiche le panier?>

                    <div class="m-5 pb-1 pt-1 shadow-sm">
                        <h3>Mon Panier</h3>
                        <form method="POST" action="panier.php">
                            <table class="table table-bordered">
                                
                                <trbody>
                                    <?php
                                        
                                        
                                        
                                        //on recupere tous les idproduit qui sont dans le panier du client , mais c'est sous forme d'objet
                                        $idtab = $DB->query('select idProduit from _panier where idClient=:id', array('id'=>$_SESSION['id']));
                                        

                                        $ids=array(); //tableau qui va contenir juste les id ex(1,2,5)
                                        foreach($idtab as $id){
                                            $ids[]=$id->idProduit; //on ajoute les id dans le tableau
                                        }
                                        
                                        if(empty($ids)){
                                            $products = array(); //sinon bug 
                                        }
                                        else{
                                            
                                            //on prend toutes les infos des produit qui sont dans le panier du client
                                            $products = $DB->query('SELECT * FROM _produit WHERE idProduit IN ('.implode(',',$ids).')');
                                            
                                        }
                                        
                                        function totalClient(){
                                            //pour pouvoir utiliser les variable que j'ai init juste au dessus
                                            global $DB;
                                            global $ids;
                                            global $products;
                                          
                            

                                            $total=0;
                                            if(empty($products)){
                                                return 0;
                                            }
                                            else{
                                                foreach($products as $produit){ 
                                                    //on recupere la quantite du produit dans le panier du client, il faut aller dans la table panier // cest sous forme d'objet
                                                    $quantiteOBJ=$DB->query('select qte from _panier where idProduit=:idProduit and idClient=:idClient', array('idProduit'=>$produit->idProduit, 'idClient'=>$_SESSION['id']));
                                                    //si quantiteOBJ est vide c'est que le produit n'est plus dans le panier
                                                    if(!empty($quantiteOBJ)){
                                                        $quantite=$quantiteOBJ[0]->qte; //on recupere la quantite
                                                        $prix=$produit->prixTotal; //on recupere le prix
                                                        $total+=$prix*$quantite; //on fait le total
                                                    }
                                                    

                                                }

                                            }
                                            return $total;
                                        }

                                        //pour supprimer un produit du panier quand click sur la poubelle
                                        if(isset($_GET['delProduitClient'])){
                                            $DB->query('delete from _panier where idProduit=:idProduit and idClient=:idClient', array('idProduit'=>$_GET['delProduitClient'], 'idClient'=>$_SESSION['id']));
                                            //mettre produit a vide
                                            
                                            //sinon il faut actualiser manuellement 
                                            
                                            echo'<script>
                                                window.location.href = "panier.php";
                                            </script>';

                                        }
                                        //pour supprimer tout le panier quand click sur le bouton vider tout
                                        if(isset($_POST['deltoutClient'])){
                                            $DB->query('delete from _panier where idClient=:idClient', array('idClient'=>$_SESSION['id']));
                                            $products = array(); //sinon bug

                                            //sinon ça nous met juste un panier avec rien dedans
                                            echo'<script>
                                                window.location.href = "panier.php";
                                            </script>';
                                            
                                            
                                        }

                                        

                                        
                                        //echo('debut');
                                        //var_dump($products);
                                        //echo('fin');
                                        foreach($products as $produit):
                                            //on recupere la quantite du produit dans le panier du client, il faut aller dans la table panier // cest sous forme d'objet
                                            $quantiteOBJ=$DB->query('select qte from _panier where idProduit=:idProduit and idClient=:idClient', array('idProduit'=>$produit->idProduit, 'idClient'=>$_SESSION['id']));
                                            if(!empty($quantiteOBJ)){
                                                $quantite=$quantiteOBJ[0]->qte; //on recupere la quantite du produit qu'on va afficher
                                            }


                                            
                                            
                                            
                                    ?>
                                        <tr class="col-md-1">
                                            <th scope="row" width="200px"><img src="<?=$produit->photo1 ?>" alt="produit<?=$produit->idProduit ?>" width="100" height="100" class="d-block mx-auto"></th>
                                            <td class="text-center"><strong class="d-sm-block d-none">nom du produit</strong><p><?= $produit->nom ?></p></td>
                                           
                                            <td class="text-center" width="200px"><strong class="d-sm-block d-none">quantité</strong><p><input type="number" class="text-center" name="panierClient[quantite][<?= $produit->idProduit; ?>]" value="<?=$quantite?>"></p></td>
                                            <td class="text-center" width="200px"><strong class="d-sm-block d-none">prix</strong><p><?=number_format($produit->prixTotal,2,',',' '); ?>€</p></td>
                                            <td class="text-center" width="200px"><a href="panier.php?delProduitClient=<?=$produit->idProduit?>" class="supprimer"><img class="mt-4" src="img/icon/poubelle.svg" width="50" height="50"></a></td>
                                            
                                        </tr>
                                        <?php 
                                            //POUR MODIFIER LA QUANTITE DANS LA TABLE PANIER,ET AFFICHER LA BONNE QUANTITE DANS LE CHAMPS, CA MARCHE NE TOUCHEZ PAS
                                            if(isset($_POST['panierClient'])):
                                                $newQ=$_POST['panierClient']['quantite'][$produit->idProduit];
                                                $DB->query('update _panier set qte=:qte where idProduit=:idProduit and idClient=:idClient', array('qte'=>$newQ, 'idProduit'=>$produit->idProduit, 'idClient'=>$_SESSION['id']));
                                                if($newQ==0){ //si le mec a mis 0 comme nouvelle quantité
                                                    
                                                    $DB->query('delete from _panier where idProduit=:idProduit and idClient=:idClient', array('idProduit'=>$produit->idProduit, 'idClient'=>$_SESSION['id']));
                                                }
                                                //header('Location: panier.php');
                                                
                                            
                                        ?>
                                            <script>
                                                window.location.href = "panier.php";
                                            </script>
                                        <?php endif; ?>
                                           
                                        
                                            
                                        
                                    <?php endforeach; ?>
                                                

                                

                                </trbody>
                            </table>
                            <input type="submit" value="recalculer" class="btn btn-primary d-none"><!-- je le met en invisible on doit l'avoir
                            pour pouvoir modifier la quantitée -->
                        </form>
                            <div class="text-end">
                                <strong>Total: <?= totalClient()?> € &nbsp; </strong>
                            </div>
                    </div>
                            <div class="text-end m-5">
                                
                                <!--<input type="submit" name="deltout" value ="Vider tout" class="btn btn-primary ">-->
                                
                                <form action="panier.php" method="post">
                                    <input type="hidden" name="deltoutClient" >
                                    <button type="button" class="btn btn-primary btn-lg  me-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Vider tout</button>
                                    <a href="livrer.php" class="btn btn-primary btn-lg">Valider</a>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Attention !</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    
                                                    Voulez-vous vraiment supprimer tout le panier ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-lg" data-bs-dismiss="modal">Non</button>
                                                    <button type="submit" class="btn btn-primary btn-lg" aria-label="Close">Oui</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        
                        
                        <?php
                        $prixTotal=totalClient(); //POUR QUE NOAH RECUPERE LE PRIX TOTAL SI LE CLIENT EST CONNECTE
                        //Je peux pas mettre la variable en haut car j'ai pas encore appelé la fonction totalClient()
                        ?>
                <?php endif; //fin afficher panier?>
                    

                
                






                

            <?php endif;;//fin verification si est connecte  ?>
        </main>
        <br>
        <br>
        <br>
        <br>
        <br>
        <?php include 'footer.php'; ?>
         
       
    </body>
</html>
