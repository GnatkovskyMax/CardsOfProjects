<?php
require_once 'layout.php';?>
<div class="container">
      <div class="row">
<?php for ($i = 0; $i < count($data['managers']); $i++):
?>

             <div class="col-md-4 open">
                  <img src="<?= $data['managers'][$i]['img']?>" alt="Best manager">
                  <h3><?= $data['managers'][$i]['name']?></h3>
                  <p><?= $data['managers'][$i]['email']?></p>
                  <p><?= $data['managers'][$i]['phone']?></p>
                  <p><?= $data['managers'][$i]['company']?></p>
                 <p><a class="btn btn-secondary" href="/admin/editManager/<?= $data['managers'][$i]['id']?>" role="button">Редактировать  &raquo;</a></p>
                  <p><a class="btn btn-secondary allProjects" href="" data-id="<?= $data['managers'][$i]['id']?>" role="button">Мои проекты  &raquo;</a></p>
             </div>
          <p  class="col-xs-8 wrapp-for-projects wrapp-for-projects<?= $data['managers'][$i]['id']?>">

<?php endfor?>
     </div>
</div>

