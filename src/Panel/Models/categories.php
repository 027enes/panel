<?php
session_start();
require_once dirname(dirname(dirname(__DIR__))) . '/config/app.php';
Data::ensure_user_is_authenticated();
$categories = Data::get_categories();

view('pages/categories', ['categories' => $categories]);
?>