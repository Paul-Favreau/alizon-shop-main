<!-- Yo, si tu veut bosser la dessus, je te conseille de rajouter ?debug a la fin de l'url -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta charset="utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        
        <title>Liste Commandes Client</title>
        
        <meta name="description" content="Page contenant la liste des commandes" />

        <link rel="icon" type="image/png" sizes="16x16" href="icon.png">    <!-- Icone de la page -->
        <link rel="stylesheet" href="style.css">    <!-- Feuille de style -->
        <!-- Intégration des fichiers Bootstrap -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <style>
        thead{
            background-color: #7ab7f8;
        }
        
        thead tr th, tbody tr{
            border: 1px solid black;
            padding: 10px;
            border-collapse: collapse;
            text-align: center;
            margin: auto;
        }
        
        tbody tr td{
            padding: 10px;
            border: 1px solid #a0a0a0;
        }
        </style>
        <?php
            include 'header.php';

            if (!isset($_SESSION['id'])) {
                header("Location: connexion.php?notlogged=1");
            }

            // Script permettant a la livraison d'avancer
            $state = array(
                0 => "Prise en charge", // Changement après 10 secondes (instantané) NOTE : en réalité, le temps de nextStep par défaut est de 1 minute pour que je puisse voir les changements
                1 => "Transport vers la plateforme régionale", // Changement après 1 à 3 minutes (jours)
                2 => "Transport entre la plateforme et le site local de livraison", // Changement après 1 minute (jour)
                3 => "Livraison au destinataire", // Changement après 10 secondes (1 minute)
                4 => "Livraison terminée" // Changement après 10 secondes (1 minute)
            );
            // Dessous, l'ancienne fonction qui se mettait a jour avec la chance plutôt que le temps.
            // srand(time());
            // if(rand(1,4)==1){
            //     $res = $DB->query("UPDATE `_livraison` SET etat = etat + 1 WHERE etat = 3");
            // } if(rand(1,2)==1){
            //     $res = $DB->query("UPDATE `_livraison` SET etat = etat + 1 WHERE etat = 2");
            // } if (rand(1,10)==1){
            //     $res = $DB->query("UPDATE `_livraison` SET etat = etat + 1 WHERE etat = 1");
            // } if (rand(1,4)==1){
            //     $res = $DB->query("UPDATE `_livraison` SET etat = etat + 1 WHERE etat = 0");
            // }
            $originalreq = $DB->query("SELECT * FROM `_livraison`");
            if (isset($_GET['debug'])){echo "Time is ".date("H:i:s", strtotime("now + 1 hour"))." on ".date("Y-m-d");}
            foreach ($originalreq as $ligne) {
                if ($ligne->nextStep <= date('H:i:s', strtotime("now + 1 hour"))) {
                    $res = $DB->query("UPDATE `_livraison` SET etat = etat + 1 WHERE nextStep <= '".date("H:i:s", strtotime("now + 1 hour"))."' AND etat < 4");
                    //$res = $DB->query("DELETE FROM _livraison WHERE `etat` = 4 AND nextStep<='".date("H:i:s", strtotime("now + 1 hour")));
                    $res = $DB->query("SELECT * FROM `_livraison`");
                    foreach ($res as $line) {
                        if ($line->etat == 1){
                            $res = $DB->query("UPDATE `_livraison` SET nextStep = '".(date("H:i:s", strtotime("now + 1 hour + ".rand(60,180)." seconds")))."' WHERE etat = 1");
                        } else if ($line->etat == 2){
                            $res = $DB->query("UPDATE `_livraison` SET nextStep = '".(date("H:i", strtotime("now + 1 hour + 1 minute")))."' WHERE etat = 2");
                        } else if ($line->etat == 3){
                            $res = $DB->query("UPDATE `_livraison` SET nextStep = '".(date("H:i", strtotime("now + 1 hour + 1 minute")))."' WHERE etat = 3");
                        } else {
                            $res = $DB->query("UPDATE `_livraison` SET dateFin = '".(date("Y-m-d"))."' WHERE etat = 4");
                        }
                    }
                }
            }


        ?>
        <div class="container-fluid">   <!-- définition d'un conteneur fluid -->
            <div class="container">          <!-- ligne définie avec 2 colonnes -->
                <main class="col-12">  <!-- colonne principale -->
                    <br>
                        <h1>Liste des commandes effectuées</h1>
                    <br>
                    <?php
                                // Connexion à la base de données et récupération des données des commandes
                                $req = $DB->query("SELECT * FROM `_livraison` AS l LEFT JOIN `_commande` AS c ON l.numCommande = c.numCommande WHERE idClient = ".$_SESSION['id']);
                                if(empty($req)): //si le client n'a pas de livraisons?>
                                    <div class="text-center align-middle p-5">
                                        <img src="img/camion_livraison.svg" alt="pas de livraisons" width="50%" height="50%">
                                        <br><br>
                                        <p><strong>Hmmm, il semblerait que vous n'ayez pas encore fait d'achats chez nous pour l'instant. <a href="index.php">Retournez à l'accueil</a> et cherchez quelque chose qui vous plait !</strong></p>
                                    </div>
                                    <?php $prixTotal=0;?>
                                <?php else: //sinon on affiche le tableau ?>
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
                    <br>
                    <table>
                        <thead> <!-- en-tête du tableau -->
                            <tr>
                                <?php if(isset($_GET['debug'])) {echo "<th>debug : Numéro</th>";} ?>
                                <th>Date</th>
                                <th>Adresse</th>
                                <th>Code Postal</th>
                                <th>Ville</th>
                                <th>Prix TTC</th>
                                <th>état</th>
                                <th>Produits achetés</th>
                                <?php if(isset($_GET['debug'])) {echo "<th>debug : nextStep</th>";} ?>
                            </tr>
                        </thead>
                        <tbody> <!-- corps du tableau -->
                                <?php //affichage des données des commandes
                                foreach ($req as $ligne) {
                                    $mail = $DB->query("SELECT email from _client where idClient = $ligne->idClient"); // récupération du mail du client
                                    if (isset($_GET['mail']) && $_GET['mail'] != '') {    // si la recherche par mail est activée
                                        if (stripos($mail[0]['email'],$_GET['mail'])!==false){
                                            echo "<tr>";
                                            if(isset($_GET['debug'])){echo '<td>' . $ligne['numCommande'] . '</td>';}
                                            echo '<td>' . $ligne['dateCommande'] . '</td>';
                                            echo '<td>' . $ligne['adresseLiv'] . '</td>';
                                            echo '<td>' . $ligne['codePostal'] . '</td>';
                                            echo '<td>' . $ligne['ville'] . '</td>';
                                            str_replace('.',',',$ligne['prixTotal']);
                                            echo '<td>' . $ligne['prixTotal'] . '</td>';
                                            echo '<td>' . $state[$ligne['etat']] . '</td>';
                                            echo '<td>' . $ligne['produits'] . '</td>';
                                            if(isset($_GET['debug'])){echo '<td>' . $ligne['nextStep'] . '</td>';}
                                            echo '</tr>';
                                        }
                                    }
                                    else {
                                        echo "<tr>";
                                            if(isset($_GET['debug'])){echo '<td>' . $ligne->numCommande . '</td>';}
                                            $date = new DateTime($ligne->dateCommande);
                                            $date->setTimezone(new DateTimeZone('Europe/Paris'));
                                            $ligne->dateCommande = $date->format('d/m/Y');
                                            echo '<td>' . $ligne->dateCommande . '</td>';
                                            echo '<td>' . $ligne->adresseLiv . '</td>';
                                            echo '<td>' . $ligne->codePostal . '</td>';
                                            echo '<td>' . $ligne->ville . '</td>';
                                            str_replace('.',',',$ligne->prixTotal);
                                            echo '<td>' . $ligne->prixTotal . '</td>';
                                            echo '<td>' . $state[$ligne->etat] . '</td>';
                                            
                                            $prods = $DB->query("SELECT idProduit,qte from _recap where numCommande = $ligne->numCommande");    // récupération des produits de la commande
                                            echo '<td><ul>';
                                            foreach ($prods as $id) {
                                                $nom = $DB->query("SELECT nom from _produit where idProduit = $id->idProduit");    // récupération du nom de chaque produit
                                                echo '<li>' . $nom[0]->nom . ' x ' . $id->qte . '</li>';
                                            }
                                            echo '</ul></td>';
                                            if(isset($_GET['debug'])){echo '<td>' . $ligne->nextStep . '</td>';}
                                            echo '</tr>';
                                        
                                    }
                                }
                            endif;?>
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
    </body>
    <?php 
    require('footer.php');
    ?>
    <script src="./js/jquery.min.js"></script> <!-- Promis c'est que pour Bootstrap 😇 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
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