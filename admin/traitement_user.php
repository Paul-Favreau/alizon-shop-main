<?php
session_start();
include("_header.php");
/*echo "prenom : ".$_POST["prenom"];
echo  "valeur de l'id : " .$_POST["id_client"];  
echo "<br>";
echo "nom : ".$_POST["nom"];
echo "<br>";
echo "prenom : ".$_POST["prenom"];
echo "<br>";
echo "email : ".$_POST["email"];
echo "<br>";
echo "adresse : ".$_POST["adresse"];

//   UPDATE table
//   SET nom_colonne_1 = 'nouvelle valeur'
//   WHERE condition
var_dump($_POST);
*/
$DB->query('update _client set nom=:nom , prenom=:prenom , email=:email, adresse=:adresse, tel=:tel, ville=:ville, codePostal=:codePostal, dateNaissance=:dateNaissance where idClient=:monId', array('nom'=>$_POST["nom"],'prenom'=>$_POST["prenom"],'email'=>$_POST["email"], 'adresse'=>$_POST["adresse"], 'tel'=>$_POST["tel"], 'ville'=>$_POST["ville"], 'codePostal'=>$_POST["codePostal"], 'dateNaissance'=>$_POST["dateNaissance"],  'monId'=>$_POST["id_client"]));
header("Location: user.php");
?>