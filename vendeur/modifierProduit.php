<?php
    // Connexion à la base de données
    require 'db.class.php';
    $DB=new DB();
    // requête de récupération des informations du produit
    $req = $DB->query("SELECT * FROM _produit WHERE idProduit = ${_GET['idProd']}");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta charset="utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        
        <title>Modif Produit COBREC</title>
        
        <meta name="description" content="Formulaire de modification d'un produit" />
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
                        <h1>Modifier Produit N°<?php echo $_GET['idProd']." - ".$req[0]->nom;?></h1>
                    </header><br>
                    <div class="row d-flex justify-content-center"> <!-- formulaire -->
                        <form id='formProduit' class="col-6" method='post' action='listeProduits.php?idProd=<?php echo $_GET['idProd'] ?>' enctype='multipart/form-data'>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="idProd">Numéro de produit : </label>&nbsp;
                                <input name="idProd" type="text" class="form-control" value='<?php echo $_GET['idProd'];?>' disabled>
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="nom">Nom : </label>&nbsp;
                                <input name="nom" type="text" class="form-control" value="<?php echo $req[0]->nom; ?>">
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="prixUnit">Prix Unitaire : </label>&nbsp;
                                <input name="prixUnit" type="number" class="form-control" step="0.01" min="0" value='<?php echo $req[0]->prixUnit; ?>'>
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="prixLiv">Frais de Livraison : </label>&nbsp;
                                <input name="prixLiv" type="number" class="form-control" step="0.01" min="0"  value='<?php echo $req[0]->prixLiv; ?>'>
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="tauxTVA">Taux de TVA : </label>&nbsp;
                                <select id="idProd" name="tauxTVA" value="20">
                                    <option value="">Choisissez un taux</option> 
                                    <option value="20" <?php if ($req[0]->tauxTVA==20) echo "selected";?>>Taux Normal - 20%</option>
                                    <option value="10" <?php if ($req[0]->tauxTVA==10) echo "selected";?>>Taux intermédiaire - 10 %</option>
                                    <option value="5.5" <?php if ($req[0]->tauxTVA==5.5) echo "selected";?>>Taux réduit - 5,5 %</option>
                                    <option value="2.1" <?php if ($req[0]->tauxTVA==2.1) echo "selected";?>>Taux particulier - 2,1 %</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="photo1">Photo 1 : </label>&nbsp;
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
                                <input class="form-check-input" type="radio" name="categorie" value="Textile" <?php if ($req[0]->categorie=="Textile") echo "checked";?>>
                                <label class="form-check-label">Textile</label>
                                <input class="form-check-input" type="radio" name="categorie" value="Alimentaire" <?php if ($req[0]->categorie=="Alimentaire") echo "checked";?>>
                                <label class="form-check-label">Alimentaire</label>
                                <input class="form-check-input" type="radio" name="categorie" value="Souvenir" <?php if ($req[0]->categorie=="Souvenir") echo "checked";?>>
                                <label class="form-check-label">Souvenir</label>
                                <input class="form-check-input" type="radio" name="categorie" value="NULL" <?php if ($req[0]->categorie=="NULL") echo "checked";?>>
                                <label class="form-check-label">Pas de catégorie</label>
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="descript">Description : </label>&nbsp;
                                <textarea name="descript" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $req[0]->descript;?></textarea>
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="stock">Stock : </label>&nbsp;
                                <input name="stock" type="number" pattern="\d*" class="form-control" min="0" value='<?php echo $req[0]->stock; ?>'>
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="seuilAlerte">Seuil d'Alerte : </label>&nbsp;
                                <input name="seuilAlerte" type="number" pattern="\d*" class="form-control" min="0" value='<?php echo $req[0]->seuilAlerte; ?>'>
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="interditMineurs">Interdit aux Mineurs : </label>&nbsp;
                                <input class="form-check-input" type="radio" name="interditMineurs" value="1" <?php if ($req[0]->interditMineurs==1) echo "checked";?>>
                                <label class="form-check-label">Oui</label>
                                <input class="form-check-input" type="radio" name="interditMineurs" value="0" <?php if ($req[0]->interditMineurs==0) echo "checked";?>>
                                <label class="form-check-label">Non</label>
                            </div>
                            <div class="form-row">
                                <label style="font-weight: bold;" for="masque">Porduit Masqué : </label>&nbsp;
                                <input class="form-check-input" type="radio" name="masque" value="1" <?php if ($req[0]->masque==1) echo "checked";?>>
                                <label class="form-check-label">Oui</label>
                                <input class="form-check-input" type="radio" name="masque" value="0" <?php if ($req[0]->masque==0) echo "checked";?>>
                                <label class="form-check-label">Non</label>
                            </div>
                            <br/>
                            <button style="width:100%" type="submit" name="action" value="modif" class="btn btn-primary">Modifier</button><br/><br/><br/>
                        </form>
            
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>