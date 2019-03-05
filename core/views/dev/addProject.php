<?php
require_once 'layout.php';
?>
<div class="container">
    <form action="/admin/addProject" class="form-signin" enctype="multipart/form-data" method="post">
        <h2 class="form-signin-heading">Регистрация проекта</h2>
        <div class="form-group <?= (isset($data['errors']['name'])) ? 'has-error' : ''?> has-feedback">
            <label for="inputNameProject">Название проекта</label>
            <input type="text" id="inputName" name="name" class=" form-control" placeholder="Имя" value="<?= (isset($_POST['name'])) ? $_POST['name'] : ''?>" required autofocus>
        </div>
        <div class="form-group <?= (isset($data['errors']['price'])) ? 'has-error' : ''?> has-feedback">
            <label for="inputPriceProject">Цена проекта</label>
            <input type="text" id="inputPriceProject" name="price" class="form-control" placeholder="Цена проекта" value="<?= (isset($_POST['price'])) ? $_POST['price'] : ''?>" required autofocus>
        </div>
        <div class="form-group <?= (isset($data['errors']['employee'])) ? 'has-error' : ''?> has-feedback">
            <label for="inputEmployee">Менеджер</label>
            <select class="form-control" name="employee[]" id="inputEmployee" multiple  required autofocus>
                <?php for($i=0; $i<count($data['manager']); $i++){?>
                    <option value="<?= $data['manager'][$i]['id']?>"><?= $data['manager'][$i]['name']?></option>
                <?php }?>

            </select>
        </div>
        <div class="form-group <?= (isset($data['errors']['begining'])) ? 'has-error' : ''?> has-feedback">
            <label for="inputBegining">Начало выполнения</label>
            <input type="date" id="inputBegining" name="begining" value="<?= (isset($_POST['begining'])) ? $_POST['begining'] : ''?>" class=" form-control" required autofocus>
        </div>
        <div class="form-group <?= (isset($data['errors']['end'])) ? 'has-error' : ''?> has-feedback">
            <label for="inputEnd">Конец исполнения</label>
            <input type="date" id="inputEnd" name="end" value="<?= (isset($_POST['end'])) ? $_POST['end'] : ''?>" class=" form-control" autofocus>
        </div>
        <button class="btn btn-lg btn-primary btn-block " type="submit" >Добавить проект!</button>
    </form>
    <?php

    ?>
</div>