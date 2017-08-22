<?= $html ?>
<?= $header ?>

<form action="" method="">
    <tr>
        <td><input type="text" name="where" placeholder="Pays, ville, adresse..."></td>
        <td><input type="date" name="date"></td>
        <td>
            <select name="how">
                <option value="">1 Voyageur</option>
                <option value="">2 Voyageurs</option>
                <option value="">3 Voyageurs</option>
                <option value="">4 Voyageurs</option>
                <option value="">5 Voyageurs</option>
                <option value="">6 Voyageurs</option>
                <option value="">7 Voyageurs</option>
                <option value="">8 Voyageurs</option>
                <option value="">9 Voyageurs</option>
                <option value="">10+ Voyageurs</option>
            </select>
        </td>
        <td><input type="submit" value="Rechercher"></td>    
    </tr>

</form>

<?= $footer ?>