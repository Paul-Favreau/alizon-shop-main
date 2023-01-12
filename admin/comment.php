<?php
include("_header.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta charset="utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        
        <title>Alizon | Gestion des commentaires</title>
        <link rel="icon" type="image/png" sizes="16x16" href="icon.png">    <!-- Icone de la page -->
        <link rel="stylesheet" href="style.css">    <!-- Feuille de style -->
        <!-- Intégration des fichiers Bootstrap -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">   <!-- définition d'un conteneur fluid -->
            <div class="row" >          <!-- ligne définie avec 2 colonnes -->
                <nav class="col-3 vingt">     <!-- colonne de navigation -->
                    <div class="d-flex justify-content-around">
                        <!-- <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href='index.php'">Accueil</button> -->
                        <a href="index.php" id="dashboard-title">DashBoard</a>
                    </div>
                    <a href="user.php">Gestion des comptes</a>
                    
                    <a href="comment.php">Gestion des commentaires</a>
                </nav>
            
            <main class="col-9">
            <main class="col-10">  <!-- colonne principale -->
                    <header>
                        <h1>Liste des Commentaires</h1>
                    </header><br>
                    
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
                                
                                <th>Numéro Commentaire</th>
                                <th>Produit</th>
                                <th>Date de Publication</th>
                                <th>Mail du Client</th>
                                <th>Date de publication</th>
                                <th>Note</th>
                                <th>Nombre de pouces Haut</th>
                                <th>Nombre de pouces Bas</th>
                                <th>Commentaire</th>
                                
                            </tr>
                        </thead>
                        <tbody> <!-- corps du tableau -->
                            <?php
                                // Connexion à la base de données et récupération des données des commentaires 
                                $req =  $DB->query("SELECT * from _commentaire WHERE signale=1 ");
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
                                           
                                            
                                           
                                            echo "</td>";
                                            
                                            
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
                                        echo  '<td>' . $ligne->nbPoucesHaut . '/5</td>';
                                        echo  '<td>' . $ligne->nbPoucesBas . '/5</td>';
                                        echo '<td>' . $ligne->contenu . '</td>';
                                       
                                        
                                        echo "</td>";
                                        //fenêtre modale de réponse au commentaire
                                       
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    
                </main>
            </main>
        </div>
    </div>
    </body>
</html>