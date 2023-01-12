<?php
    require 'db.class.php';
    $DB = new DB();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta charset="utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        
        <title>DashBoard COBREC</title>
        
        <meta name="description" content="Page d'accueil du tableau de bord vendeur" />
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
            
                <main class="col-10"> <!-- colonne principale -->
                    <header>
                        <h1>Tableau de bord</h1>
                    </header><br>

                    <h2>Statistiques globales :</h2>
                    <div class="d-flex justify-content-around">
                        <article>
                            <?php
                                // Connexion à la base de données et récupération de la somme des montants des ventes
                                $req = $DB->query('SELECT sum(prixTotal) as sum from _commande');
                                str_replace('.', ',', $req[0]->sum);
                                if($req[0]->sum == NULL) {
                                    $req[0]->sum = 0;
                                }
                                $req[0]->sum = number_format($req[0]->sum, 2, ',', ' ');
                                echo '<p>'.$req[0]->sum.' EUR</p>';
                            ?>
                            <h5>Chiffre d'affaires</h5>
                        </article>
                        <article>
                            <?php
                                // Connexion à la base de données et récupération du nombre de commandes 
                                $req = $DB->query('SELECT count(*) as count from _commande');
                                if($req[0]->count == NULL) {
                                    $req[0]->count = 0;
                                }
                                
                                echo '<p>'.$req[0]->count.'</p>';
                            ?>
                            <h5>Nombre de commandes effectuées</h5>
                        </article>
                        <article>
                            <?php
                                // Connexion à la base de données et récupération des montants des produits commandés
                                $req = $DB->query('SELECT sum(qte) as sum from _recap');
                                if($req[0]->sum == NULL) {
                                    $req[0]->sum = 0;
                                }   
                                echo '<p>'.$req[0]->sum.'</p>';
                            ?>
                            <h5>Nombre de produits vendus</h5>
                        </article>
                    </div>
                    <br>
                    <h2>Montant des dernières commandes :</h2>
                    <style>
                        .graphique{
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        }
                    </style>

                    <div class="graphique">
                        <!-- https://developers.google.com/chart/interactive/docs/gallery/linechart?hl=fr-->
                        <?php
                            $donneeCA = $DB->query("SELECT numCommande,dateCommande,prixTotal FROM _commande ORDER BY dateCommande LIMIT 10");
                            $tabCA = array();
                            foreach ($donneeCA as $value){
                                array_push($tabCA,[$value->prixTotal,$value->dateCommande]);
                            }
                            $tabCA_json = json_encode($tabCA);
                        ?>
                        <script>
                            var tabCA = <?php echo $tabCA_json; ?>;
                        </script>
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            // Conditions pour vérifier si il y a des données à afficher
                            // car google charts affiche une erreur pas jolie par défaut
                            if(tabCA.length==0){
                                document.getElementById("erreurAucuneValeur").innerHTML = "Il n'y a aucune valeur à afficher, le graphique ne peut être affiché";
                            }
                            // dans le cas où il y a bien des données à afficher
                            else{
                                google.charts.load('current', {'packages':['corechart']});
                                google.charts.setOnLoadCallback(drawChart);

                                function drawChart() {
                                    var donnees = [['Date', "Valeur de la commande"]];
                                    for (let i = 0; i < tabCA.length; i++) {
                                        let date = new Date(tabCA[i][1]);
                                        let dateFormatee = date.getDate()+"/"+(date.getMonth()+1)+"/"+date.getFullYear();
                                        let montant = tabCA[i][0];
                                        donnees.push([dateFormatee, montant]);
                                    }

                                    // on peut même ajouter une troisième colonne par exemple le nombre de commande //todo à faire
                                    var data = google.visualization.arrayToDataTable(donnees);

                                    var options = {
                                        curveType: 'function',
                                        legend: { position: 'bottom' }
                                    };

                                    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                                    chart.draw(data, options);
                                }
                            }
                        </script>
                        <?php
                        if(!empty($donneeCA)){
                            echo "<article>
                                <div id='curve_chart' style='width: 900px; height: 500px'></div>
                            </article>";
                        }
                        else{ // Ce paragraphe sert à dire qu'il n'y a aucune valeur si le tableau est vide
                            echo "<div class='d-flex'>
                                    <div class='alert alert-danger' role='alert'>Il n'y a aucune valeur à afficher, le graphique ne peut être affiché</div>
                                </div>";
                        }
                        
                        ?>
                    </div>
                    <h2>Alertes de stocks : </h2>
                    <?php
                        // Connexion à la base de données et récupération des données des produits qui sont en alerte de stocks 
                        $req = $DB->query('SELECT idProduit, nom, stock, seuilAlerte FROM _produit WHERE stock < seuilAlerte');
                        if (empty($req)) {   // si aucun produit n'est en alerte
                            echo '<p>Aucune alerte de stock</p>';
                        } else {
                            echo "<ul>";
                            foreach ($req as $ligne) {
                                echo "<li> Produit n°".$ligne->idProduit." - '".$ligne->nom."' (seuil d'alerte : <strong>". $ligne->seuilAlerte ."</strong> et stock : <strong>". $ligne->stock ."</strong>) <a href='listeStock.php?nom=".$ligne->nom."'>Réapprovisionner</a></li>";
                            }
                            echo "</ul>";
                        }
                    ?>
                </main>
            </div>
        </div>
    </body>
</html>