<!-- table.table-bordered.table-striped.table-responsive>thead>tr>th*6 -->
<h1><?= $title ?></h1>

<a href="index.php?op=save" class="btn btn-lg btn-info my-3"><i class="bi bi-plus"></i>Ajouter un salarié</a>
<table class="table table-bordered table-striped table-responsive">
    <thead>
        <tr>
            <th>id</th>
            <?php foreach($fields as $field): ?>
                <?= "<th>$field[Field]</th>" ?>
            <?php endforeach; ?>

            <th>Voir</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <!-- tbody>tr>td*6 -->
    <tbody>
        <?php foreach($contacts as $contact): ?>
        <tr>
            <?= "<td>" . implode('</td><td>', $contact) . "</td>" . "\n"; ?>
            <td><a href="index.php?op=select&id=<?= $contact[$id]; ?>"><i class="bi bi-eye"></i></a></td>
            <td><a href="index.php?op=update&id=<?= $contact[$id]; ?>"><i class="bi bi-pencil-square"></i></a> </td>
            <td><a href="index.php?op=delete&id=<?= $contact[$id]; ?>"><i class="bi bi-trash3"></i></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>