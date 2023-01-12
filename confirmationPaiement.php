<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de votre Paiement</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
include 'header.php';
?>
<!-- Définition des styles de la page (on utilise pas bootstrap pour cette petite page qui a vocation à être affichée 5 secondes seulement) -->
<style>
    .conteneur{
        margin-top: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-family: Arial, Helvetica, sans-serif;
    }
    body{
        position: relative;
    }
</style>

<!-- Script Php -->
<?php
// on vérifie qu'il y a bien une valeur dans la variable de session price car sinon cela veut dire que l'utilisateur a essayé de se rendre sur cette page sans passer par la page checkout.php
if($_SESSION['price']==""){
    // si la variable de dession price est vide alors on redirige l'utilisateur vers la page index.php
    header("Location: http://localhost/Site-de-marketplace/");
}
// sinon on peut afficher le contenu de la page
else{
    // on attribue la valeur de la variable de session price à la variable $price
    $price = $_SESSION['price'];
    // on unset la valeur de la variable de session price pour éviter que l'utilisateur puisse revenir sur cette page en appuyant sur le bouton retour de son navigateur
    //unset($_SESSION['price']);

    // on affiche ensuite le contenu de la page

    echo
    "<div class='conteneur'>
        <h1>Confirmation de votre paiement</h1>
        <p>Votre paiement de $price € a bien été accepté par notre organisme de paiement</p>
        <p>Alizon vous remercie de votre confiance</p>
        <button type='button' id='livraisons' name='submit' class='btn btn-primary'  onclick='window.location.href = `./listeCommandes.php`'>Voir les commandes effectués</button>
        <button type='button' id='accueil' name='submit' class='btn btn-primary'  onclick='window.location.href = `./index.php`'>Retour à l'accueil</button>
    </div>";
    // on laisse le choix a l'utilisateur de consulter ses commandes ou de retourner a l'accueil
}
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
include 'footer.php';
?>
<?php

// ici on s'occupe d'insérer le CA réalisé par la commande
// ça marche mais c'est ghetto
$price = $_SESSION['price'];
$req = $DB->query("INSERT INTO _vendeur(CA) VALUES ('$price')");


// script qui s'occupe d'insérer les données de la commande dans la base de données
$dataClient = $DB->query('select * from _client where idClient=:idClient', array('idClient'=>$_SESSION['id']));
$DB->query('insert into _commande (idClient, ville, adresseLiv, codePostal,prixTotal) values (:idClient, :ville, :adresse, :codePostal,:prixTotal)', array('idClient'=>$_SESSION['id'], 'ville'=>$dataClient[0]->ville, 'adresse'=>$dataClient[0]->adresse, 'codePostal'=>$dataClient[0]->codePostal,'prixTotal'=>$_SESSION['price']));
//echo $DB->lastInsertId();
$numCommandeClient = $DB->lastInsertId();
//echo "id commande : ".$numCommandeClient;

// prendre les données du panier
$panier = $DB->query('select * from _panier where idClient=:idClient', array('idClient'=>$_SESSION['id']));
foreach ($panier as $data){
    $produit = $DB->query('select * from _produit where idProduit=:idProduit', array('idProduit'=>$data->idProduit));
    //echo "<p> Id du produit : ".$data->idProduit."</p>";
    //echo "<p> Quantité : ".$data->qte."</p>";
    //echo "<p> Prix : ".$produit[0]->prixTotal."</p>";
    //var_dump($produit);
    // on insère les données dans la table recap
    $DB->query('insert into _recap (numCommande, idProduit, qte, prix) values (:numCommande, :idProduit, :qte, :prixTotal)', array('numCommande'=>$numCommandeClient, 'idProduit'=>$data->idProduit, 'qte'=>$data->qte, 'prixTotal'=>$produit[0]->prixTotal));
    //echo "<hr>";

    // on supprime les données du panier
    $DB->query('delete from _panier where idClient=:idClient', array('idClient'=>$_SESSION['id']));
}
?>
<!-- <script>
    // on attend 5 secondes
    setTimeout(function(){
        // on redirige l'utilisateur vers la page index.php
        window.location.href = "http://localhost/Site-de-marketplace/";
    }, 5000);
</script> -->
</body>
</html>