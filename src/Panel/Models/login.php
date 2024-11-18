<?php
session_start();
require_once dirname(dirname(dirname(__DIR__))) . '/config/app.php';

if(isset($_SESSION['session_expired'])) {
    $items['status'] = 'Oturum süreniz doldu. Lütfen tekrar giriş yapın.';
    unset($_SESSION['session_expired']);
  }
  if(Data::is_authenticated()){
      redirect('index.php');
      die();
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $email = $_POST['email'];
      $password = $_POST['password'];
      if(Data::authenticate($email,$password)){
        $_SESSION['email'] = $email;
        $_SESSION['login_time'] = time();
        redirect('index.php');
        exit();
    }
      else{
        $items['status'] = 'Hatalı email veya şifre';
      }
    }


view('pages/login');
?>
