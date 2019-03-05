<?php
    function valid_adress($data){
        $link = connectToDb();
        $data = mysqli_real_escape_string($link, $data);
        return $data;
    }
function email($data){

    return (!preg_match("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/", $data));
}
function required($data){
   return empty($data);
}
function password($data){
    if(strlen($data)< 3){
        return false;
    }
}
function numeric($data){
    return !is_numeric($data);
}
function phone($data){
    return (!preg_match("/^\+380\d{9}$/", $data));
}
function dat($data){
    return (!preg_match("/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/", $data));
}

function validateForm($dataWithRules, $data){
    $errorForms = [];
    $fields = array_keys($dataWithRules);
    foreach ($fields as $fieldName){
        $fieldData = $data[$fieldName];
        $rules = $dataWithRules[$fieldName];
        foreach ($rules as $ruleName){
            if ($ruleName($fieldData)){
                $errorForms[$fieldName][] = $ruleName;
            }
        }
    }

    return $errorForms;
}