<?php 
// information de connexion de la base de donnée
$host = "46.105.171.70";
$user = "noahdevf_route";
$pass = "pp3RCel6DNygNsfxWcxF";
$db = "alizon_sprint_3";
// définiton de la variable $pdo qui contient la connexion à la base de donnée
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
// test     
    if($pdo){
        echo "Connected";
    }else{
        echo "Not Connected"; 
    }
?>