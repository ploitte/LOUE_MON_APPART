<?php

Class serviceConnexion extends service{

   public function launchControls(){
        
        $params = $this -> params;
        $error = $this -> error;

        $bdd = new bddManager();
        $user = new user();
        $user->setUsername($params['username']);
        $user->setPassword($params['password']);
 
        if(empty($user -> checkUsernamePass($bdd))){
            $this -> saveError("existUserPass", "Username ou password incorrect"); 
        }

        if(empty($params['username'])){
            $this -> saveError("emptyUsername", "Nom utilisateur manquant");             
        }

        if(empty($params['password'])){
            $this -> saveError("emptyPassword", "Mot de passe manquant");    
        }

        if(empty($error) == false){
            return $error;
        }
        else return true;
    }
}


?>