<?php
session_start();
require_once dirname(dirname(dirname(__DIR__))) . '/config/app.php';

$view_bag = [];
if(Data::is_authenticated()){
    redirect('index.php');
    die();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['registerUsername']) && isset($_POST['registerPassword'])){
        $register_username = $_POST['registerUsername'];
        $register_password = $_POST['registerPassword'];
        $result = Data::add_user($register_username, $register_password);
        if($result === true){
            $_SESSION['email'] = $register_username;
            $view_bag['status'] = 'Kayıt başarılı 3sn sonra yönlendirileceksiniz';
            header('Refresh: 3; URL=login.php');
            exit();
        }else{
            $view_bag['status'] = 'Kayıt başarısız: ' . $result;
        }
    }else{
        $view_bag['status'] = 'Kullanıcı adı veya şifre boş.';
    }
}

view('pages/register', $view_bag);

?>