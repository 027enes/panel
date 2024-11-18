<?php
session_start();
require dirname(__DIR__, 3) . '/config/app.php';
Data::ensure_user_is_authenticated();
if(isset($_SESSION['title'])){
    $view_bag['title'] = $_SESSION['title'];
} else {
    $view_bag['title'] = 'Ürünler';
}


if(isset($_GET['search'])){
    $items = Data::get_products_by_search($_GET['search']);
} else {
    $items = Data::get_products();
}
view('pages/products', $items);
?>

