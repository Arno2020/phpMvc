<?php require_once('header.php'); ?>
    <h1><?php print $contact->prenom; ?></h1>
    <div>
        <span class="label">prenom:</span>
        <?php print $contact->prenom; ?>
    </div>
    <div>
        <span class="label">nom:</span>
        <?php print $contact->nom; ?>
    </div>
    <div>
        <span class="label">sexe:</span>
        <?php print $contact->sexe; ?>
    </div>
    <div>
        <span class="label">Date embauche:</span>
        <?php print $contact->date_embauche; ?>
    </div>
    <div>
        <span class="label">salaire:</span>
        <?php print $contact->salaire; ?>
    </div>

<?php require_once('footer.php'); ?>