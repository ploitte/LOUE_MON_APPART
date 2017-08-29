<?php

require 'flight/Flight.php';
require 'autoloader.php';

session_start();


Flight::register('bddManager', 'bddManager');
Flight::register('user', 'user');
Flight::register('annonce', 'annonce');

Flight::render('html', array("heading" => "Hello"), 'html');
Flight::render('header', array(), 'header');
Flight::render('footer', array(), 'footer');

Flight::route('/', function(){
    Flight::render("accueil");
});

Flight::route("/hote", function(){
    if(isset($_SESSION["user"])){
        $bdd = new bddManager();
        $dep = $bdd -> getDepartement();
        $villeDep = [];
        $cat= ["Type","Appartement", "Maison", "Chambre", "Autre"];

        //var_dump($_SESSION["lastForm"]); die();
        if(isset($_SESSION["lastForm"]["dep"])){ 
            $villeDep = $bdd -> getCity($_SESSION["lastForm"]["dep"]);
        }
        $formData = isset($_SESSION['lastForm']) ? $_SESSION['lastForm'] : false;
        Flight::render("hote", array("formData" => $formData, "dep" => $dep, "villeDep" => $villeDep, "cat" => $cat));

    }else{
        Flight::redirect("accueil");
    }
    $_SESSION["erreur"] = null;
    $_SESSION["lastForm"] = null;

});

Flight::route("/accueil", function(){

    if(isset($_POST["where"])){
        $getAnnonce = Flight::bddManager() -> getAnnonceSorted($_POST);
    }
    else {
        $getAnnonce = Flight::bddManager() -> getAnnonce();
    }
    
    Flight::render("accueil", array("getAnnonce" => $getAnnonce));
});

Flight::route("GET /connexion", function(){
    Flight::render("connexion");
    $_SESSION["erreur"] = null;
});

Flight::route("/logOut", function(){
    session_destroy();
    Flight::redirect("Accueil");
});

Flight::route("GET /inscription", function(){
    Flight::render("inscription");
    $_SESSION["erreur"] = null;
});

Flight::route("/menuannonce", function(){
    Flight::render("annonce");
});

Flight::route("POST /inscription", function(){
    $post = $_POST;
    $service = new serviceInscription();
    $service -> setParams($post);
    if($service -> launchControls() === true){
        $user = Flight::user();
        $user -> setUsername($post["username"]);
        $user -> setEmail($post["email"]);
        $user -> setPassword(sha1($post["password"]));

        $user -> insert(Flight::bddManager());

        Flight::redirect("connexion?registered");
    }
    else{
        $_SESSION["erreur"] = $service -> getError();
        Flight::redirect("inscription?error");
    }
});

Flight::route("POST /reserv", function(){
    
    
    Flight::redirect("accueil?reserved");
});

Flight::route("POST /connexion", function(){
    $post= $_POST;
    $service = new serviceConnexion();
    $service -> setParams($post);
    if($service -> launchControls() === true){ 
        $user = Flight::user();
        $user -> setUsername($post["username"]);
        $result = $user -> search(Flight::bddManager());
        $_SESSION["user"] = $result;

        Flight::redirect("accueil?connected=" . $result->getUsername());
    }else{
        $_SESSION["erreur"] = $service -> getError();
        Flight::redirect("connexion?error");
    }
});

Flight::route("POST /annonce", function(){
    $post = $_POST;
    $test = "test";
    $file = $_FILES;
    $service = new serviceAnnonce();

    $service -> setParams($_POST);
    $service -> setImage($file);
    if($service -> launchControls() === true){
        $annonce = Flight::annonce();

        $annonce -> setDep($post["dep"]);
        $annonce -> setVille($post["ville"]);
        $annonce -> setCategorie($post["categorie"]);
        $annonce -> setSurface($post["surface"]);
        $annonce -> setNb_chambre($post["nb_chambre"]);
        $annonce -> setDispo($post["dispo"]);
        $annonce -> setTitre($post["titre"]);
        $annonce -> setDesc($post["desc"]);
        $annonce -> setPrixNuit($post["prixNuit"]);
        $annonce -> setPrixSemaine($post["prixSemaine"]);
        $annonce -> setPrixMois($post["prixMois"]);
        $annonce -> setPhoto1($file["photo1"]);
        $annonce -> setPhoto2($file["photo2"]);
        $annonce -> setPhoto3($file["photo3"]);

 
        $annonce -> insert(Flight::bddManager());

        Flight::redirect("accueil?posted");
    }else{
        $_SESSION["erreur"] = $service -> getError();
        $_SESSION["lastForm"] = $_POST;
        Flight::redirect("hote?error");
    }

    // $annonce_id = $annonceservice->createAnnonce($params);
    // $photo_id = $annonceservice->createPhoto($params);
    // $annonceservice->linkPhotoAnnonce($annonce_id, $photo_id);
    
});


Flight::start();
?>
