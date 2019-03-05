<?php
    function show404page(){
        header("HTTP/1.1 404 Not found");
        echo '404 page';
    }

    function getUrlSegment($num){
        $url = strtolower($_GET['url']);
        $urlSegments = explode('/', $url);
        if(empty($urlSegments[$num])){
            return null;
        }
        return $urlSegments[$num];

    }

    function renderView($view_name, array $data=[]){
        include 'core/views/'.$view_name.'.php';
    }
function is_auth(){
        if(isset($_SESSION['user']['id']) and !empty($_SESSION['user']['id'])){
            return true;
        }
        return false;
}