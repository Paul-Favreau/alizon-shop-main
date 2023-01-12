<?php
    // CE FICHIER VA SERVIR A NOUS CONNECTER A LA BDD ET A FAIRE DES REQUETES FACILEMENT
    // IL FAUT LINCLURE DANS LE  _HEADER ET L'INIT ex: $DB = new DB();
    class DB{
   
        private $host= 'localhost';
        private $username= 'root';
        private $password= ''; //je met rien car je suis sur xammp
        private $database= 'alizon_sprint_3';
        private $db;

        public function __construct($host = null, $username = null, $password = null, $database = null){
            if($host != null){
                $this->host = $host;
                $this->username = $username;
                $this->password = $password;
                $this->database = $database;
            }
            try{
                $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            }catch(PDOException $e){
                die('Impossible de se connecter à la base de données');
            }
        }

        //fonction pour faire les requêtes plus simplement, $sql est la requete et $data les données 
        public function query($sql, $data = array()){
            $req=$this->db->prepare($sql);
            $req->execute($data);
            return $req->fetchAll(PDO::FETCH_OBJ); //POUR QUE CA RETOURNE UN OBJET
        }
        // okok c'est ma fonction ronan touche pas
        // en gros c'est pour récuperer le dernier id inséré
        // j'en ai besoin pour la commande
        // dans le fichier confirmationPanier.php
        public function lastInsertId(){
            return $this->db->lastInsertId();
        }
    }
?>