<?php

    class bddManager{

    
        private $connexion;

        function __construct(){
            $this->getConnexion();
        }
        
        
        public function getConnexion(){
            if(empty($this -> connexion)){ 
                $this -> connexion = new PDO("mysql:host=localhost;dbname=louemonappart;charset=UTF8", "root", "root");
                $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
        }
    //  USER_____________________________________________________________________________________________________________________

        public function checkUsernameBdd(user $user){ 
            $pdo = $this -> connexion -> prepare("SELECT id, username FROM user WHERE username = ?");
            $pdo -> execute(array(
                $user -> getUsername()
            ));
            $count = $pdo -> rowCount();
            return $count;
        }

        public function checkEmailBdd(user $user){
            $pdo = $this -> connexion -> prepare("SELECT id, email FROM user WHERE email=:email");
            $pdo -> execute(array(
                "email" => $user -> getEmail()
            ));

            return $pdo -> rowCount();
        }

        public function checkUsernamePasswordBdd(user $user){

            $pass = $user -> getPassword();
            $crypted = sha1($pass);

            $pdo = $this -> connexion -> prepare("SELECT id, username FROM user WHERE username = ? AND password = ? ");
            $pdo -> execute(array($user -> getUsername(), $crypted));
            return $pdo -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function insertUser(user $user){

            $pdo = $this -> connexion -> prepare("INSERT INTO user SET username=:username, email=:email, password=:password");
            $pdo -> execute(array(
                "username" => $user -> getUsername(),
                "email"    => $user -> getEmail(),
                "password" => $user -> getPassword()
            ));
            return $pdo -> rowCount();
        }
        
        public function deleteUser(user $user){
       
            $pdo = $this -> connexion -> prepare("DELETE FROM user WHERE id=:id");
            $pdo -> execute(array(
                "id" => $user -> getId()
            ));
            return $pdo->rowCount();
        }

        public function searchByUsername(user $user){

            $pdo = $this -> connexion -> prepare("SELECT * FROM user WHERE username = ?");
            $pdo -> execute(array($user -> getUsername()));
            $result = $pdo -> fetch(PDO::FETCH_ASSOC);
            return new user($result);
                
        }
    
  //  ANNONCE_____________________________________________________________________________________________________________________
    
        public function insertAnnonce(annonce $annonce){

            $pdo = $this -> connexion -> prepare("INSERT INTO annonce SET categorie=:categorie, pays=:pays, ville=:ville,
            surface=:surface, nb_chambre=:nb_chambre, dispo=:dispo, titre=:titre, description=:description, prix=:prix");
            $pdo -> execute(array(
                // "type" => $annonce -> getTypes(),
                "categorie" => $annonce -> getCategorie(),
                "pays" => $annonce -> getPays(),
                "ville" => $annonce -> getVille(),
                "surface" => $annonce -> getSurface(),
                "nb_chambre" => $annonce -> getNb_chambre(),
                "dispo" => $annonce -> getDispo(),
                "titre" => $annonce -> getTitre(),
                "description" => $annonce -> getDesc(),
                "prix" => $annonce -> getPrix()
            ));
            return $pdo -> rowCount();
        }

         public function insertImage(annonce $annonce){
  
            $dossier = "images/";
            $fichier1 = $annonce -> getPhoto1();
            $fichier2 = $annonce -> getPhoto2();
            $fichier3 = $annonce -> getPhoto3();

            $fichier1_str = strtr($fichier1["name"], 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier1_str = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier1_str);

            $fichier2_str = strtr($fichier2["name"], 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier2_str = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier2_str);

            $fichier3_str = strtr($fichier3["name"], 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier3_str = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier3_str);

            move_uploaded_file($fichier1["tmp_name"], $dossier.$fichier1_str);
            move_uploaded_file($fichier2["tmp_name"], $dossier.$fichier2_str);
            move_uploaded_file($fichier3["tmp_name"], $dossier.$fichier3_str);
            
            $pdo = $this -> connexion -> prepare("INSERT INTO annonce SET image1=:image1, image2=:image2, image3=:image3");
            $pdo -> execute(array(
                "image1" => $fichier1_str,
                "image2" => $fichier2_str,
                "image3" => $fichier3_str
            ));
            $pdo -> closeCursor();
        }

        public function getDepartement(){
            $pdo = $this -> connexion -> prepare("SELECT ville_departement FROM villes_france_free GROUP BY ville_departement");
            $pdo -> execute(array());
            return $pdo -> fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function getCity($arg1){
            $pdo = $this -> connexion -> prepare("SELECT ville_nom, ville_id FROM villes_france_free WHERE ville_departement=:ville_departement ORDER BY ville_nom");
            $pdo -> execute(array(
                "ville_departement" => $arg1 
            ));
            return $pdo -> fetchAll(PDO::FETCH_ASSOC);

        }
    }

?>