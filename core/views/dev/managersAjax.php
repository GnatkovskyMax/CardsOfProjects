
<?php for ($i = 0; $i < count($data['managers']); $i++):
        ?>

        <div class=" col-sm-6 col">
            <img src="<?= $data['managers'][$i]['img']?>" alt="Best manager">
            <h3><?= $data['managers'][$i]['name']?></h3>
            <p><?= $data['managers'][$i]['email']?></p>
            <p><?= $data['managers'][$i]['phone']?></p>
            <p><?= $data['managers'][$i]['company']?></p>
        </div>

    <?php endfor?>
