<?= $html ?>
<?= $header ?>


<div class="search">
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
</div>



<div class="showApp">
    <?php foreach($getAnnonce as $p){ ?>   
        <a href="menuannonce">
            <div class="vignette" style="background-image:url('/loueMonAppart/images/<?= $p['image1']; ?>')">
                <div class="prix">
                    <h2>
                        <?= $p["prix_nuit"] . " €/nuit"; ?>
                    </h2>
                </div>
                <div class="lieux">
                    <h2>
                        <?= $p["ville"] ."(". $p["departement"] .")"; ?>
                    </h2>
                </div>
                <div class="surface">
                    <?= $p["surface"] . "m²"; ?>
                </div>
                <?php if(isset($_SESSION["user"])){ ?>
                    <button class="button">Reserver</button>
                <?php } ?>
            </div>
        </a>
    <?php } ?>
</div>

<div class="popup">
    <form action="reservation" method="post">

        <div class="contForm">
            <div class="sContForm" class="mid"><label>Date de début: </label></div>
            <div class="sContForm"><input type="date" name="debut"></div>
        </div>
        <div class="contForm">
            <div class="sContForm" class="mid"><label>Date de fin: </label></div>
            <div class="sContForm"><input type="date" name="fin"></div>
        </div>
        <div class="contForm">
            <input type="submit" value="Reserver">
        </div>
    
    </form>
</div>



<?= $footer ?>