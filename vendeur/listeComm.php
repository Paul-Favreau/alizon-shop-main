<?php
    // Connexion à la base de données
    require 'db.class.php';
    $DB = new DB();
    if(isset($_POST["reponse"])){
        // requête de modification de la réponse
        $_POST['reponse'] = str_replace("'", "\'", $_POST['reponse']);
        $req = $DB->query("UPDATE _commentaire SET reponse='".$_POST['reponse']."' WHERE idComm = ${_GET['idComm']}");
    }
    elseif (isset($_GET['idComm']) && isset($_GET['action']) && $_GET['action'] === "Signaler") {
        // requête de modification du signalement
        $req = $DB->query("UPDATE _commentaire SET signale=true WHERE idComm = ${_GET['idComm']}");
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta charset="utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        
        <title>Liste Commentaires COBREC</title>
        
        <meta name="description" content="Page contenant la liste des commentaires de la COBREC" />
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
                        <h1>Liste des Commentaires</h1>
                    </header><br>
                    <?php
                        if(isset($_POST["reponse"])){
                            echo "<div class='alert alert-success' role='alert'>La réponse du commentaire N°${_GET['idComm']} a bien été modifiée</div>";
                        }
                        elseif (isset($_GET['idComm']) && isset($_GET['action']) && $_GET['action'] === "Signaler") {
                            echo "<div class='alert alert-success' role='alert'>Le commentaire N°${_GET['idComm']} a bien été signalé</div>";
                        }
                    ?>
                    <div class="row d-flex align-middle">  <!-- barre de recherche -->
                        <form class="col-4 d-flex" method="get" action="listeComm.php">
                            <input id="recherche" class="form-control" type="text" placeholder="Rechercher par nom de produit" name="nom" <?php  if (isset($_GET['nom'])) echo "value='${_GET['nom']}'";?>  onkeyup="griserBouton()" onkeydown="griserBouton()" onfocus="griserBouton()" onblur="griserBouton()">&nbsp;
                            <input id='btnRecherche' type="submit" class="btn btn-primary" <?php
                                if(!isset($_GET['nom']) || $_GET['nom'] === ""){ // si le nom n'est pas renseigné on grise le bouton de recherche
                                    echo "disabled";
                                }
                            ?> value="Rechercher">
                        </form>
                        <?php
                            if(isset($_GET['nom']) && $_GET['nom'] !== "") {    // si le nom est renseigné on affiche le bouton de suppression
                                echo "<button type='button' class='btn-close  recherche' aria-label='Close' onclick='annulerRecherche()'></button>";
                            }
                        ?>
                    </div>
                    <table>
                        <thead> <!-- en-tête du tableau -->
                            <tr>
                                <th>Numéro</th>
                                <th>Nom du Produit</th>
                                <th>Nom du Client</th>
                                <th>Mail du Client</th>
                                <th>Date de publication</th>
                                <th>Note</th>
                                <th>Commentaire</th>
                            </tr>
                        </thead>
                        <tbody> <!-- corps du tableau -->
                            <?php
                                // Connexion à la base de données et récupération des données des commentaires 
                                $req =  $DB->query("SELECT idComm,idProduit,idClient,datePubli,note,contenu,reponse,signale from _commentaire");
                                //affichage des données des commentaires
                                foreach ($req as $ligne) {
                                    // récupération des noms de produit et de client
                                    $nomClient = $DB->query("SELECT nom,prenom,email from _client where idClient = $ligne->idClient");
                                    $nomProd = $DB->query("SELECT nom from _produit where idProduit = $ligne->idProduit");
                                    if (isset($_GET['nom']) && $_GET['nom'] != '') {    // si la recherche par nom est activée
                                        if (stripos($nomProd[0]->nom,$_GET['nom'])!==false){
                                            echo "<tr>";
                                            echo '<td>' . $ligne->idComm . '</td>';
                                            echo '<td>' . $nomProd[0]->nom . '</td>';
                                            echo '<td>'. $nomClient[0]->nom." ".$nomClient[0]->prenom.'</td>';
                                            echo '<td>' . $nomClient[0]->email . '</td>';
                                            // date de publication en français
                                            $date = new DateTime($ligne->datePubli);
                                            $date->setTimezone(new DateTimeZone('Europe/Paris'));
                                            $ligne->datePubli = $date->format('d/m/Y');
                                            echo '<td>' . $ligne->datePubli . '</td>';
                                            echo '<td>' . $ligne->note . '/5</td>';
                                            echo '<td>' . $ligne->contenu . '</td>';
                                            echo "<td><button type='button' class='btn btn-primary' id='btnSupp' data-bs-toggle='modal' data-bs-target='#modalRep'>Répondre</button>
                                            <br><br>";
                                            if(!$ligne->signale){
                                                echo "<button type='button' class='btn btn-primary' id='btnSupp' data-bs-toggle='modal' data-bs-target='#modalSig'>Signaler</button>";
                                            }
                                            else{
                                                echo "<button type='button' class='btn btn-primary' id='btnSupp' data-bs-toggle='modal' data-bs-target='#modalSig' disabled>Signalé</button>";
                                            }
                                            echo "</td>";
                                            //fenêtre modale de réponse au commentaire
                                            echo "<div class='modal fade' id='modalRep' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog modal-dialog-centered'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h1 class='modal-title fs-5' id='exampleModalLabel'>Répondre au commentaire N°". $ligne->idComm."</h1>
                                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                        </div>
                                                        <form method='post' action='listeComm.php?idComm=$ligne->idComm'>
                                                            <div class='modal-body'>
                                                                <div class='form-group'>
                                                                    <label for='message-text' class='col-form-label'>Message:</label>
                                                                    <textarea class='form-control' rows='3' id='message-text rep' name='reponse'>".$ligne->reponse."</textarea>
                                                                </div>
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-danger btn-lg ' data-bs-dismiss='modal'>Annuler</button>
                                                                <input type='submit' id='btnValid' class='btn btn-primary btn-lg' aria-label='Close' name='action' value='Confirmer'></input>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>";
                                            //fenêtre modale de signalement du commentaire
                                            echo "<div class='modal fade' id='modalSig' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog modal-dialog-centered'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h1 class='modal-title fs-5' id='exampleModalLabel'>Signaler le commentaire N°". $ligne->idComm."</h1>
                                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                        </div>
                                                        <div class='modal-body text-center'>
                                                            Voulez-vous vraiment signaler ce commentaire ?
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <button type='button' class='btn btn-danger btn-lg ' data-bs-dismiss='modal'>Non</button>
                                                            <button type='button' class='btn btn-primary btn-lg' aria-label='Close' name='action' value='Signaler' onclick='signalerComm()'>Oui</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>";
                                            echo '</tr>';
                                        }
                                    }
                                    else {
                                        echo "<tr>";
                                        echo '<td>' . $ligne->idComm . '</td>';
                                        echo '<td>' . $nomProd[0]->nom . '</td>';
                                        echo '<td>'. $nomClient[0]->nom." ".$nomClient[0]->prenom.'</td>';
                                        echo '<td>' . $nomClient[0]->email . '</td>';
                                        // date de publication en français
                                        $date = new DateTime($ligne->datePubli);
                                        $date->setTimezone(new DateTimeZone('Europe/Paris'));
                                        $ligne->datePubli = $date->format('d/m/Y');
                                        echo '<td>' . $ligne->datePubli . '</td>';
                                        echo '<td>' . $ligne->note . '/5</td>';
                                        echo '<td>' . $ligne->contenu . '</td>';
                                        echo "<td><button type='button' class='btn btn-primary' id='btnSupp' data-bs-toggle='modal' data-bs-target='#modalRep'>Répondre</button>
                                            <br><br>";
                                        if(!$ligne->signale){
                                            echo "<button type='button' class='btn btn-primary' id='btnSupp' data-bs-toggle='modal' data-bs-target='#modalSig'>Signaler</button>";
                                        }
                                        else{
                                            echo "<button type='button' class='btn btn-primary' id='btnSupp' data-bs-toggle='modal' data-bs-target='#modalSig' disabled>Signalé</button>";
                                        }
                                        echo "</td>";
                                        //fenêtre modale de réponse au commentaire
                                        echo "<div class='modal fade' id='modalRep' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog modal-dialog-centered'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Répondre au commentaire N°". $ligne->idComm."</h1>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <form method='post' action='listeComm.php?idComm=$ligne->idComm'>
                                                        <div class='modal-body'>
                                                            <div class='form-group'>
                                                                <label for='message-text' class='col-form-label'>Message:</label>
                                                                <textarea class='form-control' rows='3' id='message-text rep' name='reponse'>".$ligne->reponse."</textarea>
                                                            </div>
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <button type='button' class='btn btn-danger btn-lg ' data-bs-dismiss='modal'>Annuler</button>
                                                            <input type='submit' id='btnValid' class='btn btn-primary btn-lg' aria-label='Close' name='action' value='Confirmer'></input>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>";
                                        //fenêtre modale de signalement du commentaire
                                        echo "<div class='modal fade' id='modalSig' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog modal-dialog-centered'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Signaler le commentaire N°". $ligne->idComm."</h1>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body text-center'>
                                                        Voulez-vous vraiment signaler ce commentaire ?
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-danger btn-lg ' data-bs-dismiss='modal'>Non</button>
                                                        <button type='button' class='btn btn-primary btn-lg' aria-label='Close' name='action' value='Signaler' onclick='signalerComm()'>Oui</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
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
            window.location.replace("listeComm.php");
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
            if(document.getElementById("rep").value == "") {
                document.getElementById("btnValid").disabled = true;
            }
            else {
                document.getElementById("btnValid").disabled = false;
            }
        }

        // fonction qui signale le commentaire
        function signalerComm() {
            window.location.replace("listeComm.php?idComm=<?php echo $ligne->idComm; ?>&action=Signaler");
        }
    </script>
</html>