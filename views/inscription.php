<?= $html ?>
<?= $header ?>

    <div class="inscription">
        <?php if(isset($_SESSION["erreur"])){
            foreach($_SESSION["erreur"] as $p){
        ?>
            <p><?= $p; ?></p>
            
        <?php }} ?>
        <form action="inscription" method="post">
            <table>
                <tr>
                    <td><input type="text" name="username" placeholder="Username..."></td>
                </tr>
                <tr>
                    <td><input type="email" name="email" placeholder="Email..."></td>
                </tr>
                <tr>
                    <td><input type="password" name="password" placeholder="Password..."></td>
                </tr>
                <tr>
                    <td><input type="password" name="verifPass" placeholder="Confirm Password..."></td>
                </tr>
                <tr>
                    <td id="subInsc"><input type="submit"></td>
                </tr>
            </table>
        </form>
    </div>

<?= $footer ?>