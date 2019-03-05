<div class="wrapp-delete-photo col-sm-4">
    <div class="wrapp-update col-sm-12">
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $image= !empty($data['img']) ? $data['img']: '';
            $id=!empty($data['id']) ? $data['id'] : '';
        }else{
            $image=!empty($data['manager'][0]['img']) ? $data['manager'][0]['img'] : '';
            $id=!empty($data['manager'][0]['id']) ? $data['manager'][0]['id'] : '';


        }
        if($image && $id){?>
            <br>
            <img class="file-delPhotoManager" src="<?= $image?>" alt="">
            <br>
            <br>
            <div class=" delPhotoManager btn btn-lg btn-warning btn-block" data-id="<?= $id?>">Удалить фото!</div>
        <?php }else{?>
            <h1>У даного менеджера отсутствует фото</h1>
        <?php }?>
    </div>

</div>