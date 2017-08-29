<?php

    Class serviceAnnonce extends service {
        
        private $image;

        /**
        * @return mixed
        */
        public function getImage()
        {
            return $this->image;
        }

        /**
        * @param mixed $params
        */
        public function setImage($image)
        {
            $this->image = $image;
        }


        public function sizeImage($arg1){
            return $this -> image[$arg1]["size"] <= 10097152;   
        }
        
        public function launchControls(){

            $image = $this -> image;
            $params = $this -> params;
            
            $extensionValide = array("jpg", "jpeg", "gif", "png");
            $extensionUpload1 = strtolower(substr(strrchr($image["photo1"]["name"], "."), 1));
            $extensionUpload2 = strtolower(substr(strrchr($image["photo2"]["name"], "."), 1));
            $extensionUpload3 = strtolower(substr(strrchr($image["photo3"]["name"], "."), 1));

            $flag1 = false;
        
            if(!empty($image["photo1"]["name"])
            OR !empty($image["photo2"]["name"])
            OR !empty($image["photo3"]["name"]))
            {
                if($this -> sizeImage("photo1")
                || $this -> sizeImage("photo2")
                || $this -> sizeImage("photo3"))
                {
                    if(in_array($extensionUpload1, $extensionValide)
                    || in_array($extensionUpload2, $extensionValide)
                    || in_array($extensionUpload3, $extensionValide))
                    {

                    }else{
                        $this -> saveError("formatFichier", "Formats image acceptés: jpg, jpeg, gif, png");
                    }

                }else{
                    $this -> saveError("tailleFichier", "Image trop volumineuse");
                }

            }else{
                $this -> saveError("emptyImage", "Image manquante, 1 minimum");
            }

            if($params["categorie"] == "none"){
                $this -> saveError("emptyCat", "Type manquant");
            }

            if(empty($params["dep"])){
                $this -> saveError("emptyDep", "Departement non renseigné");
            }

            if(empty($params["ville"])){
                $this -> saveError("emptyVille", "Ville non renseignée");
            }

            if(empty($params["surface"])){
                $this -> saveError("emptySurface", "Surface non renseignée");
            }

            if(empty($params["nb_chambre"])){
                $this -> saveError("emptyNbChambre", "Nombre de chambre non renseigné");
            }

            if(empty($params["dispo"])){
                $this -> saveError("emptyDispo", "Date de disponibilité non renseignée");
            }

            if(empty($params["prixNuit"])){
                $this -> saveError("emptyPrixNuit", "Prix Nuit non renseigné");
            }

            if(empty($params["prixSemaine"])){
                $this -> saveError("emptyPrixSemaine", "Prix Semaine non renseigné");
            }

            if(empty($params["prixMois"])){
                $this -> saveError("emptyPrixMois", "Prix Mois non renseigné");
            }

            if(empty($params["titre"])){
                $this -> saveError("emptyTitre", "Titre de l'annonce non renseigné");
            }

            if(empty($params["desc"])){
                $this -> saveError("emptyDesc", "Description de l'annonce non renseignée");
            }

            if(!empty($this -> error)){
                return $this -> error;
            }else{
                return true;
            }
        }


    }

?>