<?php

class user{

        private $id;
        private $username;
        private $email;
        private $password;

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

    public function getUsername()
    {
        return $this -> username;
    }

    public function setUsername($username)
    {   
        $this -> username = $username;
    }

    public function getEmail()
    {
        return $this -> email;
    }

    public function setEmail($email)
    {
        $this -> email = $email;
    }

    public function getPassword()
    {
        return $this -> password;
    }

    public function setPassword($password)
    {
        $this -> password = $password;
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

    public function insert(bddManager $bddManager){
        $bddManager -> insertUser($this);
    }

    public function delete(bddManager $bddManager){
        $bddManager -> deleteUser($this);
    }

    public function checkUsername(bddManager $bddManager){
        return $bddManager -> checkUsernameBdd($this);
    }

    public function checkEmail(bddManager $bddManager){
        $bddManager -> checkEmailBdd($this);
    }

    public function checkUsernamePass(bddManager $bddManager){
        return $bddManager -> checkUsernamePasswordBdd($this);
    }

    public function search(bddManager $bddManager){
        return $bddManager -> searchByUsername($this);
    }

}

?>