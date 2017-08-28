<?php

    Class annonce{

        private $id;
        private $pays;
        private $ville;
        private $categorie;
        private $surface;
        private $nb_chambre;
        private $dispo;
        private $titre;
        private $desc;
        private $prix;
        private $photo1;
        private $photo2;
        private $photo3;

        public function __construct($donnees = array()){
            $this -> hydrate($donnees);
        }

        public function getId()
        {
            return $this -> id;
        }

        public function setId($id)
        {
            $this -> id = $id;
        }

        public function getPays()
        {
            return $this -> pays;
        }

        public function setPays($pays)
        {
            $this -> pays = $pays;
        }

        public function getVille()
        {
            return $this -> ville;
        }

        public function setVille($ville)
        {
            $this -> ville = $ville;
        }

        public function getCategorie()
        {
            return $this -> categorie;
        }

        public function setCategorie($categorie)
        {   
            $this -> categorie = $categorie;
        }

        public function getSurface()
        {
            return $this -> surface;
        }

        public function setSurface($surface)
        {
            $this -> surface = $surface;
        }

        public function getNb_chambre()
        {
            return $this -> nb_chambre;
        }

        public function setNb_chambre($nb_chambre)
        {
            $this -> nb_chambre = $nb_chambre;
        }

        public function getDispo()
        {
            return $this -> dispo;
        }

        public function setDispo($dispo)
        {
            $this -> dispo = $dispo;
        }

        public function getPrix()
        {
            return $this -> prix;
        }

        public function setPrix($prix)
        {
            $this -> prix = $prix;
        }

        public function getTitre()
        {
            return $this -> titre;
        }

        public function setTitre($titre)
        {
            $this -> titre = $titre;
        }

        public function getDesc()
        {
            return $this -> desc;
        }

        public function setDesc($desc)
        {
            $this -> desc = $desc;
        }

        public function getPhoto1()
        {
            return $this -> photo1;
        }

        public function setPhoto1($photo1)
        {
            $this -> photo1 = $photo1;
        }
    
        public function getPhoto2()
        {
            return $this -> photo2;
        }

        public function setPhoto2($photo2)
        {
            $this -> photo2 = $photo2;
        }

        public function getPhoto3()
        {
            return $this -> photo3;
        }

        public function setPhoto3($photo3)
        {
            $this -> photo3 = $photo3;
        }



        public function hydrate($donnees)
        {
            foreach($donnees as $key => $value)
            {
                //ici je rajoute un remplacement des undescore
                $key = preg_replace("#_#","",$key);

                //donc pour l'index id on met le en majuscule et le
                // prefix avec "set"
                $method = "set".ucfirst($key);
                if(method_exists($this,$method)){
                    $this->$method($value);
                }
            }
        }

        public function insert(bddmanager $bddManager){
            $bddManager -> insertAnnonce($this);
        }

        public function insertImg(bddmanager $bddManager){
            $bddManager -> insertImage($this);
        }

    }

?>