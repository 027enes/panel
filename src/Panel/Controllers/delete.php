<?php
session_start();
require '../App/app.php';
Data::ensure_user_is_authenticated();
if(isset($_POST['slug'])){
    $slug = $_POST['slug'];
    if(empty($slug)){
        redirect('products.php');
        exit();
    }
    $dataProvider = new MysqlDataProvider();
    $dataProvider->delete_project($slug);
    if($dataProvider){
        redirect('products.php');
        exit();
    }
    else{
        redirect('products.php');
        exit();
    }
}
?>