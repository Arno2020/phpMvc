<h1><?= $title ?></h1>
        <form method="POST" action="">
			<?php foreach($fields as $field):  ?>
            <label class="form-label" for="name"><?= $field['Field'] ?>:</label><br/>
            <input type="text" class="form-control" name="<?= $field['Field'] ?>" value="<?= ($op == 'update') ? $values[$field['Field']] : ''; ?>">
            <br>			
			<?php endforeach; ?>
            <!-- <input type="hidden" name="form-submitted" value="1" /> -->
            <input type="submit" class="btn btn-primary">
        </form>