<?php

    Class annonce{

        private $id;
        private $types;
        private $surface;
        private $nb_chambre;
        private $dispo;
        private $titre;
        private $desc;
        private $prix;

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

    public function getTypes()
    {
        return $this -> types;
    }

    public function setTypes($types)
    {   
        $this -> types = $types;
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



    }

?>