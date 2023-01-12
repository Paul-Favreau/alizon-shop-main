<?php
    // CE FICHIER VA SERVIR A INCLUDE PLUS PROPREMENT TOUS LES TRUCS DONT ON A BESOIN DANS LE HEADER
    // IL FAUT DONC INCLURE CE FICHIER DANS LE VRAI HEADER ET RIEN OUBLIER DEDANS 
    require 'db.class.php';
    require 'panier.class.php';
    $DB=new DB();
    $panier = new panier($DB);
    // A chaque fois que le header est chargé, on vérifie si l'utilisateur est bloqué.
    if (isset($_SESSION['id'])) {
        $sesh = $_SESSION['id']; // je peut pas indiquer directement $_SESSION['id'] dans la requete a cause des guillemets, donc je le stocke dans une variable
        $user = $DB->query("select * from _client where idClient='$sesh'");
        if ($user[0]->bloque == 1) { // You've been blocked!
            session_destroy();
            header('Location: connexion.php?blocked=1');
        }
    }
?>
