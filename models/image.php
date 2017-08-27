<?php

 Class image{

    private $id;
    private $nom;
    private $url;

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

    public function getNom()
    {
        return $this -> nom;
    }

    public function setNom($nom)
    {   
        $this -> nom = $nom;
    }

    public function getUrl()
    {
        return $this -> url;
    }

    public function setUrl($url)
    {
        $this -> url = $url;
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
    
        

 }

?>