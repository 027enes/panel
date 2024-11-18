<?php
session_start();
require_once dirname(dirname(dirname(__DIR__))) . '/config/app.php';
Data::ensure_user_is_authenticated();
if(is_post()){
    try{
        $categoryName = sanitize($_POST['categoryName'] ?? '');
        $categorySlug = sanitize($_POST['categorySlug'] ?? '');
        $categoryCreativeDesc = sanitize($_POST['categoryCreativeDesc'] ?? '');
        $status = sanitize($_POST['status'] ?? '1');



        $creativeCoverImage = '';
        if(isset($_FILES['creativeCoverImage']) && $_FILES['creativeCoverImage']['error'] == 0) {
            $uploadDir = "uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $newImage = uniqid() . '_' . basename($_FILES['creativeCoverImage']['name']);
            if(move_uploaded_file($_FILES['creativeCoverImage']['tmp_name'], $uploadDir . $newImage)) {
                $creativeCoverImage = $newImage;
            }
        }

        if(empty($categoryName) || empty($categorySlug) || empty($categoryCreativeDesc)){
            throw new Exception("Lütfen gerekli alanları doldurunuz");
        }
        else{
            $result = Data::add_category(
                $categoryName,
                $categorySlug,
                $categoryCreativeDesc,
                $creativeCoverImage,
                $status
            );
            if($result){
                redirect('categories.php');
            }
            else{
                throw new Exception("Kayıt işlemi başarısız oldu");
            }
        }
        
    }catch(Exception $e){
        $error = $e->getMessage();
    }
}

$categories = Data::get_categories();


view('pages/categories_creative');
?>