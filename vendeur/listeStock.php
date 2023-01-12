<?php
    require 'db.class.php';
    $DB=new DB();
    if (isset($_POST['qte']) && isset($_POST['idProd'])) {
        $qte = $_POST['qte'];
        $id = $_POST['idProd'];
        $stock = $DB->query("SELECT stock FROM _produit WHERE idProduit = ?", [$id]); // récupération du stock du produit sélectionné
        if($_POST['action']=="Ajouter"){ // si on veut ajouter des produits
            $req = $DB->query("UPDATE _produit SET stock = stock + ? WHERE idProduit = ?", [$qte, $id]);
        }
        elseif($_POST['action']=="Déstocker" && $stock[0]->stock - $qte >= 0){ // si on veut déstocker des produits
            $req = $DB->query("UPDATE _produit SET stock = stock - ? WHERE idProduit = ?", [$qte, $id]);
        }
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta charset="utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        
        <title>État Stocks COBREC</title>
        
        <meta name="description" content="Page contenant la liste de stocks des produits de la COBREC" />
        <meta name="author" content="Vincent Guéneuc" />    <!-- Webmaster -->

        <link rel="icon" type="image/png" sizes="16x16" href="icon.png">    <!-- Icone de la page -->
        <link rel="stylesheet" href="style.css">    <!-- Feuille de style -->
        <!-- Intégration des fichiers Bootstrap -->
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
                    <details open="open">
                        <summary id="listeStock">Commentaires</summary>
                        <a class="link-light" href="listeComm.php">Liste des commentaires</a>
                    </details><br/>
                </nav>
                
                <main class="col-10">  <!-- colonne principale -->
                    <header>
                        <h1>État des stocks</h1>
                    </header><br>
                    <?php
                        // feedback de l'action effectuée
                        if (isset($_POST['qte']) && isset($_POST['idProd'])){
                            if($stock[0]->stock - $_POST['qte'] >= 0){
                                if ($_POST['action']=="Ajouter") {
                                    echo "<div class='alert alert-success' role='alert'>Le produit N°". $_POST['idProd']." à été réapprovisionnée de ". $_POST['qte'] ." exemplaire(s)</div>";
                                }
                                elseif($_POST['action']=="Déstocker"){
                                    echo "<div class='alert alert-success' role='alert'>Le produit N°". $_POST['idProd']." à été déstocké de ". abs($_POST['qte']) ." exemplaire(s)</div>";
                                }
                            }
                            elseif ($stock[0]->stock - $_POST['qte'] < 0 && $_POST['action']=="Déstocker"){
                                echo "<div class='alert alert-danger' role='alert'>Le produit N°". $_POST['idProd']." n'a pas été réapprovisionnée car la quantité à déstocker est supérieure au stock</div>";
                            }
                            else{
                                echo "<div class='alert alert-success' role='alert'>Le produit N°". $_POST['idProd']." à été réapprovisionnée de ". $_POST['qte'] ." exemplaire(s)</div>";
                            }
                        }
                    ?>
                    <div class="row">  <!-- barre de recherche -->
                        <form class="col-4 d-flex" method="get" action="listeStock.php">
                            <input id='recherche' class="form-control" type="text" placeholder="Rechercher par nom" name="nom" <?php  if (isset($_GET['nom'])) echo "value='${_GET['nom']}'";?> onkeyup="griserBouton()" onkeydown="griserBouton()" onfocus="griserBouton()" onblur="griserBouton()">&nbsp;
                            <input id='btnRecherche' type="submit" class="btn btn-primary" <?php
                                if(!isset($_GET['nom']) || $_GET['nom'] === ""){ // si le nom n'est pas renseigné on grise le bouton de recherche
                                    echo "disabled";
                                }
                            ?> value="Rechercher">
                        </form>
                        <div class="col-1">
                            <?php
                                if(isset($_GET['nom']) && $_GET['nom'] != "") { // si le nom est renseigné on affiche le bouton de suppression
                                    echo "<button type='button' class='btn-close recherche' aria-label='Close' onclick='annulerRecherche()'></button>";
                                }
                            ?>
                        </div>
                        <form class="col-7 justify-content-end d-flex" method="post" action="listeStock.php"> <!-- formulaire de réassort -->
                            <label class="align-center" for="prod">Produit N° :</label>&nbsp;
                            <select name="idProd" id="idProd" onkeyup="griserBouton()" onclick="griserBouton()" onkeydown="griserBouton()" onfocus="griserBouton()" onblur="griserBouton()" onclick="griserBouton()">  <!-- liste déroulante des produits -->
                                <option value="">Choisissez un produit</option> 
                                <?php
                                    $prods = $DB->query('SELECT idProduit,nom FROM _produit');
                                    foreach ($prods as $row) {
                                        echo "<option value=\"$row->idProduit\">$row->idProduit - $row->nom</option>";
                                    }
                                ?>
                            </select>&nbsp;
                            <input class="col-3" type="number" id="qte" name="qte" min="0" onkeyup="griserBouton()" onkeydown="griserBouton()" onfocus="griserBouton()" onblur="griserBouton()">&nbsp;
                            <input type="submit" class="btn btn-primary" id='btnAjout' name='action' value="Ajouter" disabled="true">&nbsp;
                            <input type="submit" class="btn btn-primary" id='btnSupp' name='action' value="Déstocker" disabled="true">
                        </form>
                    </div>

                    <table>
                        <thead> <!-- en-tête du tableau -->
                        <tr>
                                <th>Numéro</th>
                                <th>Nom</th>
                                <th>Photo</th>
                                <th>Stock</th>
                                <th>Seuil d'alerte</th>
                            </tr>
                        </thead>
                        <tbody> <!-- corps du tableau -->
                            <?php
                                // Connexion à la base de données et récupération des données des stocks  
                                $produits = $DB->query("SELECT idProduit, nom, photo1, stock, seuilAlerte FROM _produit");
                                //affichage des données des produits 
                                foreach ($produits as $produit) {
                                    if (isset($_GET['nom']) && $_GET['nom'] != '') {    // si la recherche par nom est activée
                                        if (stripos($produit->nom,$_GET['nom'])!==false){
                                            echo "<tr>";
                                            echo '<td>' . $produit->idProduit . '</td>';
                                            echo '<td>' . $produit->nom . '</td>';
                                            echo '<td><a href="'. $produit->photo1 . '" target="_blank">Voir la photo</a></td>';
                                            echo "<td>".$produit->stock."</td>";
                                            echo '<td>' . $produit->seuilAlerte . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    else {
                                        echo "<tr>";
                                        echo '<td>' . $produit->idProduit . '</td>';
                                        echo '<td>' . $produit->nom . '</td>';
                                        echo '<td><a href="'. $produit->photo1 . '" target="_blank">Voir la photo</a></td>';
                                        echo "<td>".$produit->stock."</td>";
                                        echo '<td>' . $produit->seuilAlerte . '</td>';
                                        echo '</tr>';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
    </body>
    <script>
        function annulerRecherche() {   // fonction qui annule la recherche par nom
            window.location.replace("listeStock.php");
        }

        // boucle pour alterner le fond des lignes du tableau        
        for (let i = 1; i < document.getElementsByTagName("tr").length; i++) {
            if(i%2 == 0) {
                document.getElementsByTagName("tr")[i].style.backgroundColor = "#C5DDFA";
            }
            else{
                document.getElementsByTagName("tr")[i].style.backgroundColor = "#white";
            }
        }

        // fonction qui grise le bouton ajouter si le champ quantité est vide ou le bouton rechercher si le champ recherche est vide
        function griserBouton() {
            if(document.getElementById("qte").value == "" || document.getElementById("idProd").value == "") {
                document.getElementById("btnAjout").disabled = true;
                document.getElementById("btnSupp").disabled = true;
            }
            else {
                document.getElementById("btnAjout").disabled = false;
                document.getElementById("btnSupp").disabled = false;
            }

            if(document.getElementById("recherche").value == "") {
                document.getElementById("btnRecherche").disabled = true;
            }
            else {
                document.getElementById("btnRecherche").disabled = false;
            }
        }
        
    </script>
</html>