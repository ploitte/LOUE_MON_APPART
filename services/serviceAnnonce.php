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
            $this -> image[$arg1]["size"] >= 2097152;   
        }
        
        public function launchControls(){


            $image = $this -> image;
            $params = $this -> params;
            
            $extensionValide = array("jpg", "jpeg", "gif", "png");
            $extensionUpload1 = strtolower(substr(strrchr($image["photo1"]["name"], "."), 1));
            $extensionUpload2 = strtolower(substr(strrchr($image["photo2"]["name"], "."), 1));
            $extensionUpload3 = strtolower(substr(strrchr($image["photo3"]["name"], "."), 1));

            // if($this -> sizeImage("photo1") {
            //    $this -> saveError("tailleFichier1", "Photo1: Fichier trop volumineux");
            // }

            // if($this -> sizeImage("photo2") {
            //    $this -> saveError("tailleFichier2", "Photo2: Fichier trop volumineux");
            // }

            // if($this -> sizeImage("photo3") {
            //    $this -> saveError("tailleFichier3", "Photo3: Fichier trop volumineux");
            // }

            // if(!in_array($extensionUpload1, $extensionValide)){
            //     $this -> saveError("formatFichier1", "Pohot 1: Format de fichier non accepté");
            // }

            // if(!in_array($extensionUpload2, $extensionValide)){
            //     $this -> saveError("formatFichier2", "Photo2: Format de fichier non accepté");
            // }

            // if(!in_array($extensionUpload3, $extensionValide)){
            //     $this -> saveError("formatFichier3", "Photo3: Format de fichier non accepté");
            // }

            // if($image["photo1"]["error"]){
            //     $this -> saveError("transfertFichier1","Photo1: Erreur lors du transfert");
            // }

            // if($image["photo2"]["error"]){
            //     $this -> saveError("transfertFichier2","Photo2: Erreur lors du transfert");
            // }

            // if($image["photo3"]["error"]){
            //     $this -> saveError("transfertFichier3","Photo3: Erreur lors du transfert");
            // }

            if(!empty($this -> error)){
                return $this -> error;
            }else{
                return true;
            }
        }


    }

?>