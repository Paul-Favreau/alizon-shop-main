<?php
include("db_connect.php");
$fichier="catalogue.csv";
$var=fopen("$fichier","r+" );
$cpt = 0;
// code de Paul Favreau 44 
while(!feof($var))
{
    $ligne=fgets($var);
    $partie=explode(";",$ligne);
    $nom=$partie[0];
    echo '<p>Nom:'.$nom;
    $descript=$partie[1];
    echo '<br>descript: '.$descript;
    $img=$partie[2];
    echo '<br>'.$img;
    $prix=$partie[3];
    echo '<br>Prix:  '.$prix.'€</p>';
    
    // création de la requête
    // de la forme INSERT INTO table (colonne1, colonne2, ...) VALUES (valeur1, valeur2, ...)
    // code de Noah Brohan 56
    if ($nom!="nom") { // boucle if pour ne pas ajouter l'entête
        $sql = "INSERT INTO produit (nom, descript, photo1, prixTotal) VALUES (:nom, :descript, :img, :prix)";
        // de la forme $connexion->prepare($requete)
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':descript', $descript);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':prix', $prix);
        // execution de la requête
        $stmt->execute();
        $cpt++;
    }
}
// debogage
echo "Nombre de produits insérés $cpt";
?>