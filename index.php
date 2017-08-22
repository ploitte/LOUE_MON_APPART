<?php

require 'flight/Flight.php';
require 'autoloader.php';

session_start();


Flight::register('bddManager', 'bddManager');
Flight::register('user', 'user');
Flight::register('annonce', 'annonce');
Flight::register('image', 'image');

Flight::render('html', array("heading" => "Hello"), 'html');
Flight::render('header', array(), 'header');
Flight::render('footer', array(), 'footer');

Flight::route('/', function(){
    Flight::render("accueil");
});

Flight::route("/hote", function(){
    if(isset($_SESSION["user"])){
        Flight::render("hote");
    }else{
        Flight::redirect("accueil");
    }
});

Flight::route("/accueil", function(){
    Flight::render("accueil");
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

Flight::route("POST /inscription", function(){
    $post = $_POST;
    $service = new serviceInscription();
    $service -> setParams($post);
    if($service -> launchControls() === true){
        Flight::user() -> setUsername($post["username"]);
        Flight::user() -> setEmail($post["email"]);
        Flight::user() -> setPassword($post["password"]);

        Flight::user() -> insert(Flight::bddManager());
        Flight::redirect("connexion?registered");
    }
    else{
        $_SESSION["erreur"] = $service -> getError();
        Flight::redirect("inscription?error");
    }
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
    
    $post= $_POST;
    $service = new serviceAnnonce();
    $service -> setParams($post);
    if($service -> launchControls() === true){
        $annonce = Flight::annonce();
        // $annonce -> setTypes($post["type"]);
        $annonce -> setSurface($post["surface"]);
        $annonce -> setNb_chambre($post["nb_chambre"]);
        $annonce -> setDispo($post["dispo"]);
        $annonce -> setTitre($post["titre"]);
        $annonce -> setDesc($post["desc"]);
        $annonce -> setPrix($post["prix"]);

        $annonce -> insert(Flight::bddManager());

        Flight::redirect("accueil?posted");
    }else{
        $_SESSION["erreur"] = $service -> getError();
        Flight::redirect("hote?error");
    }

    // $annonce_id = $annonceservice->createAnnonce($params);
    // $photo_id = $annonceservice->createPhoto($params);
    // $annonceservice->linkPhotoAnnonce($annonce_id, $photo_id);
    
});


Flight::start();
?>
