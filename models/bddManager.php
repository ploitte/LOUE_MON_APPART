<?php

    class bddManager{

    
        private $connexion;
        
        
        public function getConnexion(){
            if(empty($this -> connexion)){ 
                $this -> connexion = new PDO("mysql:host=localhost;dbname=louemonappart;charset=UTF8", "root", "");
                $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
        }
    //  USER_____________________________________________________________________________________________________________________

        public function checkUsernameBdd(user $user){ 
            $this -> getConnexion();
            $pdo = $this -> connexion -> prepare("SELECT id, username FROM user WHERE username = ?");
            $pdo -> execute(array(
                $user -> getUsername()
            ));
            $count = $pdo -> rowCount();
            return $count;
        }

        public function checkEmailBdd(user $user){
            $this -> getConnexion();
            $pdo = $this -> connexion -> prepare("SELECT id, email FROM user WHERE email=:email");
            $pdo -> execute(array(
                "email" => $user -> getEmail()
            ));

            return $pdo -> rowCount();
        }

        public function checkUsernamePasswordBdd(user $user){
            $this -> getConnexion();
            $pass = $user -> getPassword();
            $crypted = sha1($pass);

            $pdo = $this -> connexion -> prepare("SELECT id, username FROM user WHERE username = ? AND password = ? ");
            $pdo -> execute(array($user -> getUsername(), $crypted));
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
            $pdo = $this -> connexion -> prepare("INSERT INTO annonce SET categorie=:categorie, surface=:surface, nb_chambre=:nb_chambre,
             dispo=:dispo, titre=:titre, description=:description, prix=:prix");
            $pdo -> execute(array(
                // "type" => $annonce -> getTypes(),
                "categorie" => $annonce -> getCategorie(),
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
            $this -> getConnexion();
            $dossier = "/images";
            $fichier1 = $annonce -> getPhoto1();
            $fichier2 = $annonce -> getPhoto2();
            $fichier3 = $annonce -> getPhoto3();

            $fichier1 = strtr($fichier1, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier1 = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier1);

            $fichier2 = strtr($fichier2, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier2 = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier2);

            $fichier3 = strtr($fichier3, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier3 = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier3);
            
            $pdo = $this -> connexion -> prepare("INSERT INTO annonce SET image1=:image1, image2=:image2, image3=:image3");
            $pdo -> execute(array(
                "image1" => $fichier1,
                "image2" => $fichier2,
                "image3" => $fichier3
            ));
            $pdo -> closeCursor();
        }

    }

?>