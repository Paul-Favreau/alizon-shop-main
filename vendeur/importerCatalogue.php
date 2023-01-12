<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta charset="utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        
        <title>Importation d'un catalogue de produits</title>
        
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
                        <h1>Importer un Catalogue</h1>
                    </header><br>
                    
                    <form action="importerCatalogue.php"   method="GET" enctype="multipart/form-data">
                        <label for="file" >Fichier : </label>
                        <input type="file" name="file" id="file" alt="Importer un fichier" accept=".csv" src="../img/icon/folder.svg">
                        <input type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" value="Importer des produits">
                        <input type="submit" formaction="mjStocks.php" class="btn btn-info"  value="Mise à jour des Stocks">
                    </form>
                    <?php
                        if(isset($_GET['file'])  && $_GET['file']!==""){
                                            
                            $file = $_GET["file"]; // On prend le fichier selectionner par l'utilisateur
                            $pass="sae";
                            $user="sae";
                            $var = fopen($file, "r");  //on ouvre le fichier csv
                            $nb_ligne_total = 0;    
                            $erreur = [];      // tableau des lignes d'erreurs avec l'endroit de l'erreur
                            $correct = 0;       // nombre de ligne correcte
                            $bonne_ligne = [];  // tableau avec le numero des lignes correcte
                            $ligne_courante=0; 
                            $x = 0;
                            $i=0;             // compteur pour changer les champs
                            
                                                
                            $db= new PDO("mysql:host=localhost;dbname=alizon_sprint_3", "root", "");
                                                
                                                
                            while (!feof($var)) {
                            //tant que le ficher n'est pas fini
                                $ligne = fgets($var); //on prend chaque ligne du fichier
                                $partie = explode(";", $ligne); // on divise la ligne en partie
                                //print_r($partie);
                                if (count($partie) == 13) {
                                // si il y a 13 partie ?
                                    if (preg_match("/.*\S.*/", $partie[0]) == 0) {
                                    // si le premiere partie est une chaine de caractère
                                                
                                        $erreur[$nb_ligne_total][$x] = 1; // dans un tableau erreur à la ligne
                                        $x += 1;
                                    }
                                    if (preg_match("/.*\S.*/", $partie[1]) == 0) {
                                    //sinon si la deuxieme partie n'est pas une chaine de caractères
                                                
                                        $erreur[$nb_ligne_total][$x] = 2;
                                        $x += 1;
                                    }
                                    if (preg_match("/(.PNG|.png)/", $partie[2]) == 0) {
                                        // sinon si la troisieme partie n'est pas une image en PNG
                            
                                        $erreur[$nb_ligne_total][$x] = 3;
                                        $x += 1;
                                    }
                                    if (preg_match("/(?:\d+(?:\.|,\d*)?|\.|,\d+)/", $partie[3]) == 0) {

                                        $erreur[$nb_ligne_total][$x] = 4;
                                        $x += 1;
                                        //sinon si la quatrième partie n'est pas un nombre à virgule
                                    }

                                    if (preg_match("/(?:\d+(?:\.|,\d*)?|\.|,\d+)/", $partie[4]) == 0) {
                                        //sinon si la cinquieme partie n'est pas un nombre à virgule
                                        $erreur[$nb_ligne_total][$x] = 5;
                                        $x += 1;
                                    }

                                    if (preg_match("/(Alimentation|Souvenir|Textile)/", $partie[5]) == 0) {
                                        $erreur[$nb_ligne_total][$x] = 6;
                                        $x += 1;
                                    }

                                    if (preg_match("/(?:\d+(?:\.|,\d*)?|\.|,\d+)/", $partie[6]) == 0) {
                                        $erreur[$nb_ligne_total][$x] = 7;
                                        $x += 1;
                                    }

                                    if (preg_match("/(.PNG|.png|null|NULL|^$)/", $partie[7]) == 0) {

                                        $erreur[$nb_ligne_total][$x] = 8;
                                        $x += 1;
                                    }

                                    if (preg_match("/(.PNG|.png|null|NULL|^$)/", $partie[8]) == 0) {

                                        $erreur[$nb_ligne_total][$x] = 9;
                                        $x += 1;

                                    }
                                    if (preg_match("/(?:\d+(?:\.|,\d*)?|\.|,\d+)/", $partie[9]) == 0) {
                                            
                                        $erreur[$nb_ligne_total][$x] = 10;
                                        $x += 1;
                                    }
                                    if (preg_match("/(oui|non|true|false)/", $partie[10]) == 0) {
                                        $erreur[$nb_ligne_total][$x] = 11;
                                        $x += 1;
                                    }
                                    if (preg_match("/(?:\d+(?:\.|,\d*)?|\.|,\d+)/", $partie[11]) == 0) {
                                        $erreur[$nb_ligne_total][$x] = 12;
                                        $x += 1;
                                    }
                                    if (preg_match("/(?:\d+(?:\.|,\d*)?|\.|,\d+)/", $partie[12]) == 0) {
                                        $erreur[$nb_ligne_total][$x] = 13;
                                        $x += 1;
                                    }
                                    if ($x == 0) {
                                        $correct += 1;
                                        $bonne_ligne[$correct] = $nb_ligne_total;
                                    }
                                } else {
                                    $erreur[$nb_ligne_total] = ["false"];
                                }
                                $nb_ligne_total += 1;
                            }
                            
                            
                            
                            $nb_ligne_70 = floor(($nb_ligne_total * 10) / 100);

                            if ($correct >= $nb_ligne_70 && $correct < $nb_ligne_total) {
                                
                                $var = fopen($file, "r");  //compteur de la ligne où on est rendu
                            
                                while (!feof($var)) {           // tant que le fichier n'est pas terminé
                            
                                    $ligne=fgets($var);                  //on divise le fichier en ligne
                                    $partie = explode(";", $ligne);
                                    $partie[0]=str_replace("'", "\'", $partie[0]);
                                    $nom = $partie[0];
                            
                            
                                    $requete="SELECT count(*) from _produit where nom=?";
                                    $stmt = $db->prepare($requete);
                                    $stmt->bindValue(1, $nom);
                                    $stmt->execute();
                                    $res=$stmt->fetch(PDO::FETCH_NUM);
                            
                            
                            
                                    if (in_array($ligne_courante, $bonne_ligne)) {
                                        
                                        if($res[0]==0){
                                            // si la ligne actuelle fait partie des lignes correctes on effectue l'insertion 
                                                                   // on divise ces ligne en differentes parties
                                            $partie[1]=str_replace("'", "\'", $partie[1]);
                                            $description = $partie[1];
                                            $img1 = $partie[2];
                                            if(preg_match("/(?:\d+(?:\,\d*)?|\,\d+)/", $partie[3]) == 1){
                                            
                                                $partie[3]=str_replace(",", ".", $partie[3]);
                                                $prixUnit = $partie[3];

                                            }else{

                                                $prixUnit = $partie[3];
                                            }
                                            if(preg_match("/(?:\d+(?:\,\d*)?|\,\d+)/", $partie[4]) == 1){
                                            
                                                $partie[4]=str_replace(",", ".", $partie[4]);
                                                $tva = $partie[4];
                                            }else{
                                                $tva = $partie[4];
                                            }
                                            
                                            $categorie= $partie[5];
                                            if(preg_match("/(?:\d+(?:\,\d*)?|\,\d+)/", $partie[6]) == 1){
                                            
                                                $partie[4]=str_replace(",", ".", $partie[6]);
                                                $prixLiv = $partie[6];
                                            }else{
                                                $prixLiv = $partie[6];
                                            }
                                            if(preg_match("/^$/", $partie[7])==1){
                                                $partie[7]="null";
                                                $img2 = $partie[7];
                                            }
                                            
                                            if(preg_match("/^$/", $partie[8])==1){
                                                $partie[8]="null";
                                                $img3 = $partie[8];
                                            }
                                            
                                            if(preg_match("/(?:\d+(?:\,\d*)?|\,\d+)/", $partie[9]) == 1){
                                            
                                                $partie[9]=str_replace(",", ".", $partie[9]);
                                                $prixTotal = $partie[9];
                                            }else{
                                                $prixTotal = $partie[9];
                                            }

                                            if (preg_match("/oui|non/", $partie[10]) == 1){

                                                $partie[10]=str_replace("oui",1, $partie[10]);
                                                $partie[10]=str_replace("non",0, $partie[10]);
                                                $interditMineurs = $partie[10];

                                            }
                                            if(preg_match("/(?:\d+(?:\,\d*)?|\,\d+)/", $partie[11]) == 1){
                                            
                                                $partie[11]=str_replace(",", ".", $partie[11]);
                                                $stock = $partie[11];
                                            }else{
                                                $stock = $partie[11];
                                            }
                                            if(preg_match("/(?:\d+(?:\,\d*)?|\,\d+)/", $partie[12]) == 1){
                                            
                                                $partie[12]=str_replace(",", ".", $partie[12]);
                                                $seuilAlerte = $partie[12];
                                            }else{
                                                $seuilAlerte = $partie[12];
                                            }
                                            
                                
                                            if ($nom != "nom") {
                                                // boucle if pour ne pas ajouter l'entête
                                                $sql =
                                                    "INSERT INTO _produit (nom, prixUnit, prixLiv, tauxTVA, prixTotal, photo1, photo2, photo3, categorie, descript, seuilAlerte, stock, interditMineurs) VALUES (:nom, :prixUnit, :prixLiv, :tva, :prixTotal, :img1, :img2, :img3, :categorie, :descript, :seuilAlerte, :stock, :interditMineurs)";
                                                // de la forme $connexion->prepare($requete)
                                                $stmt = $db->prepare($sql);
                                                $stmt->bindParam(":nom", $nom);
                                                $stmt->bindParam(":prixUnit", $prixUnit);
                                                $stmt->bindParam(":prixLiv", $prixLiv);
                                                $stmt->bindParam(":tva", $tva);
                                                $stmt->bindParam(":prixTotal", $prixTotal);
                                                $stmt->bindParam(":img1", $img1);
                                                $stmt->bindParam(":img2", $img2);
                                                $stmt->bindParam(":img3", $img3);
                                                $stmt->bindParam(":categorie", $categorie);
                                                $stmt->bindParam(":descript", $description);
                                                $stmt->bindParam(":seuilAlerte", $zero);
                                                $stmt->bindParam(":stock", $stock);
                                                $stmt->bindParam(":interditMineurs", $interditMineurs);
                                                $stmt->bindParam(":seuilAlerte", $seuilAlerte);
                                                // execution de la requête
                                                $stmt->execute();
                                            }
                                        }
                                    }
                                    $ligne_courante+=1;
                                }
                                echo '<div class="position-relative text-center align-middle col-md-12" style="top: 5%">';
                                echo "<br><p>La majorité de fichier est conforme. Cependant on constate quelques erreurs : <br><p>";
                                echo '<table class="position-relative" style="left: 1px">';
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Ligne</th>";
                                echo "<th>Nom</th>";
                                echo "<th>Description</th>";
                                echo "<th>Image 1</th>";
                                echo "<th>Prix Unitaire (€)</th>";
                                echo "<th>TVA</th>";
                                echo "<th>Catégorie</th>";
                                echo "<th>Prix Livraison</th>";
                                echo "<th>Image 2</th>";
                                echo "<th>Image 3</th>";
                                echo "<th>Prix Total</th>";
                                echo "<th>Interdit aux mineurs</th>";
                                echo "<th>Stock</th>";
                                echo "<th>Seuil d'alerte</th>";
                                echo "</thead>";
                                echo "<tbody>";
                                
                                foreach ($erreur as $ligne => $champs) {  //on parcours le tableau $erreur $key=numero de ligne $value= tableau des champs de la ligne
                                    $ligne += 1;   // on ajoute 1 à la ligne vu que le tableau commence à 0 et qu'il n'y a pas de ligne 0
                                    echo "<td>".$ligne."</td>";
                                    
                                    
                                    
                                    if ($champs[0] == "false") {   // on regard si la premiere valeur des champs du tableau est fausse
                                        echo "<td colspan=13> la ligne ne possède pas 13 champs.</td>";
                                    } else {
                                        print_r($champs);
                                        foreach ($champs as $cle => $numero_champs) { // on parcours le tableau des champs 
                                            while($i<13){
                                                echo " compteur ".$i."numero de champs ".$champs[$cle];
                                                if($i==$numero_champs){  // dès que i est egal à 
                                                    echo "erreur champs".$numero_champs." i vaut ".$i;
                                                    echo "<td>Erreur</td>";
                                                }else{
                                                    echo "<td ></td>";
                                                }
                                                $i+=1; 
                                            }                                            // tant que le compteur i à regarder tous les champs
                                            $i=0;
                                        }
                                        
                                        echo "</div>";
                                    }
                                }
                                echo "</tbody>";
                            
                            } elseif ($correct == $nb_ligne_total) {
                                $var = fopen($file, "r");

                                while (!feof($var)) {
                            
                                    $ligne=fgets($var);                  //on divise le fichier en ligne
                                    $partie = explode(";", $ligne);
                                    $nom = $partie[0];

                                                    
                                    $requete="SELECT count(*) from _produit where nom=?";  // on recupere le nombre de fois ou est present un nombre
                                    $stmt = $db->prepare($requete);
                                    $stmt->bindValue(1, $nom);
                                    $stmt->execute();
                                    $rq1=$stmt->fetch(PDO::FETCH_NUM);


                            
                            
                                        if($rq1[0]==0){   // on verifie si le nom est deja existant dans la bdd

                                            // si la ligne actuelle fait partie des lignes correctes on effectue l'insertion                        // on divise ces ligne en differentes parties
                                            $description = $partie[1];
                                            $img1 = $partie[2];

                                            if(preg_match("/(?:\d+(?:\,\d*)?|\,\d+)/", $partie[3]) == 1){
                                            
                                                $partie[3]=str_replace(",", ".", $partie[3]);
                                                $prixUnit = $partie[3];

                                            }else{

                                                $prixUnit = $partie[3];
                                            }
                                            if(preg_match("/(?:\d+(?:\,\d*)?|\,\d+)/", $partie[4]) == 1){
                                            
                                                $partie[4]=str_replace(",", ".", $partie[4]);
                                                $tva = $partie[4];
                                            }else{
                                                $tva = $partie[4];
                                            }
                                            
                                            $categorie= $partie[5];
                                            if(preg_match("/(?:\d+(?:\,\d*)?|\,\d+)/", $partie[6]) == 1){
                                            
                                                $partie[4]=str_replace(",", ".", $partie[6]);
                                                $prixLiv = $partie[6];
                                            }else{
                                                $prixLiv = $partie[6];
                                            }
                                            
                                            $img2 = $partie[7];
                                            $img3 = $partie[8];

                                            if(preg_match("/(?:\d+(?:\,\d*)?|\,\d+)/", $partie[9]) == 1){

                                                    $partie[9]=str_replace(",", ".", $partie[9]);
                                                    $prixTotal = $partie[9];
                                            }else{
                                                $prixTotal = $partie[9];
                                            }
                                            
                                            if (preg_match("/oui|non/", $partie[10]) == 1){
                                                
                                                $partie[10]=str_replace("oui",1, $partie[10]);
                                                $partie[10]=str_replace("non",0, $partie[10]);
                                                
                                                $interditMineurs = $partie[10];

                                            }
                                            if(preg_match("/(?:\d+(?:\,\d*)?|\,\d+)/", $partie[11]) == 1){
                                            
                                                $partie[11]=str_replace(",", ".", $partie[11]);
                                                $stock = $partie[11];
                                            }else{
                                                $stock = $partie[11];
                                            }
                                            if(preg_match("/(?:\d+(?:\,\d*)?|\,\d+)/", $partie[12]) == 1){
                                            
                                                $partie[12]=str_replace(",", ".", $partie[12]);
                                                $seuilAlerte = $partie[12];
                                            }else{
                                                $seuilAlerte = $partie[12];
                                            }
                                            

                                
                                            if ($nom != "nom") {
                                                // boucle if pour ne pas ajouter l'entête
                                                $sql =
                                                    "INSERT INTO _produit (nom, prixUnit, prixLiv, tauxTVA, prixTotal, photo1, photo2, photo3, categorie, descript, seuilAlerte, stock, interditMineurs) VALUES (:nom, :prixUnit, :prixLiv, :tva, :prixTotal, :img1, :img2, :img3, :categorie, :descript, :seuilAlerte, :stock, :interditMineurs)";
                                                // de la forme $connexion->prepare($requete)
                                                $stmt = $db->prepare($sql);
                                                $stmt->bindParam(":nom", $nom);
                                                $stmt->bindParam(":prixUnit", $prixUnit);
                                                $stmt->bindParam(":prixLiv", $prixLiv);
                                                $stmt->bindParam(":tva", $tva);
                                                $stmt->bindParam(":prixTotal", $prixTotal);
                                                $stmt->bindParam(":img1", $img1);
                                                $stmt->bindParam(":img2", $img2);
                                                $stmt->bindParam(":img3", $img3);
                                                $stmt->bindParam(":categorie", $categorie);
                                                $stmt->bindParam(":descript", $description);
                                                $stmt->bindParam(":seuilAlerte", $seuilAlerte);
                                                $stmt->bindParam(":stock", $stock);
                                                $stmt->bindParam(":interditMineurs", $interditMineurs);
                                                // execution de la requête
                                                $stmt->execute();
                                            }
                                        }
                                        $ligne_courante+=1;
                                }
                                echo '<div class="position-relative text-center align-middle col-md-12" style="top: 170px" >';
                                echo '<img src="../img/icon/check.svg" class="position-relative" style="bottom: 20px"   width="15%" height="15%">';       
                                echo '<p>Le catalogue de produit a été importé avec succès.</p>';
                                echo "</div>";
                                                                    
                            
                            } else {
                                
                                echo '<div class="position-relative text-center align-middle col-md-12" style="top: 170px">';           
                                echo "<p>Le fichier CSV fourni n'est pas au bon format. Veuillez à bien respecter le format ci-dessous en séparant les champs par des points virgules : </p>";
                                echo '<table class="position-relative" style="left: 1px">';
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Ligne</th>";
                                echo "<th>Nom</th>";
                                echo "<th>Description</th>";
                                echo "<th>Image 1</th>";
                                echo "<th>Prix Unitaire (€)</th>";
                                echo "<th>TVA</th>";
                                echo "<th>Catégorie</th>";
                                echo "<th>Prix Livraison</th>";
                                echo "<th>Image 2</th>";
                                echo "<th>Image 3</th>";
                                echo "<th>Prix Total</th>";
                                echo "<th>Interdit aux mineurs</th>";
                                echo "<th>Stock</th>";
                                echo "<th>Seuil d'alerte</th>";
                                echo "</thead>";
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
