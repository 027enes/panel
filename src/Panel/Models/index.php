<?php
session_start();
require_once dirname(dirname(dirname(__DIR__))) . '/config/app.php';
Data::ensure_user_is_authenticated();

view('pages/index');
?>