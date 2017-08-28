<?= $html ?>
<?= $header ?>

<div class="annonce">

        <?php if(isset($_SESSION["erreur"])){
            
            foreach($_SESSION["erreur"] as $p){
        ?>
            <p><?= $p; ?></p>
            
        <?php }} ?>
        

    <form action="annonce" method="POST" enctype="multipart/form-data" class="form_annonce">
  

        
        <select name="dep">
            <?php foreach($dep as $p){  ?>
            <option value="<?= $p["ville_departement"]; ?>" <?php if( $formData && $formData['dep'] == $p["ville_departement"]){ echo "selected"; } ?> >
                <?= $p["ville_departement"]; ?>
            </option>
            <?php } ?>
        </select>

        <select name="ville" >
            <option value="none"></option>
            <?php foreach($villeDep as $p){ ?>
            <option value="<?= $p["ville_id"]; ?>" <?php if($formData && $formData["ville"] == $p["ville_id"]){ echo "selected"; } ?> >
                <?= $p["ville_nom"]; ?>
            </option>
            <?php } ?>
        </select>
        
        <select name="categorie">

            <?php foreach($cat as $p){  ?>

           <option value="<?= $p; ?>" <?php if($formData && $formData["categorie"]== $p){ echo "selected";} ?> >
                <?= $p; ?>
           </option>

            <?php } ?>
        </select>

        <select name="surface">
                <option value="none">m²</option>
                <option value="10-">-10m²</option>
            
                <?php for($i=10;$i<1000;$i++){ ?>
    
                <option value="<?= $i; ?>" <?php if( $formData && $formData['surface'] == $i){ echo "selected"; } ?> >
                    <?= $i."m²"; ?>
                </option>
            
                <?php } ?>
                <option value="1000+">+1000m2</option>
        </select>
        

        <select name="nb_chambre">
                <?php for($i=1; $i <10; $i++){ ?>
                   <option value="<?= $i; ?>" <?php if($formData && $formData["nb_chambre"] == $i){ echo "selected";} ?>>
                        <?= $i; ?>
                   </option> 
                <?php } ?>
                <option value="10+" <?php if($formData && $formData["nb_chambre"] == "10+"){ echo "selected";} ?>>10+</option>
        </select>

        <input type="date" name="dispo" value="<?= $formData ? $formData['dispo'] : ""; ?>">

        <input type="number" min="0" name="prix" placeholder="Prix (€)" value="<?= $formData ? $formData['prix'] : ""; ?>">

        <input type="text" name="titre" placeholder="Titre de l'annonce..." value="<?= $formData ? $formData['titre'] : ""; ?>">

        <textarea name="desc" placeholder="Description de l'annonce..." value="<?= $formData ? $formData['desc'] : ""; ?>"></textarea>
        
        <input type="file" name="photo1" >
        <input type="file" name="photo2" >
        <input type="file" name="photo3" >

        <input type="submit">
    </form>
</div>

<?= $footer ?>