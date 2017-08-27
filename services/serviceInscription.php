<?php 


class serviceInscription extends service
{

    public function launchControls(){

        $params = $this -> params;

        $bdd = new bddManager();
        $user = new user();
    
        $user -> setUsername($params["username"]);
        $user -> setEmail($params["email"]);

        if($user -> checkUsername($bdd)){
            $this -> saveError("existUsername", "Username déjà utilisé");
        }

        if($user -> checkEmail($bdd)){ 
            $this -> saveError("existEmail", "Email déjà utilisé");
        }

        if(empty($params['username'])){
            $this -> saveError("emptyUsername", "Nom d'utilisateur manquant");
        }

        else if(strlen($params["username"]) < 4){
            $this -> saveError("usernameLength", "Nom d'utilisateur trop court");
        }
        
        if(empty($params["email"])){
            $this -> saveError("emptyEmail", "Adresse mail manquante");

        }
        else if (!preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $params["email"])){
            $this -> saveError("validMail", "Adresse mail non valide");
        }

        if(empty($params['password'])){
            $this -> saveError("emptyPassword", "Mot de passe manquant");
        }

        else if(strlen($params["password"]) < 8){
            $this -> saveError("passwordLength", "Mot de passe trop court");
        }

        if(empty($params['verifPass'])){
            $this -> saveError("emptyVerifPass", "Mot de passe de verification manquant");
        }

        if($params["password"] != $params["verifPass"]){
            $this -> saveError("matchPass", "Les mots de passe ne correspondent pas");
        }

        if(!empty($this -> error)){
            return $this -> error;
        }
        else return true;
    }
}


?>