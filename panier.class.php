<?php
    // CE FICHIER VA SERVIR A GERER LE PANIER
    // IL FAUT LINCURE DANS LE _HEADER ET L'INIT EX: $panier = new panier();
    class panier{
        private $DB; //on en a besoin pour la fonction totale sinon bug

    
        public function __construct($DB){
            if(!isset($_SESSION)){
                session_start();
            }
            if(!isset($_SESSION['panier'])){
                $_SESSION['panier'] = array();
            }
            $this->DB = $DB;
            if(isset($_GET['delPanier'])){ //pour supprimer un produit (avec poubelle) quand l'utilisateur n'est pas connecté
                $this->del($_GET['delPanier']);
                
            }
            

            if(isset($_POST['deltout'])){ //pour supprimer tout le panier (avec poubelle)
                $this->del_all();
            }
            



            if(isset($_POST['panier']['quantite'])){ //pour recalculer quand la quantité est modifiée dans le panier
                $this->recalc();
            }

           
        }

        //fonction pour ajouter un produit au panier
        public function add($product_id){
            //s'il y a deja un produit de ce type au panier on en rajoute un
            if(isset($_SESSION['panier'][$product_id])){
                $_SESSION['panier'][$product_id]++;
            }else{
                //sinon si le produit n'est pas encore dans le panier on en ajoute un
                $_SESSION['panier'][$product_id] = 1;
            }

            //header('Location: pageproduittest.php'); // on redirige vers la page d'accueil, sinon on est sur la page addpanier.php et c'est moche
        }

        
        

        //fonction pour supprimer un produit du panier
        public function del($product_id){
            unset($_SESSION['panier'][$product_id]);
        }

        public function total(){
            $total=0;
            $ids=array_keys($_SESSION['panier']);
            if(empty($ids)){
                $products=array();
            }
            else{
                $products=$this->DB->query('SELECT idProduit, prixTotal FROM _produit WHERE idProduit IN ('.implode(',',$ids).')');
            }
            foreach($products as $produit){
                $total += $produit->prixTotal *  $_SESSION['panier'][$produit->idProduit]; /* $_SESSION['panier'][$produit->idProduit]*/;
            }
            return $total;
        }

        //fonction pour compter le nombre d'élément dans le panier
        public function count(){
            return array_sum($_SESSION['panier']);
        }


        //fonction qui recalcule le nombre de produit quand la quantité est modifiée depuis le panier
        public function recalc(){
            
            foreach($_SESSION['panier'] as $product_id => $quantite){
                if(isset($_POST['panier']['quantite'][$product_id])){
                    $_SESSION['panier'][$product_id] = $_POST['panier']['quantite'][$product_id];

                    //si il met 0 on le supprime du panier
                    if($_POST['panier']['quantite'][$product_id]==0){
                        $this->del($product_id);
                        
                    }
                }
            } 
            
        }

        //fonction pour supprimer tout les elements du panier d'un coup
        public function del_all(){
            $ids=array_keys($_SESSION['panier']);//on prend les id des produits dans le panier
            foreach($ids as $id){
                //on les enleve un par un
                unset($_SESSION['panier'][$id]);
            }
            
        }

        
    }
    


    
?>
