<?php
require_once 'layout.php';
?>
<div class="container">
    <div class="wrapp-general-edit">
    <form action="/admin/editManager" class="form-signin" id="editManagerAjax" enctype="multipart/form-data" method="post">
        <h2 class="form-signin-heading">Редактирование менеджера</h2>
        <input type="text" name="id" id="inputId" value="<?= (isset($_POST['id'])) ? $_POST['id'] :$data['manager'][0]['id']?>" style="display:none;">
        <div class="form-group <?= (isset($data['name'])) ? 'has-error' : ''?> has-feedback">
            <label for="inputName">Имя</label>
            <input type="text" id="inputName" name="name" class=" form-control" placeholder="Имя" value="<?= (isset($_POST['name'])) ? $_POST['name'] : $data['manager'][0]['name']?>" required autofocus>
        </div>
        <div class="form-group <?= (isset($data['email'])) ? 'has-error' : ''?> has-feedback">
            <label for="inputEmail">Email адрес</label>
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email адрес" value="<?= (isset($_POST['email'])) ? $_POST['email'] : $data['manager'][0]['email']?>" required autofocus>
        </div>
        <div class="form-group <?= (isset($data['phone'])) ? 'has-error' : ''?> has-feedback">
            <label for="inputPhone">Телефон</label>
            <input type="tel" id="inputPhone" name="phone" class="form-control" placeholder="Телефон" value="<?= (isset($_POST['phone'])) ? $_POST['phone'] : $data['manager'][0]['phone']?>" required autofocus>
        </div>
        <div class="form-group <?= (isset($data['company'])) ? 'has-error' : ''?> has-feedback">
            <label for="inputCompany">Компания</label>
            <input type="text" id="inputCompany" name="company" class=" form-control" placeholder="Компания" value="<?= (isset($_POST['company'])) ? $_POST['company'] : $data['manager'][0]['company']?>" required autofocus>
        </div>
        <button class="btn btn-lg btn-primary btn-block editManagerAjax" type="submit" data-id="<?= $data['manager'][0]['id']?>">Редактироватьть менеджера!</button>
    </form>
    </div>
    <?php
    require_once 'wrappManagerPhoto.php';
    ?>
    <div class="wrapp-new-photo col-sm-8">
        <form action="/admin/editManager" class="col-sm-12 form-signin" enctype="multipart/form-data" method="post">
            <h2 class="form-signin-heading">Заменить фотографию менеджера!</h2>
            <hr>
            <input type="file" name="image" data-manager-id="<?= $data['manager'][0]['id']?>" class="fileManager">
            <br>
            <br>
            <button class="btn btn-lg btn-primary btn-block upPhotoManager" type="submit"">Заменить фото!</button>
        </form>
    </div>
   

</div>
