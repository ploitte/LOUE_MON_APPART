<?php

    Class annonce{

        private $id;
        private $departement;
        private $ville;
        private $categorie;
        private $surface;
        private $nb_chambre;
        private $dispo;
        private $titre;
        private $desc;
        private $prix_nuit;
        private $prix_semaine;
        private $prix_mois;
        private $photo1;
        private $photo2;
        private $photo3;
        private $reserv;

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

        public function getDep()
        {
            return $this -> departement;
        }

        public function setDep($departement)
        {
            $this -> departement = $departement;
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

        public function getPrixNuit()
        {
            return $this -> prix_nuit;
        }

        public function setPrixNuit($prix_nuit)
        {
            $this -> prix_nuit = $prix_nuit;
        }

        public function getPrixSemaine()
        {
            return $this -> prix_semaine;
        }

        public function setPrixSemaine($prix_semaine)
        {
            $this -> prix_semaine = $prix_semaine;
        }

        public function getPrixMois()
        {
            return $this -> prix_mois;
        }

        public function setPrixMois($prix_mois)
        {
            $this -> prix_mois = $prix_mois;
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

        public function getReserv()
        {
            return $this -> reserv;
        }

        public function setReserv($reserv)
        {
            $this -> reserv = $reserv;
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

        public function get(bddManager $bddManager){
            $bddManager -> getAnnonce($this);
        }
    }

?>