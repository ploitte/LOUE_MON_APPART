<header>
    <div class="menu">
        <a href="accueil">Accueil</a>
        
        
        <?php if(!isset($_SESSION["user"])){ ?>
            <a href="connexion">Connexion</a>
        <?php } ?>

        <?php if(isset($_SESSION["user"])){ ?>
            <a href="hote">Devenez hôte</a>
            <a href="logOut">Deconnexion</a>
        <?php } ?>


    </div>
</header>
<div class="main">