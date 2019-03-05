<?php
require_once 'layout.php';?>
<div class="container">
    <div class="row">
        <?php for ($i = 0; $i < count($data['projects']); $i++):
            ?>

            <div class="col-md-4 col open<?= $data['projects'][$i]['id']?>">
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

                <p><a class="btn btn-secondary" href="/admin/editProject/<?= $data['projects'][$i]['id']?>" role="button">Редактировать  &raquo;</a></p>
                <p><a class="btn btn-secondary allManagers" data-id="<?= $data['projects'][$i]['id']?>" role="button">Показать менеджеров  &raquo;</a></p>

            </div>
            <p  class="col-xs-8 wrapp-for-managers wrapp-for-managers<?= $data['projects'][$i]['id']?>">
        </p>
        <?php endfor?>
    </div>
</div>