<?php
session_start();
require dirname(__DIR__, 3) . '/config/app.php';
Data::ensure_user_is_authenticated();

if(isset($_POST['id'])){
$id = $_POST['id'];
    Data::delete_user($id);
    redirect('users.php');
}
else{
    echo 'hata';
}

view('panel/users');
?>