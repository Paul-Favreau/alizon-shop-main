<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta charset="utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        
        <title>Liste Livraisons COBREC</title>
        
        <meta name="description" content="Page contenant la liste des livraisons de la COBREC" />
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
                        <h1>Liste des livraisons</h1>
                    </header><br>
                    <div class="row d-flex align-middle">  <!-- barre de recherche -->
                        <form class="col-4 d-flex" method="get" action="listeLivraison.php">
                            <input id="recherche" class="form-control" type="number" placeholder="Rechercher par numéro" name="num" min="0" <?php  if (isset($_GET['num'])) echo "value='${_GET['num']}'";?>  onkeyup="griserBouton()" onkeydown="griserBouton()" onfocus="griserBouton()" onblur="griserBouton()">&nbsp;
                            <input id='btnRecherche' type="submit" class="btn btn-primary" <?php
                                if(!isset($_GET['num']) || $_GET['num'] === ""){ // si le numéro n'est pas renseigné on grise le bouton de recherche
                                    echo "disabled";
                                }
                            ?> value="Rechercher">
                        </form>
                        <?php
                            if(isset($_GET['num']) && $_GET['num'] !== "") {    // si le numéro est renseigné on affiche le bouton de suppression
                                echo "<button type='button' class='btn-close  recherche' aria-label='Close' onclick='annulerRecherche()'></button>";
                            }
                        ?>
                    </div>
                    <table>
                        <thead> <!-- en-tête du tableau -->
                            <tr>
                                <th>Numéro</th>
                                <th>Nom du livreur</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>État</th>
                                <th>Commandes<br> prises en charge</th>
                            </tr>
                        </thead>
                        <tbody> <!-- corps du tableau -->
                            <?php
                                // tableau des états des livraisons
                                $state = array(
                                    0 => "Prise en charge", // Changement après 10 secondes (instantané) NOTE : en réalité, le temps de nextStep par défaut est de 1 minute pour que je puisse voir les changements
                                    1 => "Transport vers la plateforme régionale", // Changement après 1 à 3 minutes (jours)
                                    2 => "Transport entre la plateforme et le site local de livraison", // Changement après 1 minute (jour)
                                    3 => "Livraison au destinataire", // Changement après 10 secondes
                                    4 => "Livraison terminée" // Changement après 10 secondes
                                );
                                // Connexion à la base de données et récupération des données des commandes
                                require 'db.class.php';
                                $DB = new DB();
                                $req = $DB->query("SELECT * from _livraison");
                                //affichage des données des commandes
                                foreach ($req as $ligne) {
                                    $numCommandes = $DB->query("SELECT numCommande from _expedition where idLivraison = $ligne->idLivraison"); // récupération des numéros des commandes de la livraison
                                    foreach ($numCommandes as $numCommande) {
                                        $liste[] = $numCommande->numCommande; // création d'un tableau contenant les numéros des commandes de la livraison
                                    }
                                    if (isset($_GET['num']) && $_GET['num'] != '') {  // si la recherche par numéro est activée;
                                        if (stripos($ligne->idLivraison,$_GET['num'])!==false || in_array($_GET['num'],$liste)) { // si le numéro de la livraison ou un numéro de commande correspond à la recherche
                                            echo "<tr>";
                                            echo '<td>' . $ligne->idLivraison . '</td>';
                                            echo '<td>' . $ligne->nomLivreur . '</td>';
                                            $date = new DateTime($ligne->dateDebut);
                                            $date->setTimezone(new DateTimeZone('Europe/Paris'));
                                            $ligne->dateDebut = $date->format('d/m/Y');
                                            echo '<td>' . $ligne->dateDebut . '</td>';
                                            $date = new DateTime($ligne->dateFin);
                                            $date->setTimezone(new DateTimeZone('Europe/Paris'));
                                            $ligne->dateFin = $date->format('d/m/Y');
                                            echo '<td>' . $ligne->dateFin . '</td>';
                                            echo '<td>' . $state[$ligne->etat] . '</td>';
                                            echo '<td><ul>';
                                            foreach ($numCommandes as $numCommande) {
                                                echo '<li>' . $numCommande->numCommande . '</li>';
                                            }
                                            echo '</ul></td>';
                                            echo '</tr>';
                                        }
                                    }
                                    else {
                                        echo "<tr>";
                                        echo '<td>' . $ligne->idLivraison . '</td>';
                                        echo '<td>' . $ligne->nomLivreur . '</td>';
                                        $date = new DateTime($ligne->dateDebut);
                                        $date->setTimezone(new DateTimeZone('Europe/Paris'));
                                        $ligne->dateDebut = $date->format('d/m/Y');
                                        echo '<td>' . $ligne->dateDebut . '</td>';
                                        $date = new DateTime($ligne->dateFin);
                                        $date->setTimezone(new DateTimeZone('Europe/Paris'));
                                        $ligne->dateFin = $date->format('d/m/Y');
                                        echo '<td>' . $ligne->dateFin . '</td>';
                                        echo '<td>' . $state[$ligne->etat] . '</td>';
                                        echo '<td><ul>';
                                        foreach ($numCommandes as $numCommande) {
                                            echo '<li>' . $numCommande->numCommande . '</li>';
                                        }
                                        echo '</ul></td>';
                                        echo '</tr>';
                                    }
                                    $liste = array(); // réinitialisation du tableau des numéros de commandes
                                }
                            ?>
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
    </body>
    <script>
        function annulerRecherche() {   // fonction qui annule la recherche par 
            window.location.replace("listeLivraison.php");
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