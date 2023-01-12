<?php 
// information de connexion de la base de donnée
$host = "localhost";
$user = "sae";
$pass = "sae";
$db = "alizon_sprint_3";
// définiton de la variable $pdo qui contient la connexion à la base de donnée
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
// test     
    if($pdo){
    }else{
        echo "Not Connected";
    }
?>