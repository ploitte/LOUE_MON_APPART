<?php 


class serviceInscription
{

    private $params = array();
    private $error;
    private $user;

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
        $user -> setUsername($this -> params["username"]);
        $user -> setEmail($this -> params["email"]);

        if(!empty($user -> checkUsername($bdd))){
            $this -> error["existUsername"] = "Username déjà utilisé";
        }

        if(!empty($user -> checkEmail($bdd))){
            $this -> error["existEmail"] = "Email déjà utilisé";
        }
       
        if(empty($this->params['username'])){
            $this->error['emptyUsername'] = 'Nom utilisateur manquant';
        }

        if(strlen($this -> params["username"]) < 4){
            $this -> error["usernameLength"] = " Non d'utilisateur trop court";
        }
        
        if(empty($this -> params["email"])){
            $this -> error["emptyEmail"] = "Adresse mail manquante";
        }
        
        // regex Email ICI

        if(empty($this->params['password'])){
            $this->error['emptyPassword'] = 'Mot de passe manquant';
        }

        if(strlen($this -> params["password"]) < 8){
            $this -> error["passwordLength"] = "Mot de passe trop court";
        }

        if(empty($this->params['verifPass'])){
            $this->error['emptyVerifPass'] = 'Mot de passe de verification manquant';
        }

        if($this -> params["password"] != $this -> params["verifPass"]){
            $this -> error["matchPass"] = "Les mots de passe ne correspondent pas";
        }

        if(!empty($this->error)){
            return $this->error;
        }
        else return true;
    }
}


?>