<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta charset="utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        
        <title>Liste Commandes COBREC</title>
        
        <meta name="description" content="Page contenant la liste des commandes de la COBREC" />
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
                        <h1>Liste des commandes</h1>
                    </header><br>
                    <div class="row d-flex align-middle">  <!-- barre de recherche -->
                        <form class="col-4 d-flex" method="get" action="listeCommandes.php">
                            <input id="recherche" class="form-control" type="text" placeholder="Rechercher par mail de client" name="mail" <?php  if (isset($_GET['mail'])) echo "value='${_GET['mail']}'";?>  onkeyup="griserBouton()" onkeydown="griserBouton()" onfocus="griserBouton()" onblur="griserBouton()">&nbsp;
                            <input id='btnRecherche' type="submit" class="btn btn-primary" <?php
                                if(!isset($_GET['mail']) || $_GET['mail'] === ""){ // si le mail n'est pas renseigné on grise le bouton de recherche
                                    echo "disabled";
                                }
                            ?> value="Rechercher">
                        </form>
                        <?php
                            if(isset($_GET['mail']) && $_GET['mail'] !== "") {    // si le mail est renseigné on affiche le bouton de suppression
                                echo "<button type='button' class='btn-close  recherche' aria-label='Close' onclick='annulerRecherche()'></button>";
                            }
                        ?>
                    </div>
                    <table>
                        <thead> <!-- en-tête du tableau -->
                            <tr>
                                <th>Numéro</th>
                                <th>Mail Client</th>
                                <th>Date</th>
                                <th>Adresse</th>
                                <th>Code Postal</th>
                                <th>Ville</th>
                                <th>Prix TTC</th>
                                <th>Mode de Paiement</th>
                                <th>Produits achetés</th>
                            </tr>
                        </thead>
                        <tbody> <!-- corps du tableau -->
                            <?php
                                // Connexion à la base de données et récupération des données des commandes
                                require 'db.class.php';
                                $DB = new DB();
                                $req = $DB->query("SELECT * from _commande");
                                //affichage des données des commandes
                                foreach ($req as $ligne) {
                                    $mail = $DB->query("SELECT email from _client where idClient = $ligne->idClient"); // récupération du mail du client
                                    if (isset($_GET['mail']) && $_GET['mail'] != '') {    // si la recherche par mail est activée
                                        if (stripos($mail[0]->email,$_GET['mail'])!==false){
                                            echo "<tr>";
                                            echo '<td>' . $ligne->numCommande . '</td>';
                                            echo '<td>' . $mail[0]->email . '</td>';
                                            $date = new DateTime($ligne->dateCommande);
                                            $date->setTimezone(new DateTimeZone('Europe/Paris'));
                                            $ligne->dateCommande = $date->format('d/m/Y');
                                            echo '<td>' . $ligne->dateCommande . '</td>';
                                            echo '<td>' . $ligne->adresseLiv . '</td>';
                                            echo '<td>' . $ligne->codePostal . '</td>';
                                            echo '<td>' . $ligne->ville . '</td>';
                                            str_replace('.',',',$ligne->prixTotal);
                                            echo '<td>' . $ligne->prixTotal . '</td>';
                                            echo '<td>' . $ligne->modePaiement . '</td>';
                                            $prods = $DB->query("SELECT idProduit,qte from _recap where numCommande = $ligne->numCommande");    // récupération des produits de la commande
                                            echo '<td><ul>';
                                            foreach ($prods as $id) {
                                                $nom = $DB->query("SELECT nom from _produit where idProduit = $id->idProduit");    // récupération du nom de chaque produit
                                                echo '<li>' . $nom[0]->nom . ' x ' . $id->qte . '</li>';
                                            }
                                            echo '</ul></td>';
                                            echo '</tr>';
                                        }
                                    }
                                    else {
                                        echo "<tr>";
                                            echo '<td>' . $ligne->numCommande . '</td>';
                                            echo '<td>' . $mail[0]->email . '</td>';
                                            $date = new DateTime($ligne->dateCommande);
                                            $date->setTimezone(new DateTimeZone('Europe/Paris'));
                                            $ligne->dateCommande = $date->format('d/m/Y');
                                            echo '<td>' . $ligne->dateCommande . '</td>';
                                            echo '<td>' . $ligne->adresseLiv . '</td>';
                                            echo '<td>' . $ligne->codePostal . '</td>';
                                            echo '<td>' . $ligne->ville . '</td>';
                                            str_replace('.',',',$ligne->prixTotal);
                                            echo '<td>' . $ligne->prixTotal . '</td>';
                                            echo '<td>' . $ligne->modePaiement . '</td>';
                                            
                                            $prods = $DB->query("SELECT idProduit,qte from _recap where numCommande = $ligne->numCommande");    // récupération des produits de la commande
                                            echo '<td><ul>';
                                            foreach ($prods as $id) {
                                                $nom = $DB->query("SELECT nom from _produit where idProduit = $id->idProduit");    // récupération du nom de chaque produit
                                                echo '<li>' . $nom[0]->nom . ' x ' . $id->qte . '</li>';
                                            }
                                            echo '</ul></td>';
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
        function annulerRecherche() {   // fonction qui annule la recherche par mail
            window.location.replace("listeCommandes.php");
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
        }
        
    </script>
</html>