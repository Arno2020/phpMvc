<?php require_once('header.php'); ?>
<?php print htmlentities($title); ?></h1>

<form action="" method="post">
<div class="row my-5">
<div class="col-md-6 form-group">
        <label for="prenom" class="form-label">Prenom: </label>
        <input type="text" name="prenom" class="form-control" value="<?php $prenom ?>">
    </div>
    <div class="col-md-6 form-group">
        <label for="nom" class="form-label">Nom: </label>
        <input type="text" name="nom" class="form-control" value="<?php $nom ?>">
    </div>
</div>


<div class="row my-5">
<div class="col-md-6 form-group">
        <label for="sexe" class="form-label">Sexe: </label>
        <input type="text" name="sexe" class="form-control" value="<?php $sexe ?>">
    </div>
    <div class="col-md-6 form-group">
        <label for="date_embauche" class="form-label">date d'embauche: </label>
        <input type="date" name="date_embauche" class="form-control" value="<?php $date_embauche ?>">
    </div>
</div>



<div class="row my-5">
<div class="col-md-6 form-group">
        <label for="service" id="service" class="form-label">Service: </label>
        <input type="text" name="service" class="form-control" value="<?php $service ?>">
    </div>
    <div class="col-md-6 form-group">
        <label for="salaire" class="form-label">Salaire: </label>
        <input type="number" min="1400" max="100000" name="salaire" class="form-control" value="<?php $salaire ?>">
    </div>
</div>

<button type="submit" class="btn btn-primary">Enregister</button>

</form>

<?php require_once('footer.php'); ?>