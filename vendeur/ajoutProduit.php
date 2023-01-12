<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta charset="utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        
        <title>Ajout Produit COBREC</title>
        
        <meta name="description" content="Formulaire d'ajout de produit" />
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
                        <h1>Ajouter un produit</h1>
                    </header><br>
                    <p>(*) : Champs obligatoires</p>
                    <?php
                        // Si le formulaire est valide
                        if(isset($_POST['nom']) && isset($_POST['prixUnit']) && isset($_POST['prixLiv']) && isset($_POST['tauxTVA']) && isset($_FILES['photo1']) && is_uploaded_file($_FILES['photo1']['tmp_name']) && isset($_POST['descript']) && isset($_POST['stock']) && isset($_POST['seuilAlerte']) && isset($_POST['interditMineurs'])){
                            // affectation des champs optionnels
                            $photo1 = 'images/'.$_FILES['photo1']['name'];
                            if (isset($_FILES['photo2']) && is_uploaded_file($_FILES['photo2']['tmp_name'])) {
                                $photo2='images/'.$_FILES['photo2']['name'];
                            }
                            else {
                                $photo2='NULL';
                            }
                            if(isset($_FILES['photo2']) && is_uploaded_file($_FILES['photo2']['tmp_name'])) {
                                $photo3='images/'.$_FILES['photo3']['name'];
                            }
                            else {
                                $photo3='NULL';
                            }
                            if(isset($_POST['categorie'])) {
                                $categorie=$_POST['categorie'];
                            }
                            else {
                                $categorie='NULL';
                                
                            }
                            $_POST['nom'] = str_replace("'", "\'", $_POST['nom']); // Remplacement des apostrophes par deux apostrophes
                            $_POST['descript'] = str_replace("'", "\'", $_POST['descript']); // Remplacement des apostrophes par deux apostrophes
                            $prixTotal = (($_POST['prixUnit'] + $_POST['prixLiv'])*$_POST['tauxTVA'])/100; // Calcul du prix total
                            $date = date("Y-m-d"); // Récupération de la date du jour
                            // Connexion à la base de données
                            require 'db.class.php';
                            $DB=new DB();
                            // requête d'insertion préparée
                            $req = $DB->query("INSERT INTO _produit(nom, prixUnit, prixLiv, tauxTVA, prixTotal, photo1, photo2, photo3, categorie, descript, stock, seuilAlerte, interditMineurs, dateAjout) VALUES ('${_POST['nom']}', ${_POST['prixUnit']}, ${_POST['prixLiv']}, ${_POST['tauxTVA']}, $prixTotal,'$photo1', '$photo2', '$photo3', '$categorie', '${_POST['descript']}', ${_POST['stock']}, ${_POST['seuilAlerte']}, ${_POST['interditMineurs']}, '$date')");
                            // on copie les photos dans le répertoire images
                            copy($_FILES['photo1']['tmp_name'], 'images/' . $_FILES['photo1']['name']);
                            if (isset($_FILES['photo2']) && is_uploaded_file($_FILES['photo2']['tmp_name'])) copy($_FILES['photo2']['tmp_name'], 'images/' . $_FILES['photo2']['name']);
                            if (isset($_FILES['photo3']) && is_uploaded_file($_FILES['photo3']['tmp_name'])) copy($_FILES['photo3']['tmp_name'], 'images/' . $_FILES['photo3']['name']);
                            // on vide les champs
                            unset($_POST['nom']);
                            unset($_POST['prixUnit']);
                            unset($_POST['prixLiv']);
                            unset($_POST['tauxTVA']);
                            unset($_POST['photo1']);
                            unset($_POST['photo2']);
                            unset($_POST['photo3']);
                            unset($_POST['categorie']);
                            unset($_POST['descript']);
                            unset($_POST['stock']);
                            unset($_POST['seuilAlerte']);
                            unset($_POST['interditMineurs']);
                            // message de confirmation
                            echo "<div class='row d-flex justify-content-center'> <div class='alert alert-success' role='alert'>Le produit a bien été ajouté</div> </div>";
                        }
                        else{
                            // Si le formulaire n'est pas valide, on affiche un message d'erreur en fonction des champs
                            echo "<div class='row d-flex justify-content-center'>";
                            switch (true) {
                                case (isset($_POST['nom']) && empty($_POST['nom'])):
                                    echo "<div class='alert alert-danger col-6' role='alert'>Le nom du produit est vide</div>";
                                    break;
                                case (isset($_POST['prixUnit']) && empty($_POST['prixUnit'])):
                                    echo "<div class='alert alert-danger col-6' role='alert'>Le prix unitaire est vide</div>";
                                    break;
                                case (isset($_POST['prixLiv']) && empty($_POST['prixLiv'])):
                                    echo "<div class='alert alert-danger col-6' role='alert'>Les frais de livraison sont vides</div>";
                                    break;
                                case (isset($_POST['tauxTVA']) && $_POST['tauxTVA']==""):
                                    echo "<div class='alert alert-danger col-6' role='alert'>Le taux de TVA est vide</div>";
                                    break;
                                case (isset($_POST['photo1']) && empty($_POST['photo1'])):
                                    echo "<div class='alert alert-danger col-6' role='alert'>La photo 1 est vide</div>";
                                    break;
                                case (isset($_POST['descript']) && empty($_POST['descript'])):
                                    echo "<div class='alert alert-danger col-6' role='alert'>La description est vide</div>";
                                    break;
                                case (isset($_POST['stock']) && empty($_POST['stock'])):
                                    echo "<div class='alert alert-danger col-6' role='alert'>Le stock est vide</div>";
                                    break;
                                case (isset($_POST['seuilAlerte']) && empty($_POST['seuilAlerte'])):
                                    echo "<div class='alert alert-danger col-6' role='alert'>Le seuil d'alerte est vide</div>";
                                    break;
                                case (isset($_POST['interditMineurs']) && empty($_POST['interditMineurs'])):
                                    echo "<div class='alert alert-danger col-6' role='alert'>L'interdiction aux mineurs est vide</div>";
                                    break;
                            }
                            echo "</div>";
                        }
                    ?>
                    <div class="row d-flex justify-content-center"> <!-- formulaire -->
                        <form id='formProduit' class="col-6" method='post' action='ajoutProduit.php' enctype='multipart/form-data'>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="nom">Nom (*) : </label>&nbsp;
                                <input name="nom" type="text" class="form-control" value="<?php if (isset($_POST['nom'])) echo $_POST['nom'];?>">
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="prixUnit">Prix Unitaire (*) : </label>&nbsp;
                                <input name="prixUnit" type="number" class="form-control" step="0.01" min="0" value="<?php if (isset($_POST['prixUnit'])) echo $_POST['prixUnit'];?>">
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="prixLiv">Frais de Livraison (*) : </label>&nbsp;
                                <input name="prixLiv" type="number" class="form-control" step="0.01" min="0"  value="<?php if (isset($_POST['prixLiv'])) echo $_POST['prixLiv'];?>">
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="tauxTVA">Taux de TVA (*) : </label>&nbsp;
                                <select id="idProd" name="tauxTVA" value="20">
                                    <option value="">Choisissez un taux</option> 
                                    <option value="20" <?php if (isset($_POST['tauxTVA']) && $_POST['tauxTVA']=="20") echo "selected";?>>Taux Normal - 20%</option>
                                    <option value="10" <?php if (isset($_POST['tauxTVA']) && $_POST['tauxTVA']=="10") echo "selected";?>>Taux intermédiaire - 10 %</option>
                                    <option value="5.5" <?php if (isset($_POST['tauxTVA']) && $_POST['tauxTVA']=="5.5") echo "selected";?>>Taux réduit - 5,5 %</option>
                                    <option value="2.1" <?php if (isset($_POST['tauxTVA']) && $_POST['tauxTVA']=="2.1") echo "selected";?>>Taux particulier - 2,1 %</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="photo1">Photo 1 (*) : </label>&nbsp;
                                <input name="photo1" type="file" accept="image/png, image/jpeg, image/jpg" >
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="photo2">Photo 2 : </label>&nbsp;
                                <input name="photo2" type="file" accept="image/png, image/jpeg, image/jpg">
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="photo3">Photo 3 : </label>&nbsp;
                                <input name="photo3" type="file" accept="image/png, image/jpeg, image/jpg">
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="categorie">Categorie : </label>&nbsp;
                                <input class="form-check-input" type="radio" name="categorie" value="Textile" <?php if (isset($_POST['categorie']) && $_POST['categorie']=="Textile") echo "checked";?>>
                                <label class="form-check-label">Textile</label>
                                <input class="form-check-input" type="radio" name="categorie" value="Alimentaire" <?php if (isset($_POST['categorie']) && $_POST['categorie']=="Alimentaire") echo "checked";?>>
                                <label class="form-check-label">Alimentaire</label>
                                <input class="form-check-input" type="radio" name="categorie" value="Souvenir" <?php if (isset($_POST['categorie']) && $_POST['categorie']=="Souvenir") echo "checked";?>>
                                <label class="form-check-label">Souvenir</label>
                                <input class="form-check-input" type="radio" name="categorie" value="NULL" <?php if (isset($_POST['categorie']) && $_POST['categorie']=="NULL") echo "checked";?>>
                                <label class="form-check-label">Pas de catégorie</label>
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="descript">Description (*) : </label>&nbsp;
                                <textarea name="descript" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php if (isset($_POST['descript'])) echo $_POST['descript'];?></textarea>
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="stock">Stock (*) : </label>&nbsp;
                                <input name="stock" type="number" pattern="\d*" class="form-control" min="0" value="<?php if (isset($_POST['stock'])) echo $_POST['stock'];?>">
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="seuilAlerte">Seuil d'Alerte (*) : </label>&nbsp;
                                <input name="seuilAlerte" type="number" pattern="\d*" class="form-control" min="0" value="<?php if (isset($_POST['seuilAlerte'])) echo $_POST['seuilAlerte'];?>">
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="interditMineurs">Interdit aux Mineurs (*) : </label>&nbsp;
                                <input class="form-check-input" type="radio" name="interditMineurs" value="1" <?php if (isset($_POST['interditMineurs']) && $_POST['interditMineurs']=="1") echo "checked";?>>
                                <label class="form-check-label">Oui</label>
                                <input class="form-check-input" type="radio" name="interditMineurs" value="0" <?php if (isset($_POST['interditMineurs']) && $_POST['interditMineurs']=="0") echo "checked";?>>
                                <label class="form-check-label">Non</label>
                            </div>
                            <br/>
                            <button style="width:100%" type="submit" class="btn btn-primary">Ajouter</button><br/><br/><br/>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>