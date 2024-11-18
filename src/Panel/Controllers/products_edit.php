<?php
session_start();
require dirname(dirname(dirname(__DIR__))) . '/config/app.php';
Data::ensure_user_is_authenticated();
// Kullanıcı girişi kontrolü
if(!isset($_GET['slug'])) {
    redirect('products.php');
}

if(is_post()){
    try {
        $productName = sanitize($_POST['productName'] ?? '');
        $productSlug = sanitize($_POST['productSlug'] ?? '');
        $productDesc = $_POST['productDesc'] ?? '';
        $category = sanitize($_POST['category'] ?? '');
        $status = sanitize($_POST['status'] ?? '1');

        $product = Data::get_product_by_slug($_GET['slug']);
        if(empty($product)){
            throw new Exception("Ürün bulunamadı");
        }
        
        // Mevcut resimleri koru
        $productCoverImage = $product['cover_image'];
        $productImages = [];

        // Mevcut resimleri al
        $existingImages = $_POST['existingImages'] ?? [];

        // Yeni yüklenen resimleri işle
        $productImages = $existingImages; // Mevcut resimleri koru

        if (isset($_FILES['newProductImages'])) {
            foreach($_FILES['newProductImages']['tmp_name'] as $key => $tmp_name) {
                if($_FILES['newProductImages']['error'][$key] == UPLOAD_ERR_OK) {
                    $uploadDir = "../uploads/";
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $fileName = uniqid() . '_' . basename($_FILES['newProductImages']['name'][$key]);
                    $targetPath = $uploadDir . $fileName;
                    
                    if (move_uploaded_file($tmp_name, $targetPath)) {
                        $productImages[] = $fileName;
                    }
                }
            }
        }

        // Banner resmi yüklendiyse
        if (isset($_FILES['creativeCoverImage']) && $_FILES['creativeCoverImage']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = "../uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $fileName = uniqid() . '_' . basename($_FILES['creativeCoverImage']['name']);
            $targetPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['creativeCoverImage']['tmp_name'], $targetPath)) {
                $productCoverImage = $fileName;
            }
        }


        if(!empty($productName) && !empty($productSlug) && !empty($category)){
            if(Data::update_product($productName, $productSlug, $productDesc, $status, $category, $productCoverImage, $productImages)){
                redirect('products_edit.php?slug=' . $productSlug);
            } else {
                throw new Exception("Ürün güncellenemedi");
            }
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        error_log("Error: " . $e->getMessage());
    }
}

view('pages/products_edit');
?>