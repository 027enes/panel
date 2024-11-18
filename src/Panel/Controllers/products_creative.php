<?php
session_start();
require_once dirname(dirname(dirname(__DIR__))) . '/config/app.php';
Data::ensure_user_is_authenticated();



if(is_post()){
    try {
        // Form verilerini al
        $productName = sanitize($_POST['productName'] ?? '');
        $productSlug = sanitize($_POST['productSlug'] ?? '');
        $productCreativeDesc = sanitize($_POST['productCreativeDesc'] ?? '');
        $category = sanitize($_POST['category'] ?? '');
        $status = sanitize($_POST['status'] ?? '1');

        if(empty($productName) || empty($productSlug) || empty($productCreativeDesc) || empty($category)){
            throw new Exception("Lütfen gerekli alanları doldurunuz");
        }

        // Kapak resmi işlemi
        $creativeCoverImage = '';
        if(isset($_FILES['creativeCoverImage']) && $_FILES['creativeCoverImage']['error'] == 0) {
            $uploadDir = "../uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $newCoverImage = uniqid() . '_' . basename($_FILES['creativeCoverImage']['name']);
            if(move_uploaded_file($_FILES['creativeCoverImage']['tmp_name'], $uploadDir . $newCoverImage)) {
                $creativeCoverImage = $newCoverImage;
            }
        }

        // Ürün resmi işlemi
        $creativeImage = '';
        if(isset($_FILES['creativeImage']) && $_FILES['creativeImage']['error'] == 0) {
            $uploadDir = "../uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $newImage = uniqid() . '_' . basename($_FILES['creativeImage']['name']);
            if(move_uploaded_file($_FILES['creativeImage']['tmp_name'], $uploadDir . $newImage)) {
                $creativeImage = $newImage;
            }
        }
        // Çoklu ürün resimleri işlemi
        $productImages = [];
        if(isset($_FILES['productImages'])) {
            $uploadDir = "../uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            
            foreach($_FILES['productImages']['tmp_name'] as $key => $tmp_name) {
                if($_FILES['productImages']['error'][$key] == 0) {
                    $newImageName = uniqid() . '_' . basename($_FILES['productImages']['name'][$key]);
                    if(move_uploaded_file($tmp_name, $uploadDir . $newImageName)) {
                        $productImages[] = $newImageName;
                    }
                }
            }
        }

        // Debug için
        error_log("Form Data: " . print_r($_POST, true));
        error_log("Files Data: " . print_r($_FILES, true));

        $result = Data::add_creative(
            $productName, 
            $productSlug, 
            $productCreativeDesc, 
            $creativeCoverImage,    
            '', 
            $category, 
            $status, 
            $productImages
        );
        
        if($result) {
            redirect('products_creative.php');
        } else {
            throw new Exception("Kayıt işlemi başarısız oldu");
        }

    } catch (Exception $e) {
        error_log("Hata: " . $e->getMessage());
        echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
                <strong class='font-bold'>Hata!</strong>
                <span class='block sm:inline'>" . htmlspecialchars($e->getMessage()) . "</span>
              </div>";
    }
}

// Mevcut veriyi al
$creative = Data::get_creative() ?? [];

view('pages/products_creative');
?>
