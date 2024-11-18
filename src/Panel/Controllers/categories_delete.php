<?php
session_start();
require_once dirname(dirname(dirname(__DIR__))) . '/config/app.php';
Data::ensure_user_is_authenticated();
if(isset($_POST['slug'])){
    $slug = $_POST['slug'];
    if(empty($slug)){
        redirect('categories.php');
        exit();
    }
    $dataProvider = new MysqlDataProvider();
    $dataProvider->delete_category($slug);
    if($dataProvider){
        redirect('categories.php');
        exit();
    }
    else{
        redirect('categories.php');
        exit();
    }
}
?>