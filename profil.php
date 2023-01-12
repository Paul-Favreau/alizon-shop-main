<?php

require('header.php');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alizon - Profil</title>
    <link rel="icon" href="img/icon/logo.svg"/>
    <link href="index.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-grid.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-reboot.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if(isset($_GET['fail'])){
        echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Erreur </div>'.PHP_EOL;
    }
    ?>
    <?php if (isset($_SESSION['id'])): ?>

        <?php $id = $_SESSION['id'];
        $sql = $DB->query("SELECT * from _client where idClient='$id'");
        
        ?>
        <?php foreach($sql as $d): ?>
        
       
            <div class="row justify-content-center mb-5 mt-3 div-centree">
                    <div class="card"  id="formulaire">
                        <?php if (isset($_SESSION['nom'])): ?>
			
                            <br><h4 class="text-center"> <strong><?php echo 'Profil </h4>'; ?></strong>
        
        
                        <?php endif; ?>
                        <div class="card-body">
					<form action="update.php" method="post">
						<div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <br><h6 class="mb-3 text-primary ">Informations personnels</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group mb-4">
                                        <label >Nom</label>
                                        <input type="text" class="form-control" name="nom"   value="<?php echo $d->nom; ?>">
                                    </div>
                                    
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group mb-4">
                                        <label >Prénom</label>
                                        <input type="text" class="form-control" name="prenom"  value="<?php echo $d->prenom; ?>">
                                    </div>
                                    
                                </div>
                                
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Téléphone</label>
                                        <input type="tel" class="form-control" name="tel" value="<?php echo $d->tel; ?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Date de Naissance</label>
                                        <input type="date" class="form-control" name="date"  value="<?php echo $d->dateNaissance; ?>">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <br><h6 class="mb-3 text-primary">Informations de livraison</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Adresse</label>
                                        <input type="text" class="form-control" name="adresse"  value="<?php echo $d->adresse; ?>">
                                    </div>
                                </div>
                               
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group mb-4">
                                        <label for="ville">Ville</label>
                                        <input type="name" class="form-control" name="ville"  value="<?php echo $d->ville; ?>">
                                    </div>
                                </div>
                                
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group mb-4">
                                        <label for="code">Code Postal</label>
                                        <input type="text" class="form-control" name="code"  value="<?php echo $d->codePostal; ?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group mb-4" style="margin-top:24px">
                                        <button type="button" id="livraisons" name="submit" class="btn btn-primary"  onclick="window.location.href = './listeCommandes.php';">Voir les commandes effectués</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <br><h6 class="mb-3 text-primary">Informations de connexion</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group mb-4">
                                        <label for="password">Adresse mail </label>
                                        <input type="email" class="form-control" name="email"  value="<?php echo $d->email; ?>">
                                    </div>
                                    <div class="mb-4">
                                        <button type="button" id="changer" name="submit" class="btn btn-primary"  onclick="window.location.href = './changermdp.php';">Changer de mot de passe</button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pl-5">
                                    <div class="text-right">
                                    
                                        
                                        
                                        <form action="update.php" method="post">
                                            <input type="hidden" name="deltout" >
                                            
                                            <button type="button" class="btn bg-primary float-center text-light button" data-bs-toggle="modal" data-bs-target="#exampleModal" id="miseAJour">Mettre à jour</button>

                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Attention !</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            
                                                            Voulez-vous vraiment mettre à jour vos Informations ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary btn-lg" data-bs-dismiss="modal">Non</button>
                                                            <button type="submit" class="btn btn-danger btn-lg " aria-label="Close">Oui</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <button type="button" id="retour" name="submit" class="btn btn-secondary"  onclick="window.location.href = './index.php';" >Retour</button>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </form>	
                    </div>
					
                
            </div>
        </div>
        <?php endforeach; ?>

    <?php else: ?>
    <?php echo '<script>window.location.href="connexion.php?notlogged=1"; </script>'; ?>
        
        
    <?php endif ?>
    <?php include 'footer.php'; ?>
    
</body>
</html>
