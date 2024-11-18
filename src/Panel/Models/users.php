<?php
session_start();
require dirname(__DIR__, 3) . '/config/app.php';
if(isset($_SESSION['title'])){
    $view_bag['title'] = $_SESSION['title'];
} else {
    $view_bag['title'] = 'Kullanıcılar';
}
if(!Data::is_authenticated()){
    redirect('login.php');
    die();
}

$users = Data::get_users();



view('pages/users', ['users' => $users]);
?>