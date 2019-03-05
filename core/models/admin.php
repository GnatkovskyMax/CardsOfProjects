<?php
function entranceAdmin($login, $password){
    $sql = "SELECT 'id' FROM `system` WHERE login = '$login' and password = '$password'";
    return selectData($sql);
}
function addManager($formData){
    $sql1 = "INSERT INTO `manager`( `name`,`email`, `phone`, `company`) VALUES ('{$formData['name']}',
  '{$formData['email']}','{$formData['phone']}','{$formData['company']}')";
            $res = insertUpdateDelate($sql1);
            if($res){
                $sql = "SELECT max(id) FROM `manager`";
                 $res2= selectData($sql);
                $last = mysqli_fetch_assoc($res2)['max(id)'];
                return $last;
            }

}
function addPhotoManager($last, $img){
    $last=+($last);
    $sql = "UPDATE `manager` SET `img`=\"$img\" where id=$last";
    return insertUpdateDelate($sql);
}
function getIdManager($id){
    $sql="SELECT *
  FROM `manager`
 WHERE id=$id";
    return selectData($sql);
}
function allManager(){
    $sql="SELECT *
  FROM `manager`
 WHERE 1";
    return selectData($sql);
}
function allProjects(){
    $sql="SELECT *
  FROM `project`
 WHERE 1";
    return selectData($sql);
}
function editManager($formData, $id){
    $sql = "UPDATE `manager` SET `name`= '{$formData['name']}',
  `email`='{$formData['email']}', `phone`='{$formData['phone']}', `company`='{$formData['company']}' where `id`='$id'";
    return insertUpdateDelate($sql);
}
function addProject($formData){
    $price =$formData['price'];
    $sql1 = "INSERT INTO `project`( `name`,`price`, `begining`, `end`) VALUES ('{$formData['name']}',
       $price,'{$formData['begining']}','{$formData['end']}')";
    $res = insertUpdateDelate($sql1);
    if($res){
        $sql = "SELECT max(id) FROM `project`";
        $res2= selectData($sql);
        $last = mysqli_fetch_assoc($res2)['max(id)'];

        for($i=0;$i<count($formData['employee']);$i++ ){
            addConnect(+($formData['employee'][$i]), $last );

        }
        return $res;

    }
}
function editProject($formData){
    $price =$formData['price'];
    $id= +($formData['id']);
    $sql1 = "UPDATE `project` SET `name`= '{$formData['name']}', `price`= $price, `begining`= '{$formData['begining']}', `end`= '{$formData['end']}' where id=$id";
   $res =  insertUpdateDelate($sql1);
    if($res){
            if(delConnectByProjectId($id)){
                for($i=0;$i<count($formData['employee']);$i++ ){
                    addConnect(+($formData['employee'][$i]), $id );

                }
                return true;
            }



    }
}
function addConnect($manager, $last){
    $sql="INSERT INTO `manager-project`( `id_project`,`id_manager`) VALUES ($last, $manager)";
    return selectData($sql);
}
function delConnectByProjectId($id){
    $sql = "DELETE FROM `manager-project` WHERE id_project = $id";
    return selectData($sql);
}
function getAllProgectsManager($id_manager){
    $sql="SELECT `id_project`
  FROM `manager-project`
 WHERE id_manager=$id_manager";
    return selectData($sql);
}
function getAllManagerId($id_project){
    $sql="SELECT `id_manager`
  FROM `manager-project`
 WHERE `id_project`=$id_project";
     return selectData($sql);
}
function getAllProjectId($id_manager){
    $sql="SELECT `id_project`
  FROM `manager-project`
 WHERE `id_manager`=$id_manager";
    return selectData($sql);
}
function allManagerById($id){

        $idStr='';
        for($i=0;$i<count($id);$i++){
            if($i===0){

                $idStr=$idStr." id = ".$id[$i]['id_manager'];
            }else{

                $idStr=$idStr." || id = ".$id[$i]['id_manager'];
            }
       }
    $sql2="SELECT *FROM `manager`WHERE $idStr";
    return selectData($sql2);
}
function allProjectById($id){

    $idStr='';
    for($i=0;$i<count($id);$i++){
        if($i===0){

            $idStr=$idStr." id = ".$id[$i]['id_project'];
        }else{

            $idStr=$idStr." || id = ".$id[$i]['id_project'];
        }
    }
    $sql2="SELECT *FROM `project`WHERE $idStr";
    return selectData($sql2);
}
function getIdProject($id){
    $sql="SELECT *
  FROM `project`
 WHERE id=$id";
    return selectData($sql);

}
function deleatObject($id){
    var_dump($id);
    $sql = "DELETE  FROM `product` WHERE product.id = $id;";
    return selectData($sql);
}
function delPost($id){
    var_dump($id);
    $sql = "DELETE  FROM `post` WHERE post.id = $id;";
    return selectData($sql);
}
function single_product_for_admin($id){
$sql="SELECT  product.id, product.category_id, product.material, product.material_en,  product.description, 
 product.description_en, category.name, category.name_en
  FROM product 
 LEFT JOIN category ON (product.category_id = category.id)
 WHERE product.id=$id
 ";
    return selectData($sql);
}
function all_price_for_product($id){
    $sql="SELECT *
  FROM price
 WHERE price.product_id=$id";

    return selectData($sql);
}
function addPrice($from, $to, $price, $product_id){
    $price=+($price);
    $product_id=+($product_id);
    $sql = "INSERT INTO `price`(`active_from`, `active_to`, `price`, `product_id`) VALUES ('{$from}', '{$to}', $price, $product_id)";
    $result = insertUpdateDelate($sql);
    return $result;
}
function delPrice($id){
    $sql = "DELETE FROM price WHERE price_id =$id";
    $result = insertUpdateDelate($sql);
    return $result;
}
function imgObj($id){
    $sql="SELECT  `id`, `img`, `img_general` FROM `product` WHERE product.id = $id";
    return selectData($sql);
}
function imgManager($id){
    $sql="SELECT  * FROM `manager` WHERE id = $id";
    return selectData($sql);
}
