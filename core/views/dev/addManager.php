<?php
require_once 'layout.php';
?>
<div class="container">
<form action="/admin/addManager" class="form-signin" enctype="multipart/form-data" method="post">
    <h2 class="form-signin-heading">Регистрация менеджера</h2>
    <div class="form-group <?= (isset($data['name'])) ? 'has-error' : ''?> has-feedback">
        <label for="inputName">Имя</label>
        <input type="text" id="inputName" name="name" class=" form-control" placeholder="Имя" value="<?= (isset($_POST['name'])) ? $_POST['name'] : ''?>" required autofocus>
    </div>
    <div class="form-group <?= (isset($data['email'])) ? 'has-error' : ''?> has-feedback">
        <label for="inputEmail">Email адрес</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email адрес" value="<?= (isset($_POST['email'])) ? $_POST['email'] : ''?>" required autofocus>
    </div>
    <div class="form-group <?= (isset($data['phone'])) ? 'has-error' : ''?> has-feedback">
        <label for="inputPhone">Телефон</label>
        <input type="tel" id="inputPhone" name="phone" class="form-control" placeholder="Телефон" value="<?= (isset($_POST['phone'])) ? $_POST['phone'] : ''?>" required autofocus>
    </div>
    <div class="form-group <?= (isset($data['company'])) ? 'has-error' : ''?> has-feedback">
        <label for="inputCompany">Компания</label>
        <input type="text" id="inputName" name="company" class=" form-control" placeholder="Компания" value="<?= (isset($_POST['company'])) ? $_POST['company'] : ''?>" required autofocus>
    </div>
    <label><input type="file" name="image" class=" btn file">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Добавить менеджера!</button>
</form>
</div>