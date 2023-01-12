<!DOCTYPE html>
<html lang="fr">
<?php 
include "_header.php";
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alizon - Validation paiement</title>
    <link rel="stylesheet" href="paiement.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-grid.css" rel="stylesheet">
	  <link href="bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
	  <link href="bootstrap/css/bootstrap-reboot.css" rel="stylesheet">
	  <link href="bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
	  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stopHover.css">
    
</head>
<body>
<html>
	<head></head>
	<body>
		<div class="conteneur">
                       <!-- Script Paypal de connexion à l'API -->
                       <script src="https://www.paypal.com/sdk/js?client-id=Abk44pIS5GDfShC3Vq-DS_rve9k6qN1ILYDcb5RWwaksGYtJwJ5yzcAm2JTFjZ7zmNwD7S0YM4yK3CWt&currency=EUR"></script>
    
    
				</div>
			</div>
      <div class="conteneur-bouton-paiement">
      <div class="col-md-4 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h5 class="mb-0">Récapitulatif</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php

                        //selectionne les produits que le client a dans son panier
                        $prixTotal = 0;// prix total du panier, on l'init
                        $idtab = $DB->query('SELECT idProduit FROM _panier WHERE idClient = ?', array($_SESSION['id']));
                        $ids=array();
                        foreach ($idtab as $id) {
                            $ids[] = $id->idProduit;
                        }
                        if(empty($ids)){
                            $products=array();
                        }
                        else{
                            $products = $DB->query('SELECT * FROM _produit WHERE idProduit IN ('.implode(',',$ids).')');
                            $getPanier = $DB->query('SELECT * FROM _panier WHERE idClient = ?', array($_SESSION['id']));
                        }
                        foreach ($products as $i) { // $value est mentionné uniquement pour utiliser la clé $i.
                            //var_dump($i);
                            $idCOOL=$i->idProduit; //pour recuperer l'id du produit
                         
                            $quantiteTAB=$DB->query('SELECT qte FROM _panier WHERE idProduit = ? AND idClient = ?', array($idCOOL, $_SESSION['id']));

                           $quantite=$quantiteTAB[0]->qte; //pour recup la quantite, avant c'est sous forme de tableau bizarre
                           $prix=$i->prixTotal; //on recup le prix du produit
                           $prixTotalArticle=$prix*$quantite; //pour chaque article on regarde le total
                           $prixTotal=$prixTotalArticle+$prixTotal; //prix total panier update
                            echo "<li class='list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0'>" . "<span>".$i->nom."</span>"."<span>".$quantite."</span>". $prixTotalArticle . "€</li>" . PHP_EOL;                               
                        }
                        /*
                        foreach ($products as $i) { // $value est mentionné uniquement pour utiliser la clé $i.
                            foreach ($getPanier as $ii){
                                echo "<li class='list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0'>" . $i->nom ."<span>"."</span>". $ii->qte. "<span>". $i->prixTotal . "€</span></li>" . PHP_EOL;
                            }                            
                        }*/
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Frais de livraison
                            <span>-.--€</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                            <div>
                                <strong>Total</strong>
                            </div>
                            <span><strong><?=$prixTotal?>€</strong></span>
                        </li>
                    </ul>
                    <!-- <button type="submit" class="btn btn-primary btn-lg btn-block">Valider</button> -->
                    
                    <a href="panier.php">
                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="header('Location: connect.php')">Retour au panier</button>
                    </a>
                </div>
            </div>
			</div> 
				<div class="text-paiement">
					<p>Vous allez procéder au paiement de <strong><?=$prixTotal?>€</strong></p>
					<p>Choisissez votre moyen de paiement :</p>
            <!-- Définiton des boutons de paiement PayPal -->
    <div id="paypal-button-container"></div>
				</div>
				<div class="bouton-paiement">
          <!-- SDK de PayPal -->
    <script>
      paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: <?=$prixTotal?> // on récupère le prix total
              }
            }]
          });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            //  alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            //When ready to go live, remove the alert and show a success message within this page. For example:
            
            // si le paiement est fait on redirige le client sur la page confirmationPaiement.php
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            
            // on redirige le client sur la page confirmationPaiement.php
            window.location = "confirmationPaiement.php";
            // Or go to another URL:  actions.redirect('thank_you.html');
          });
        }
      }).render('#paypal-button-container');
    </script>
	</body>
  <?php
  $_SESSION['price'] = $prixTotal; // pour pouvoir acceder à la page confirmation paiement
  ?>
</html>
</body>
</html>