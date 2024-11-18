<?php
session_start();
require_once dirname(dirname(dirname(__DIR__))) . '/config/app.php';

Data::ensure_user_is_authenticated();



if(is_post()){
    $id = sanitize($_POST['id']);
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
    
    if(!empty($id) && !empty($email)){
        $password_hash = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;
        
        if(Data::update_user($id, $email, $password_hash)){
            $view_bag['success'] = 'Kullanıcı başarıyla güncellendi';
            view('pages/users', $view_bag);
        } else {
            $view_bag['error'] = 'Kullanıcı güncellenirken bir hata oluştu';
            view('pages/users', $view_bag);
        }
    } else {
        $view_bag['error'] = 'Email adresi boş olamaz';
        view('pages/users', $view_bag);
    }
}
else {
    $view_bag['error'] = 'Bu sayfa yalnızca post isteği ile erişilebilir';
    view('pages/users', $view_bag);
}
?>