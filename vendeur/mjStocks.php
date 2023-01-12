<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta charset="utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        
        <title>Mise à jour des Stocks</title>
        
        <meta name="description" content="Page contenant la liste des produits de la COBREC" />
        <meta name="author" content="Paul Favreau" />    <!-- Webmaster -->

        <link rel="icon" type="image/png" sizes="16x16" href="icon.png">    <!-- Icone de la page -->
        <link rel="stylesheet" href="style.css">    <!-- Feuille de style -->
        <!-- Intégration des fichiers Bootstrap -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container-fluid">   <!-- définition d'un conteneur fluid -->
            <div class="row">          <!-- ligne définie avec 2 colonnes -->
            <nav class="col-2">     <!-- colonne de navigation -->
                    <div class="d-flex justify-content-around">
                        <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href='index.php'">Accueil</button>
                    </div><br>
                    <details open="open">
                        <summary id="listeProduit">Produits</summary>
                        <a class="link-light" href="listeProduits.php">Liste des produits</a><br/>
                        <a class="link-light" href="importerCatalogue.php">Importer un catalogue</a><br>
                        <a class="link-light" href="ajoutProduit.php">Ajouter un produit</a>
                    </details><br/>
                    <details open="open">
                        <summary id="listeCommande">Commandes</summary>
                        <a class="link-light" href="listeCommandes.php">Listes des commandes</a>
                    </details><br/>
                    <details open="open">
                        <summary id="listeLivraison">Livraisons</summary>
                        <a class="link-light" href="listeLivraison.php">Listes des livraisons</a>
                    </details><br/>
                    <details open="open">
                        <summary id="listeStock">Stocks</summary>
                        <a class="link-light" href="listeStock.php">Consulter les stocks</a>
                    </details><br/>
                </nav>
                <main  class="col-10">
                    <header>
                        <h1>Mise à jour des Stocks</h1>
                    </header><br>
                    <form action="importerCatalogue.php" method="GET" enctype="multipart/form-data">
                        <label for="file">Fichier : </label>
                        <input type="file" name="file" id="file" accept=".csv">
                        <input type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" value="Importer des produits">
                        <input type="submit" formaction="mjStocks.php" class="btn btn-secondary" value="Mise à jour des Stocks">
                    </form>
                    <?php
                        if(isset($_GET['file']) && $_GET['file']!==""){
                            
                            $file = $_GET["file"]; // On prend le fichier selectionner par l'utilisateur
                            $pass="sae";
                            $user="sae";
                            $var = fopen($file, "r");
                            $x = 0;
                            

                            $db= new PDO("mysql:host=localhost;dbname=alizon_sprint_3", $user, $pass);

                            while (!feof($var)){

                                $ligne=fgets($var);                  //on divise le fichier en ligne
                                $partie = explode(";", $ligne);
                                $nom = $partie[0];

                                if(preg_match("/(?:\d+(?:\,\d*)?|\,\d+)/", $partie[11]) == 1){
                        
                                    $partie[11]=str_replace(",", ".", $partie[11]);
                                    $stock = $partie[11];
                                }else{
                                    $stock = $partie[11];
                                }
                        
                        
                                $requete="SELECT count(*) from _produit where nom=?";
                                $stmt = $db->prepare($requete);
                                $stmt->bindValue(1, $nom);
                                $stmt->execute();
                                $res=$stmt->fetch(PDO::FETCH_NUM);

                                if($res[0]==1){

                                    $requete="SELECT stock from _produit where nom=?"; // on selectionne le stock du produit qui est deja dans la bdd
                                    $stmt = $db->prepare($requete);
                                    $stmt->bindValue(1, $nom);
                                    $stmt->execute();
                                    $rq2=$stmt->fetch(PDO::FETCH_NUM);
                                    
                                    if($rq2[0]!=$stock){
                                        $somme=$stock+$rq2[0];
                                        $sql="UPDATE _produit set stock=? where nom=?";
                                        $stmt = $db->prepare($sql);
                                        $stmt->bindValue(1, $somme);
                                        $stmt->bindValue(2, $nom);
                                        $stmt->execute();
                                        $x+=1;
                                    }
                                    
                                    
                                }
                            }
                            if($x>1){
                                echo '<div class="position-relative text-center align-middle col-md-12" style="top: 170px" >';
                                echo '<img src="../img/icon/img_stocks.svg" class="position-relative" style="bottom: 20px; right: 20px;"   width="15%" height="15%">';       
                                echo "<p>La mise à jour des stocks a été réalisée avec succès.</p>";
                                echo '</div>';
                            }else{
                                echo '<div class="position-relative text-center align-middle col-md-12" style="top: 170px" >';
                                echo '<img src="../img/icon/warning.svg" class="position-relative" style="bottom: 20px; right: 20px;"   width="15%" height="15%">';
                                echo "<p>Le produit n'existe pas veuillez importer le produit avant.</p>";
                                echo '</div>';
                            }

                        }else{
                            echo "";
                        }
                      ?>
                </main>
            </div>
        </div>
    </body>    
</html>