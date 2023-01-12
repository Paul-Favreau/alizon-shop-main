<?php 
    require 'db.class.php';
    $DB=new DB();
    if(isset($_POST['action']) && $_POST['action'] == 'modif'){
        $_POST['nom'] = str_replace("'", "\'", $_POST['nom']); // Remplacement des apostrophes par deux apostrophes
        $_POST['descript'] = str_replace("'", "\'", $_POST['descript']); // Remplacement des apostrophes par deux apostrophes
        $prixTotal = (($_POST['prixUnit'] + $_POST['prixLiv'])*$_POST['tauxTVA'])/100; // Calcul du prix total
        // requête de modification du produit
        $req = $DB->query("UPDATE _produit SET nom='${_POST['nom']}', prixUnit=${_POST['prixUnit']}, prixLiv=${_POST['prixLiv']}, tauxTVA=${_POST['tauxTVA']}, prixTotal=$prixTotal, categorie='".$_POST['categorie']."', descript='${_POST['descript']}', stock=${_POST['stock']}, seuilAlerte=${_POST['seuilAlerte']}, interditMineurs=${_POST['interditMineurs']}, masque=${_POST['masque']} WHERE idProduit = ${_GET['idProd']}");
        if (isset($_FILES['photo1']) && is_uploaded_file($_FILES['photo1']['tmp_name'])){   // Vérification de l'upload de la photo 1
            copy($_FILES['photo1']['tmp_name'], 'images/' . $_FILES['photo1']['name']);
            $photo1='images/'.$_FILES['photo1']['name'];
            $req = $DB->query("UPDATE _produit SET photo1='$photo1' WHERE idProduit = ${_GET['idProd']}");
        }
        if (isset($_FILES['photo2']) && is_uploaded_file($_FILES['photo2']['tmp_name'])){   // Vérification de l'upload de la photo 2
            copy($_FILES['photo2']['tmp_name'], 'images/' . $_FILES['photo2']['name']);
            $photo2='images/'.$_FILES['photo2']['name'];
            $req = $DB->query("UPDATE _produit SET photo2='$photo2' WHERE idProduit = ${_GET['idProd']}");
        }
        if (isset($_FILES['photo3']) && is_uploaded_file($_FILES['photo3']['tmp_name'])){   // Vérification de l'upload de la photo 3
            copy($_FILES['photo3']['tmp_name'], 'images/' . $_FILES['photo3']['name']);
            $photo3='images/'.$_FILES['photo3']['name'];
            $req = $DB->query("UPDATE _produit SET photo3='$photo3' WHERE idProduit = ${_GET['idProd']}");
        }
    }
    if(isset($_GET['action']) && $_GET['action'] == 'Masquer'){
        // requête de masquage du produit
        $req = $DB->query("UPDATE _produit SET masque=true WHERE idProduit = ${_GET['idProd']}");
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta charset="utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        
        <title>Liste Produits COBREC</title>
        
        <meta name="description" content="Page contenant la liste des produits de la COBREC" />
        <meta name="author" content="Vincent Guéneuc" />    <!-- Webmaster -->

        <link rel="icon" type="image/png" sizes="16x16" href="icon.png">    <!-- Icone de la page -->
        <link rel="stylesheet" href="style.css">    <!-- Feuille de style -->
        <!-- Intégration des fichiers Bootstrap -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <script src=../bootstrap/js/bootstrap.bundle.min.js></script>
        <script src=../bootstrap/js/bootstrap.bundle.js></script>
        <script src=../bootstrap/js/bootstrap.min.js></script>
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
                        <h1>Liste des produits</h1>
                    </header><br>
                    <?php 
                        // affichage d'un message de confirmation de la modification ou de la suppression d'un produit
                        if(isset($_POST['action']) && $_POST['action'] == 'modif'){
                            echo "<div class='alert alert-success' role='alert'>Le produit N°". $_GET['idProd']." à été modifié </div>";
                        }
                        elseif (isset($_GET['action']) && $_GET['action'] == 'Supprimer') {
                            echo "<div class='alert alert-success' role='alert'>Le produit N°". $_GET['idProd']." à été supprimé </div>";
                        }
                   ?>
                    <div class="row">   <!-- barre de recherche -->
                        <form class="col-4 d-flex" method="get" action="listeProduits.php">
                            <input id='recherche' class="form-control" type="text" placeholder="Rechercher par nom" name="nom" <?php  if (isset($_GET['nom'])) echo "value='${_GET['nom']}'";?> onkeyup="griserBouton()" onkeydown="griserBouton()" onfocus="griserBouton()" onblur="griserBouton()">&nbsp;
                            <input id='btnRecherche' type="submit" class="btn btn-primary" <?php
                                if(!isset($_GET['nom']) || $_GET['nom'] === ""){ // si le nom n'est pas renseigné on grise le bouton de recherche
                                    echo "disabled";  
                                }
                            ?> value="Rechercher">
                        </form>
                        <div class="col-4">
                            <?php
                                if(isset($_GET['nom']) && $_GET['nom'] !== ""){ // si le nom est renseigné on affiche le bouton de suppression
                                    echo "<button type='button' class='btn-close recherche' aria-label='Close' onclick='annulerRecherche()'></button>";
                                }
                            ?>
                        </div>
                        <div class="col-4 d-flex justify-content-end"> <!-- bouton d'ajout et d'import -->
                            <button type="button" class="btn btn-outline-primary" onclick="window.location.href='ajoutProduit.php'">Ajouter un produit</button>&nbsp;
                            <button type="button" class="btn btn-outline-primary" onclick="window.location.href='importerCatalogue.php'">Importer un catalogue</button>
                        </div>
                    </div>
                    <br>
                    <div class="d-inline-flex">
                        <form method="get" action="modifierProduit.php"> <!-- formulaire de modification ou suppression -->
                                <label class="align-center" for="prod">Produit N° :</label>&nbsp;
                                <select name="idProd" id="idProd" onkeyup="griserBouton()" onclick="griserBouton()" onkeydown="griserBouton()" onfocus="griserBouton()" onblur="griserBouton()" onclick="griserBouton()">  <!-- liste déroulante des produits -->
                                    <option value="">Choisissez un produit</option> 
                                    <?php
                                        $req = $DB->query('SELECT idProduit,nom from _produit');
                                        foreach ($req as $row) {  // affichage des produits dans la liste déroulante
                                            echo "<option value=\"$row->idProduit\">$row->idProduit - $row->nom</option>";
                                        }
                                    ?>
                                </select>&nbsp;
                                <input type="submit" class="btn btn-primary" id='btnModif' value='Modifier' disabled="true">&nbsp;
                        </form>
                        <!-- bouton de suppression -->
                        <button type="button" class="btn btn-primary" id='btnSupp' data-bs-toggle="modal" data-bs-target="#exampleModal" disabled="true">Masquer</button>
                        <!-- fenêtre modale de confirmation de suppression -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Attention !</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        Voulez-vous vraiment masquer ce produit ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-lg " data-bs-dismiss="modal">Non</button>
                                        <button type="submit" class="btn btn-primary btn-lg" aria-label="Close" name='action' value='Masquer' onclick='affecterIdProd()'>Oui</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table>
                        <thead> <!-- en-tête du tableau -->
                            <tr>
                                <th>Numéro</th>
                                <th>Nom</th>
                                <th>Prix Unitaire (€)</th>
                                <th>Frais de Livraison (€)</th>
                                <th>% TVA</th>
                                <th>Prix Total (€)</th>
                                <th>Photo</th>
                                <th>Catégorie</th>
                                <th>Description</th>
                                <th>Interdit aux Mineurs</th>
                                <th>Masqué</th>
                            </tr>
                        </thead>
                        <tbody> <!-- corps du tableau -->
                            <?php
                                // Connexion à la base de données et récupération des données des produits
                                $req = $DB->query('SELECT * from _produit');
                                //affichage des données des produits
                                foreach ($req as $produit) {
                                    if (isset($_GET['nom']) && $_GET['nom'] != '') {    // si la recherche par nom est activée
                                            if (stripos($produit->nom,$_GET['nom'])!==false){
                                                echo "<tr>";
                                                echo '<td>' . $produit->idProduit . '</td>';
                                                echo '<td>' . $produit->nom . '</td>';
                                                // prix au format français
                                                $produit->prixUnit = number_format($produit->prixUnit, 2, ',', ' ');
                                                $produit->prixLiv = number_format($produit->prixLiv, 2, ',', ' ');
                                                $produit->prixTotal = number_format($produit->prixTotal, 2, ',', ' ');
                                                echo '<td>' . $produit->prixUnit . '</td>';
                                                echo '<td>' . $produit->prixLiv . '</td>';
                                                echo '<td>' . $produit->tauxTVA . '</td>';
                                                echo '<td>' . $produit->prixTotal . '</td>';
                                                echo '<td><a href="'. $produit->photo1 . '" target="_blank">Voir la photo</a></td>';
                                                if($produit->categorie != 'NULL'){
                                                    echo '<td>' . $produit->categorie . '</td>';
                                                }
                                                else{
                                                    echo '<td>Pas de catégorie renseignée</td>';
                                                }
                                                echo '<td>' . $produit->descript . '</td>';
                                                if ($produit->interditMineurs) {       
                                                    echo '<td>Oui</td>';
                                                }
                                                else {
                                                    echo '<td>Non</td>';
                                                }
                                                if ($produit->masque) {       
                                                    echo '<td>Oui</td>';
                                                }
                                                else {
                                                    echo '<td>Non</td>';
                                                }
                                                echo '</tr>';
                                        }
                                    }
                                    else {
                                        echo "<tr>";
                                        echo '<td>' . $produit->idProduit . '</td>';
                                        echo '<td>' . $produit->nom . '</td>';
                                        // prix au format français
                                        $produit->prixUnit = number_format($produit->prixUnit, 2, ',', ' ');
                                        $produit->prixLiv = number_format($produit->prixLiv, 2, ',', ' ');
                                        $produit->prixTotal = number_format($produit->prixTotal, 2, ',', ' ');
                                        echo '<td>' . $produit->prixUnit . '</td>';
                                        echo '<td>' . $produit->prixLiv . '</td>';
                                        echo '<td>' . $produit->tauxTVA . '</td>';
                                        echo '<td>' . $produit->prixTotal . '</td>';
                                        echo '<td><a href="'. $produit->photo1 . '" target="_blank">Voir la photo</a></td>';
                                        if($produit->categorie != 'NULL'){
                                            echo '<td>' . $produit->categorie . '</td>';
                                        }
                                        else{
                                            echo '<td>Pas de catégorie renseignée</td>';
                                        }
                                        echo '<td>' . $produit->descript . '</td>';
                                        if ($produit->interditMineurs) {       
                                            echo '<td>Oui</td>';
                                        }
                                        else {
                                            echo '<td>Non</td>';
                                        }
                                        if ($produit->masque) {       
                                            echo '<td>Oui</td>';
                                        }
                                        else {
                                            echo '<td>Non</td>';
                                        }
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
            window.location.replace("listeProduits.php");
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

        // fonction qui grise le bouton de recherche si la barre de recherche est vide
        function griserBouton() {
            if(document.getElementById("recherche").value == "") {
                document.getElementById("btnRecherche").disabled = true;
            }
            else {
                document.getElementById("btnRecherche").disabled = false;
            }

            if(document.getElementById("idProd").value == "") {
                document.getElementById("btnModif").disabled = true;
                document.getElementById("btnSupp").disabled = true;
            }
            else {
                document.getElementById("btnModif").disabled = false;
                document.getElementById("btnSupp").disabled = false;
            }
        }

        function affecterIdProd(){
            window.location.replace("listeProduits.php?idProd=" + document.getElementById("idProd").value+"&action=Masquer");
        }
        
    </script>
</html>