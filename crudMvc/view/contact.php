<?php require_once('header.php'); ?>

    <table class="table table-bordered table-striped table-responsive my-5">
        <thead>
            <tr>
                <th>Prenom</th>
                <th>nom</th>
                <th>Sexe</th>
                <th>Service</th>
                <th>Date_embauche</th>
                <th>salaire</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><a href="?op=show&id=<?php print $contact->id_employes; ?>"><?php print htmlentities($contact->prenom) ?></a></td>
                <td><?php print htmlentities($contact->nom)?></td>
                <td><?php print htmlentities($contact->sexe) ?></td>
                <td><?php print htmlentities($contact->service) ?></td>
                <td><?php print htmlentities(date('d/m/Y', strtotime($contact->date_embauche))) ?></td>
                <td><?php print htmlentities($contact->salaire) ?></td>
                <td><a href="?op=delete&id=<?php print $contact->id_employes; ?>">Delete</a></td>
            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
<?php require_once('footer.php'); ?>