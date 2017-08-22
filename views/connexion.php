<?= $html ?>
<?= $header ?>

    <div class="connexion">

        <?php if(isset($_SESSION["erreur"])){
            foreach($_SESSION["erreur"] as $p){
        ?>
            <p><?= $p; ?></p>
            
        <?php }} ?>

    <?php if(isset($_GET["registered"])){?>
        <h2>Vous pouvez maintenant vous connecter</h2>
    <?php } ?>

        <form action="connexion" method="post">
            <table>
                <tr>
                    <td><input type="text" name="username" placeholder="Username..."></td>
                </tr>
                <tr>
                    <td><input type="password" name="password" placeholder="Password..."></td>
                </tr>
                <tr>
                    <td id="subConec"><input type="submit"></td>
                </tr>
            </table>
        </form>
        <span>
            You are not registered?  
            <a href="inscription">GO</a>
        </span>
    </div>

<?= $footer ?>