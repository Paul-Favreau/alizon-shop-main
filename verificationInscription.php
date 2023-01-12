

<?php
require('_header.php');

if ($_POST['Password'] != $_POST['ConfirmPassword']) { // si les deux mdp ne correspondent pas
    header("location:inscription.php?fail=1");
} else {

$mdp = password_hash($_POST['Password'],PASSWORD_DEFAULT); // hash par défaut, mis a jour en fonction des versions de php
$date=  date("Y-m-d");
$nom=  $_POST['Nom'];
$prenom=  $_POST['Prenom'];
$email=  $_POST['Mail'];
$tel=  $_POST['Tel'];
$adresse = $_POST['Adresse'];
$code = $_POST['Code'];
$ville = $_POST['Ville'];
$dateN = date("Y-m-d",strtotime($_POST['Date']));
// Check connection

 
// Attempt insert query execution
$sql = $DB->query("SELECT * FROM _client where email = '$email'");
if($sql){
    header("location:inscription.php?fail=1");
}

else{
    $stmt = $DB->query("INSERT INTO _client(mdp,dateInscription,nom,prenom,email,tel,adresse,codePostal,ville,dateNaissance) VALUES('$mdp','$date','$nom','$prenom','$email','$tel','$adresse','$code','$ville','$dateN')");
    header("location:index.php?success=1");
    
    
    
}
}