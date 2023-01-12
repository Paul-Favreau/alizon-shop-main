<?php
    include("_header.php");
    //var_dump($_POST);

    $note=$_POST['note'];
    $commentaire=$_POST['commentaire'];
    $idproduit=$_POST['idproduit'];
    if(isset($_SESSION['id'])){
        $idclient=$_SESSION['id'];
    }
    else{
        $idclient=1;
    }
    //print_r($_FILES);
    //copy($_FILES['image']['tmp_name'], "img/imgcommentaire/".$_FILES['image']['name']); //pour ajouter l'image en local
    //$image="img/imgcommentaire/".$_FILES['image']['name'];//pour le chemin de l'image dans la base de donnée
    if (isset($_POST['rating'])) {
        $rating = $_POST['rating'];
        echo('mamadou');
        var_dump($rating);
        //traitement de la note avec la base de données ou autre.
    }

    //$DB->query("INSERT INTO _commentaire (note, contenu, idProduit, idClient, image) VALUES ('$note', '$commentaire', '$idproduit', '$idclient', '$image')");






?>