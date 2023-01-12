<?php
    require '_header.php';
    //var_dump($_GET);
    if(!isset($_SESSION['id'])){ // SI LE MEC N'est PAS CONNECTE
        if(isset($_GET['idprod'])){
            $json=array('error'=>true);
            //on verifie que le produit existe
            $product=$DB->query('SELECT idProduit FROM _produit WHERE idProduit=:drapeau', array('drapeau'=>$_GET['idprod']));
            if(empty($product)){ // si le tableau est vide
                $json['message']="Ce produit n'existe pas";
            }
            $panier->add($product[0]->idProduit);
            
            $json['error']=false; //si on arrive la c'est que tout est ok
            //$json['count']=$panier->count();
            $json['message']= "ok produit ajouté au panier";
        }
        else{
            $json['message']="Vous n'avez pas selectionné de produit";  
        }
        echo json_encode($json);
    }

    else{//s'il est connecté
        $json=array('error'=>true);
        //on verifie que le produit existe
        $product=$DB->query('SELECT idProduit FROM _produit WHERE idProduit=:drapeau', array('drapeau'=>$_GET['idprod']));
        if(empty($product)){ // si le tableau est vide
            $json['message']="Ce produit n'existe pas";
        }
        $json['error']=false; //si on arrive la c'est que tout est ok

        //verifier si l'utilisateur a deja ce produit dans son panier
        $verif=$DB->query('SELECT idProduit FROM _panier WHERE idProduit=:drapeau AND idClient=:drapeau2', array('drapeau'=>$_GET['idprod'], 'drapeau2'=>$_SESSION['id']));
        
        if(!empty($verif)){ //s'il est déja dans son panier on ajoute un a la quantite
            //echo'cest pas vide';
            $DB->query('UPDATE _panier SET qte=qte+1 WHERE idProduit=:drapeau AND idClient=:drapeau2', array('drapeau'=>$_GET['idprod'], 'drapeau2'=>$_SESSION['id']));
        }
        else{//sinon on ajoute un tuple dans la table panier avec l'id du client et l'id du produit qu'il a ajouté
            
            $DB->query('INSERT INTO _panier SET idProduit=:drapeau, idClient=:drapeau2, qte=1', array('drapeau'=>$_GET['idprod'], 'drapeau2'=>$_SESSION['id']));
        }
        //$DB->query('INSERT INTO panier SET idProduit=:idprod, idClient=:idclient, qte=1', array('idprod'=>$product[0]->idProduit, 'idclient'=>$_SESSION['id']));
        $json['message']=" ok produit ajouté au panier";//ok ca marche ca ajoute en bdd

       

        

        
        
    }

   // header('Location: panier.php');
    
    

?>
