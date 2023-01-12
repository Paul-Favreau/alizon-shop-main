<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        require('_header.php');
        $id = $_SESSION['id'];
        $nom=  $_POST['nom'];
        $prenom=  $_POST['prenom'];
        $email=  $_POST['email'];
        $tel=  $_POST['tel'];
        $adresse = $_POST['adresse'];
        $code = $_POST['code'];
        $ville = $_POST['ville'];
        $date = date("Y-m-d",strtotime($_POST['date']));
        $sql = $DB->query("UPDATE _client SET email='$email',nom='$nom',prenom='$prenom',tel='$tel',adresse='$adresse',codePostal='$code',ville='$ville', dateNaissance='$date' WHERE idClient='$id' ");
        if($sql){
            header("location:modification?fail=1");
        }
        
        else{
    
            header("location:index.php?insert=1");
            
            
            
        }


        

    ?>
</body>
</html>
