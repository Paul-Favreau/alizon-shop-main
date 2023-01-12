<?php
include("_header.php");
$req = $DB->query('SELECT * FROM _client');
$cpt = 0;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Alizon | Gestion des commentaires</title>
    <link rel="icon" type="image/png" sizes="16x16" href="icon.png">    <!-- Icone de la page -->
    <link rel="stylesheet" href="style.css">    <!-- Feuille de style -->
    <!-- Intégration des fichiers Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
</head>
<body>
<?php
if (isset($_GET['blocksuccess'])){
    echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert" style="margin-bottom:0">Compte bloqué.</div>'.PHP_EOL;
}
if (isset($_GET['unblocksuccess'])){
    echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert" style="margin-bottom:0">Compte débloqué.</div>'.PHP_EOL;
}
?>
<div class="container-fluid">   <!-- définition d'un conteneur fluid -->
    <div class="row" >          <!-- ligne définie avec 2 colonnes -->
        <nav class="col-3 vingt">     <!-- colonne de navigation -->
            <div class="d-flex justify-content-around">
                <!-- <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href='index.php'">Accueil</button> -->
                <a href="index.php" id="dashboard-title">DashBoard</a>
            </div>
            <a href="user.php">Gestion des comptes</a>

            <a href="comment.php">Gestion des commentaires</a>
        </nav>

        <main class="col-9">
            <header>
                <h1>Gestion des utilisateurs</h1>
            </header>
            <div class="d-flex justify-content-around">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Editer</th>
                        <th scope="col">Bloquer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <style>
                        .stop-stp{
                            padding: 0px;
                            margin: 0px;
                        }
                        .reduit-toi{
                            width: 100px;
                        }
                    </style>
                    <!-- Button trigger modal -->

                    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
                    <!-- Modal Modification infos -->
                    <div class="modal fade" id="modalmodifier" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalmodifierLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalmodifierLabel">Modification d'un compte client</h1>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="traitement_user.php" method="post">
                                        <input type="hidden" name="id_client" id="id_client">
                                        <label for="nom">Nom : </label>
                                        <input type="text" name="nom" id="nom" value="" >
                                        <br>
                                        <br>
                                        <label for="prenom">Prénom : </label>
                                        <input type="text" name="prenom" id="prenom" value="" placeholder="Nouveau prénom">
                                        <br>
                                        <br>
                                        <label for="email">E-mail : </label>
                                        <input type="text" name="email" id="email" value="" placeholder="Nouvel e-mail">
                                        <br>
                                        <br>
                                        <label for="tel">Telephone : </label>
                                        <input type="text" name="tel" id="tel" value="" placeholder="Nouveau numero">
                                        <br>
                                        <br>
                                        <label for="adresse">Adresse : </label>
                                        <input type="text" name="adresse" id="adresse" value="" placeholder="Nouvelle adresse">
                                        <br>
                                        <br>
                                        <label for="codePostal">Code Postal: </label>
                                        <input type="text" name="codePostal" id="codePostal" value="" placeholder="Nouveau Code Postal">
                                        <br>
                                        <br>
                                        <label for="ville">Ville: </label>
                                        <input type="text" name="ville" id="ville" value="" placeholder="Nouvelle ville">
                                        <br>
                                        <br>
                                        <label for="dateNaissance">Date de Naissance: </label>
                                        <input type="date" name="dateNaissance" id="dateNaissance" value="" placeholder="Nouvelle date de Naissance">
                                        <br>
                                        <br>
                                        <input type="submit">
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Bloquer -->
                    <div class="modal fade" id="modalbloquer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalbloquerLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalbloquerLabel">Attention</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Voulez vous bloquer ce compte? Cet utilisateur ne pourra plus se connecter jusqu'a débloquage!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                    <form action="traitement_bloquer.php" method="get">
                                        <input type="hidden" name="id_client" id="bloquer">
                                        <button type="submit" class="btn btn-danger">Oui, bloquer le compte</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Déloquer -->
                    <div class="modal fade" id="modaldebloquer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modaldebloquerLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modaldebloquerLabel">Attention</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Voulez vous débloquer ce compte?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                    <form action="traitement_bloquer.php" method="get">
                                        <input type="hidden" name="id_client" id="debloquer">
                                        <button type="submit" class="btn btn-danger">Oui, débloquer le compte</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    // #TODO ATTENTION ON PEUT FAIRE DES INJECTIONS JAVA SCRIPTS EN MODIFIANT L'ID
                    // DANS LE HTML EN INSPECTANT LA PAGE
                    
                    foreach($req as $val){
                        echo "<tr>";
                        echo "<td>".$req[$cpt]->idClient."</td>";
                        echo "<td id=\"nom_" .$req[$cpt]->idClient ."\">".$req[$cpt]->nom."</td>";
                        echo "<td id=\"prenom_" .$req[$cpt]->idClient ."\">".$req[$cpt]->prenom."</td>";
                        echo "<td id=\"email_" .$req[$cpt]->idClient ."\">".$req[$cpt]->email."</td>";
                        echo "<td hidden id=\"tel_" .$req[$cpt]->idClient ."\">".$req[$cpt]->tel."</td>";
                        echo "<td hidden id=\"adresse_" .$req[$cpt]->idClient ."\">".$req[$cpt]->adresse."</td>";
                        echo "<td hidden id=\"codePostal_" .$req[$cpt]->idClient ."\">".$req[$cpt]->codePostal."</td>";
                        echo "<td hidden id=\"ville_" .$req[$cpt]->idClient ."\">".$req[$cpt]->ville."</td>";
                        //echo "<td hidden id=\"dateNaissance_" .$req[$cpt]->idClient ."\">".$req[$cpt]->dateNaissance."</td>";
                        // on met l'id du client en variable de session comme ça
                        // dans la page traitement_user.php on pourra effectuer
                        // la requete de modification sur cet ID

                        echo "<td><button type='button' id=\"user_" .$req[$cpt]->idClient ."\" class='btn btn-primary reduit-toi' data-bs-toggle='modal' data-bs-target='#modalmodifier's>Modifier</button></td>";
                        if($req[$cpt]->bloque == 0){
                            echo "<td><button type='button' id=\"user_" .$req[$cpt]->idClient ."\" class='btn btn-danger reduit-toi' data-bs-toggle='modal' data-bs-target='#modalbloquer'>Bloquer</button></td>";
                        }else{
                            echo "<td>Compte bloqué <button type='button' id=\"user_" .$req[$cpt]->idClient ."\" class='btn btn-danger reduit-toi' data-bs-toggle='modal' data-bs-target='#modaldebloquer'>Débloquer</button></td>";
                        }
                        $cpt++;
                        echo "</tr>";
                    }
                    ?>

                    </tbody>
                </table>
        </main>
    </div>
