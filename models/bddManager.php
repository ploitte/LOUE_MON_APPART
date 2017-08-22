<?php

    class bddManager{

        private $connexion;

        public function getConnexion(){
            if(empty($this -> connexion)){ 
                $this -> connexion = new PDO("mysql:host=localhost;dbname=loueMonAppart;charset=UTF8", "root", "root");
                $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
        }

    //  USER_____________________________________________________________________________________________________________________

        public function checkUsernameBdd(user $user){ 
            $this -> getConnexion();
            $pdo = $this -> connexion -> prepare("SELECT id, username FROM user WHERE username = ?");
            $pdo -> execute(array($user -> getUsername()));
            $count = $pdo -> rowCount();
            return $count;
        }

        public function checkEmailBdd(user $user){
            $this -> getConnexion();
            $pdo = $this -> connexion -> prepare("SELECT id, email FROM user WHERE email");
            $pdo -> execute(array($user -> getEmail()));
            return $pdo -> fetchAll(PDO::FETCH_ASSOC);
            $this -> getConnexion() -> lastInsertId();
        }

        public function checkUsernamePasswordBdd(user $user){
            $this -> getConnexion();
            $pdo = $this -> connexion -> prepare("SELECT id, username FROM user WHERE username = ? AND password = ? ");
            $pdo -> execute(array($user -> getUsername(), $user ->getPassword()));
            return $pdo -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function insertUser(user $user){
            $this -> getConnexion();
            $pdo = $this -> connexion -> prepare("INSERT INTO user SET username=:username, email=:email, password=:password");
            $pdo -> execute(array(
                "username" => $user -> getUsername(),
                "email"    => $user -> getEmail(),
                "password" => $user -> getPassword()
            ));
            return $pdo -> rowCount();
        }
        
        public function deleteUser(user $user){
            $this -> getConnexion();
            $pdo = $this -> connexion -> prepare("DELETE FROM user WHERE id=:id");
            $pdo -> execute(array(
                "id" => $user -> getId()
            ));
            return $pdo->rowCount();
        }

        public function searchByUsername(user $user){
            $this -> getConnexion();
            $pdo = $this -> connexion -> prepare("SELECT * FROM user WHERE username = ?");
            $pdo -> execute(array($user -> getUsername()));
            $result = $pdo -> fetch(PDO::FETCH_ASSOC);
            return new user($result);
                
        }
    
  //  ANNONCE_____________________________________________________________________________________________________________________
    
        // public function getImageByAnnonceId(Annonce $annonce){
        //     $req = "SELECT * FROM annonceImage WHERE id_annonce=:id_annonce";
        //     // sélectionner les id_images de la table annonce_image
        //     // 
        //     return this->getImage($result);
        // }
        // function getImage($image) {
        //     $req = "SELECT * FROM image WHERE id=:id";
        //     return $result
        // }

        public function insertAnnonce(annonce $annonce){
            $this -> getconnexion();
            $pdo = $this -> connexion -> prepare("INSERT INTO annonce SET surface=:surface, nb_chambre=:nb_chambre,
             dispo=:dispo, titre=:titre, description=:description");
            $pdo -> execute(array(
                // "type" => $annonce -> getTypes(),
                "surface" => $annonce -> getSurface(),
                "nb_chambre" => $annonce -> getNb_chambre(),
                "dispo" => $annonce -> getDispo(),
                "titre" => $annonce -> getTitre(),
                "description" => $annonce -> getDesc()
            ));
            return $pdo -> rowCount();
        }

    }

?>