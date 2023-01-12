<?php
    require('_header.php');
    $username = $_POST['email'];
    $password = $_POST['password'];
    if (isset($_POST['email']) && isset($_POST['password'])) {
            $verify = $DB->query("select * from _client where email='$username'");
                if (count($verify) > 0 && $verify[0]->bloque == 0) {
                    foreach($verify as $donnes){
                        $pass = $donnes->mdp;
                       
                        if(password_verify($password,$pass)){
                
                            $_SESSION['nom'] = $donnes->prenom; 
                            $_SESSION['id'] = $donnes->idClient;
                            //partie pour ajouter 
                            $ids = array_keys($_SESSION['panier']); //on récupère les clés du panier
                            foreach($ids as $id){
                                $idClient = $_SESSION['id'];
                                $idProduit = $id;
                                $quantite = $_SESSION['panier'][$id];
                                $DB->query("INSERT INTO _panier (idClient, idProduit, qte) VALUES ('$idClient', '$idProduit', '$quantite')");
                    }
                            header('Location:index.php');
                            
                            
                        }
                       
                        else{
                            header('Location:connexion.php?fail=1');
                        }

                       
                        
                    }
                }
                else if ($verify[0]->bloque == 1) {
                    header('Location:connexion.php?blocked=1');      
                } else {
                    header('Location:connexion.php?fail=1');
                }
    }
    
?>