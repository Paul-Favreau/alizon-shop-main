<?php
session_start();
include("_header.php");
echo "valeur de l'id : " .$_GET["id_client"];
$req = $DB->query('SELECT * FROM _client WHERE idClient = :id_client', array("id_client" => $_GET["id_client"]));
$cpt = 0;
echo "Etat initial : ";
if ($req[$cpt]->bloque == 1){
    echo "Bloqué";
} else {
    echo "Non bloqué";
}

//   UPDATE table
//   SET nom_colonne_1 = 'nouvelle valeur'
//   WHERE condition
if ($req[$cpt]->bloque == 1) {
    $DB->query("UPDATE _client SET bloque = 0 WHERE idClient = :id_client", array("id_client" => $_GET["id_client"]));
    header('Location: user.php?unblocksuccess=1');
} else {
    $DB->query("UPDATE _client SET bloque = 1 WHERE idClient = :id_client", array("id_client" => $_GET["id_client"]));
    header('Location: user.php?blocksuccess=1');
}
?>