</div>
<script>
    function show_modal(id){
        console.log(id);
        //console.log(document.getElementById("modalmodifier"))
        //document.getElementById("modalmodifier").focus();
        document.getElementById("id_client").value = id;
        document.getElementById("bloquer").value = id;
        document.getElementById("debloquer").value = id;
        document.getElementById("nom").value = document.getElementById("nom_"+id).textContent;
        document.getElementById("prenom").value = document.getElementById("prenom_"+id).textContent;
        document.getElementById("email").value = document.getElementById("email_"+id).textContent;
        document.getElementById("tel").value = document.getElementById("tel_"+id).textContent;
        document.getElementById("adresse").value = document.getElementById("adresse_"+id).textContent;
        document.getElementById("codePostal").value = document.getElementById("codePostal_"+id).textContent;
        document.getElementById("ville").value = document.getElementById("ville_"+id).textContent;
        //document.getElementById("dateNaissance").value = document.getElementById("dateNaissance_"+id).textContent;
        
    }
    for (elem of document.querySelectorAll('.reduit-toi')) {
        console.log(elem)
        let id = elem.id
        elem.addEventListener('click', () => {show_modal(id.substring(5))}, false);
    }
    
    // boucle pour alterner le fond des lignes du tableau
    for (let i = 1; i < document.getElementsByTagName("tr").length; i++) {
        if(i%2 == 0) {
            document.getElementsByTagName("tr")[i].style.backgroundColor = "#C7C8CA";
        }
        else{
            document.getElementsByTagName("tr")[i].style.backgroundColor = "#white";
        }
    }
</script>
</body>
</html>
