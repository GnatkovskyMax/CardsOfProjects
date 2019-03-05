<?php for ($i = 0; $i < count($data['projects']); $i++):
    ?>

    <div class="col-xs-4 open">
        <h3><?= $data['projects'][$i]['name']?></h3>
        <p><?= $data['projects'][$i]['price'].'грн'?></p>
        <p>Начало выполнения:</p>
        <p> <?= $data['projects'][$i]['begining']?></p>

        <?php if(!preg_match("/[0]{4}-(0[0]|1[0])-(0[0]|1[0]|2[0]|3[0])/", $data['projects'][$i]['end'])) { ?>
            <p>Конец выполнения:</p>
            <p><?= $data['projects'][$i]['end'] ?></p>
            <?php
        }else{?>
            <p>Выполняется...</p>
        <?php }
        ?>
    </div>
<?php endfor?>