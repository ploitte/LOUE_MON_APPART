<?= $html ?>
<?= $header ?>


    <form action="annonce" method="POST" enctype="multipart/form-data" class="form_annonce">
        
             <!-- <input type="radio" name"type" value="entier">
            <label for="entier">Logement entier</label><br>
            <input type="radio" name"type" value="private">
            <label for="private">Chambre privée</label><br>
            <input type="radio" name"type" value="partage">
            <label for="partage">Chambre partagée</label><br>  -->

        <input type="number" name="surface" placeholder="Surface en m²...">

        <input type="number" name="nb_chambre" placeholder="Nombre de chambre...">

        <input type="date" name="dispo">

        <input type="number" name="prix" placeholder="Prix...">

        <input type="text" name="titre" placeholder="Titre de l'annonce">

        <textarea name="desc" placeholder="Description de l'annonce..."></textarea>

        <input type="file" name="photo1">
        <input type="file" name="photo2">
        <input type="file" name="photo3">

        <input type="submit">

    </form>


<?= $footer ?>