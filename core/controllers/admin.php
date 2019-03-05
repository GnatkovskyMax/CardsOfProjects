<?php
function action_managers(){
    $allManager= new_mysqli_fetch_all(allManager());
    renderView('dev/managers', ['managers'=>  $allManager]);
}
function action_projects(){
    $allProjects= new_mysqli_fetch_all(allProjects());
    renderView('dev/projects', ['projects'=>  $allProjects]);
}
function action_addManager (){
    if (is_auth()) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $formData = [
                'name' => getSaveData(trim($_POST['name'])),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'company' => getSaveData(trim($_POST['company']))
            ];
            $rules = [
                'name' => ['required'],
                'email' => ['required', 'email'],
                'phone' => ['required', 'phone'],
                'company' => ['required']
            ];
            $errors= validateForm($rules, $formData);
            if(empty($errors)){
                $last= addManager($formData);
                if ($last) {
                    $d = opendir("manager");
                    mkdir('manager/' . $last, 0755, true);
                    closedir($d);
                }
                 if ($last && $_FILES["image"]["name"] != '') {
                    $d = opendir('manager');

                    $opendir = opendir('manager/' . $last);
                    $imgManager = "/manager/$last/". time().$_FILES["image"]["name"];
                    $name_files = "manager/$last/" . time() . $_FILES["image"]["name"];
                    move_uploaded_file($_FILES["image"]["tmp_name"], $name_files);
                    $imagine = new Imagine\Gd\Imagine();
                    $size = new Imagine\Image\Box(150, 150);
                    $image = $imagine->open($name_files)->thumbnail($size);
                    $image->save($name_files);//paste($watermark, $bottomRight)->
                    closedir($opendir);
                    closedir($d);
                    $res2 = addPhotoManager($last, $imgManager);

                  }
                  if($res2){
                    echo'Менеджер добавлен успешно!';
                    echo "<a href='/admin/admin'><button>Главная</button></a>";
                  }
             }else{
                renderView('dev/addManager', $errors);
              }


        }else{
            renderView('dev/addManager');
        }
    }else{
        echo "<a href='/admin/login'><button>Вход</button></a>";
    }
}
function action_editManager(){
    if (is_auth()) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $formData = [
                'name' => getSaveData(trim($_POST['name'])),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'company' => getSaveData(trim($_POST['company']))
            ];
            $rules = [
                'name' => ['required'],
                'email' => ['required', 'email'],
                'phone' => ['required', 'phone'],
                'company' => ['required'],
                'id'=>['numeric']
            ];
            $errors = validateForm($rules, $formData);
            if (empty($errors)) {

            }

        }else{
            $id = getUrlSegment(2);
            $result = new_mysqli_fetch_all(getIdManager($id));
            renderView('dev/editManager', ['manager' => $result]);
      }

    }else {
        echo "<a href='/admin/login'><button>Вход</button></a>";
    }
}
function action_addProject (){
    if (is_auth()) {
             $allManager= new_mysqli_fetch_all(allManager());
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
          {
            $formData = [
                'name' => getSaveData(trim($_POST['name'])),
                'price' => trim($_POST['price']),
                'employee' => $_POST['employee'],
                'begining'=> trim($_POST['begining']),
                'end'     => trim($_POST['end'])
            ];
            $rules = [
                'name' => ['required'],
                'price' => ['numeric'],
                'employee' => ['required'],
                'begining'=> ['dat']
            ];
            $errors = validateForm($rules, $formData);
            if (empty($errors)) {
                      if(addProject($formData)){
                          echo 'Проект добавлен успешно!';
                          echo "<a href='/admin/admin'><button>Главная</button></a>";
                      }

            }
            else {
                     renderView('dev/addProject', ['errors'=>$errors, 'manager' =>$allManager]);
            }
          }
        else {
                     renderView('dev/addProject', ['manager' =>$allManager]);
             }
            } else {
                     echo "<a href='/admin/login'><button>Вход</button></a>";
            }
}
function action_editProject(){
    if (is_auth()) {
        $id = getUrlSegment(2);
        $allId= new_mysqli_fetch_all(getAllManagerId($id));
        $allManagerProject = new_mysqli_fetch_all(allManagerById($allId));
        $allManager= new_mysqli_fetch_all(allManager());
        $single_project = new_mysqli_fetch_all(getIdProject($id));
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $formData = [
                'id' => trim($_POST['id']),
                'name' => getSaveData(trim($_POST['name'])),
                'price' => trim($_POST['price']),
                'employee' => $_POST['employee'],
                'begining'=> trim($_POST['begining']),
                'end'     => trim($_POST['end'])
            ];
            $rules = [
                'name' => ['required'],
                'price' => ['numeric'],
                'employee' => ['required'],
                'begining'=> ['dat'],
                'id' => ['numeric']
            ];
            $errors = validateForm($rules, $formData);
            if (empty($errors)) {
               if(editProject($formData)){
                    echo 'Проект редакторован успешно!';
                    echo "<a href='/admin/admin'><button>Главная</button></a>";
               }

            }
            else {
                renderView('dev/editProject', ['errors'=>$errors, 'manager' =>$allManager, 'allManagerProject'=>$allManagerProject, 'project' =>$single_project]);
            }
        }
        else {
            renderView('dev/editProject', ['manager' =>$allManager, 'allManagerProject'=>$allManagerProject,  'project' =>$single_project]);
        }
    } else {
        echo "<a href='/admin/login'><button>Вход</button></a>";
    }
}
function action_newsAdmin (){
    if (is_auth()) {

        $result = new_mysqli_fetch_all(findAllPost());
        // var_dump($result);
        renderView('dev/newsAdmin', ['objects' => $result]);
    }else{
        echo "<a href='/admin/login'><button>Вход</button></a>";
    }
}
function action_login(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $login = valid_adress(htmlspecialchars(trim($_POST['login'])));
        $password = md5(valid_adress(htmlspecialchars(trim($_POST['password']))));
        $resEntranceAdmin = entranceAdmin($login, $password);
        if($resEntranceAdmin -> num_rows === 0){
            echo "Incorect login or password";
        }else{
            $_SESSION['user'] = mysqli_fetch_assoc($resEntranceAdmin);
             renderView('admin');
            
        }
    }else{
      renderView('login');
    }
  
}
function action_admin(){
    if(is_auth()){
            renderView('admin');

    }else{
        echo "<a href='/admin/login'><button>Вход</button></a>";
    }
}
function action_addDelCategory(){
    if(is_auth()) {
        $allCategory = new_mysqli_fetch_all(findAllCategory());
        renderView('dev/addDelCategory', ['category' => $allCategory]);
    }else{
        echo "<a href='/admin/login'><button>Вход</button></a>";
    }
}
function action_logout(){
    session_unset();
    session_destroy();
    echo "<a href='/admin/login'><button>Вход</button></a>";
}
function action_editObject(){
    //вытянуть с базы все дание об обьекте во вьюшку а дальше работать через аякс
    //var_dump(getUrlSegment(2));
    if(is_auth()){
        $category=new_mysqli_fetch_all(findAllCategory());
        $id_object = getUrlSegment(2);
        $product = new_mysqli_fetch_all(single_product_for_admin($id_object));
        renderView('dev/editObject', ['category' => $category, 'product' => $product]);
    }else{
        echo "<a href='/admin/login'><button>Вход</button></a>";
    }


}
function action_addObject(){

if(is_auth()) {
    require '/vendor/autoload.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $formData = [
            // 'author-id'=> $_SESSION['user']['id'],
            'material' => getSaveData(trim($_POST['material'])),
            'material_en' => getSaveData(trim($_POST['material_en'])),
            'description' => getSaveData(trim($_POST['description'])),
            'description_en' => getSaveData(trim($_POST['description_en'])),
        ];
        $category = +($_POST['category']);
        $sql1 = "INSERT INTO `product`( `category_id`, `material`, 
`material_en`, `description`, `description_en`) VALUES ($category, '{$formData['material']}',  '{$formData['material_en']}',
                   '{$formData['description']}', '{$formData['description_en']}')";
        $res = insertUpdateDelate($sql1);
        //
        $sql = "SELECT max(id) FROM `product`";
        $res2 = selectData($sql);
        $last = mysqli_fetch_assoc($res2)['max(id)'];
        if ($last && $res) {
            $d = opendir("catalog");
            mkdir('catalog/' . $last, 0755, true);
            closedir($d);
            echo '<a href="/admin/editObject/' . $last . '">Редактировать добавленный объект</a>';
        }


        if ($res == true && $_FILES["image0"]["name"] != '') {
            $img = '';
            $g = '';
            $d = opendir("catalog");
            $opendir = opendir('catalog/' . $last);
            for ($i = 0; !empty($_FILES["image$i"]); $i++) {
                if ($_POST['general'] != NULL) {
                    if (+$_POST['general'] == $i) {
                        $g = 'general';
                        $img_general = "/catalog/$last/" . $g . time() . $_FILES["image$i"]["name"] . ":" . $_POST["alt$i"];
                    } else {
                        $g = '';
                        $img = $img . "/catalog/$last/" . $g . time() . $_FILES["image$i"]["name"] . ":" . $_POST["alt$i"] . ',';
                    }
                } else {
                    $g = '';
                    $img = $img . "/catalog/$last/" . $g . time() . $_FILES["image$i"]["name"] . ":" . $_POST["alt$i"] . ',';
                }

                $name_files = "catalog/$last/" . $g . time() . $_FILES["image$i"]["name"];
                move_uploaded_file($_FILES["image$i"]["tmp_name"], $name_files);
                $imagine = new Imagine\Gd\Imagine();

                if ($g == '') {
                    $size = new Imagine\Image\Box(1024, 768);
////        $imagine->open("catalog/$last/".$g.time().$_FILES["image$i"]["name"])->thumbnail($size, 'inset')->save
////        ("catalog/$last/".$g.time().$_FILES["image$i"]["name"]);
                    $image = $imagine->open($name_files)->thumbnail($size);
                    //$watermark = $imagine->open("/home/albre88/hauzer.in.ua/assets/img/hauzer_2017_watermark.png");
                    // $wSize     = $watermark->getSize();
                    //$bottomRight = new Imagine\Image\Point(50,50);//$size->getWidth() - $wSize->getWidth(), $size->getHeight() - $wSize->getHeight()
                    $image->save($name_files);//paste($watermark, $bottomRight)->
                } else {
                    $size = new Imagine\Image\Box(200, 150);
////        $imagine->open("catalog/$last/".$g.time().$_FILES["image$i"]["name"])->thumbnail($size, 'inset')->save
////        ("catalog/$last/".$g.time().$_FILES["image$i"]["name"]);
                    $image = $imagine->open($name_files)->thumbnail($size);
                    //$watermark = $imagine->open("/home/albre88/hauzer.in.ua/assets/img/hauzer_2017_watermark.png");
                    //$wSize     = $watermark->getSize();
                    //$bottomRight = new Imagine\Image\Point(50,50);//$size->getWidth() - $wSize->getWidth(), $size->getHeight() - $wSize->getHeight()
                    $image->save($name_files);//paste($watermark, $bottomRight)->

                }

            }
            closedir($opendir);
            closedir($d);
            $img = substr($img, 0, -1);
            $sql2 = " UPDATE `product` SET `img`=\"$img\",`img_general`= \"$img_general\" WHERE `id`= $last";
            $res2 = insertUpdateDelate($sql2);
            if ($res2) {
                echo "<p style='color:green;font-size:18px;'>Обьект добавлен успешно!</p><br>
              <span style='color:red;font-size:18px;'>Перезагрузка страницы приведет к повторному добавлению объекта.</span></br>
              <a href='/admin/admin'><button>Объекты</button></a><br>
              <a href='/admin/addObject'><button> Добавить объект</button></a><br>
              <a href='/admin/logout'><button>Выход</button></a>";
            }
        } else {
            echo "<br><span style='color:red;font-size:18px;text-decoration: underline'>Заполните все поля</span>";
            echo "<br><span style='color:red'>Чтобы исправить ошибки рекомендуется<a href='/admin/addObject'><button>Заполнить заново</button></a></span></br>
";
            echo "<a href='/admin/logout'><button>Выход</button></a>";
        }
    }
    else {
        $category=new_mysqli_fetch_all(findallCategory());
        renderView('dev/addObject', ['category'=>$category]);
    }
}

else{
    echo "<a href='/admin/login'><button>Вход</button></a>";
}


   
}


