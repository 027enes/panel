<?php
session_start();
session_unset();
session_destroy();
require_once dirname(dirname(dirname(__DIR__))) . '/config/app.php';
redirect('login.php');
?>