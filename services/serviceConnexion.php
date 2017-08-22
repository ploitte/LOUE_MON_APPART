<?php

Class serviceConnexion{

        private $params;
        private $error;


    /*** GETTERS ET SETTERS **/

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


   public function launchControls(){
        
        $bdd = new bddManager();
        $user = new user();
        $user->setUsername($this->params['username']);
        $user->setPassword($this->params['password']);

        
        if(empty($user -> checkUsernamePass($bdd))){
            $this -> error["existUserPass"] = "Username ou password incorrect";
        }

        if(empty($this-> params['username'])){
            $this-> error['emptyUsername'] = 'Nom utilisateur manquant';
        }

        if(empty($this-> params['password'])){
            $this-> error['emptyPassword'] = 'Mot de passe manquant';
        }

        if(empty($this->error) == false){
            return $this->error;
        }
        else return true;
    }
}


?>