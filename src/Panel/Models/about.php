<?php
session_start();
require dirname(__DIR__, 3) . '/config/app.php';
Data::ensure_user_is_authenticated();
if(isset($_SESSION['title'])){
    $view_bag['title'] = $_SESSION['title'];
} else {
    $view_bag['title'] = 'Hakkımızda';
}

if(is_post()){
    $aboutTitle = sanitize($_POST['aboutTitle']);
    $aboutDesc = sanitize($_POST['aboutDesc']);
    $aboutMission = sanitize($_POST['aboutMission']);
    $aboutVision = sanitize($_POST['aboutVision']);
    $description = html_entity_decode($_POST['aboutDesc'] , ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $mission = html_entity_decode($_POST['aboutMission'] , ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $vision = html_entity_decode($_POST['aboutVision'] , ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $allowed_tags = '<p><br><strong><em><ul><li><ol><h1><h2><h3><h4><h5><h6>';
    $cleanAboutDesc = strip_tags($description, $allowed_tags);
    $cleanAboutMission = strip_tags($mission, $allowed_tags);
    $cleanAboutVision = strip_tags($vision, $allowed_tags);

    
    // Mevcut about verilerini al
    $currentAbout = Data::get_about();
    
    // Varsayılan olarak mevcut resimleri kullan
    $aboutBannerImage = $currentAbout['banner_image'] ?? '';
    $aboutImage = $currentAbout['image'] ?? '';
    
    // Banner Image işlemi - sadece yeni dosya yüklendiğinde güncelle
    if(isset($_FILES['aboutBannerImage']) && $_FILES['aboutBannerImage']['error'] == 0) {
        $uploadDir = UPLOADS_PATH . "/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $newBannerImage = uniqid() . '_' . basename($_FILES['aboutBannerImage']['name']);
        if(move_uploaded_file($_FILES['aboutBannerImage']['tmp_name'], $uploadDir . $newBannerImage)) {
            // Eski resmi sil (isteğe bağlı)
            if(!empty($aboutBannerImage) && file_exists($uploadDir . $aboutBannerImage)) {
                unlink($uploadDir . $aboutBannerImage);
            }
            $aboutBannerImage = $newBannerImage;
        }
    }

    // About Image işlemi - sadece yeni dosya yüklendiğinde güncelle
    if(isset($_FILES['aboutImage']) && $_FILES['aboutImage']['error'] == 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $newAboutImage = uniqid() . '_' . basename($_FILES['aboutImage']['name']);
        if(move_uploaded_file($_FILES['aboutImage']['tmp_name'], $uploadDir . $newAboutImage)) {
            // Eski resmi sil (isteğe bağlı)
            if(!empty($aboutImage) && file_exists($uploadDir . $aboutImage)) {
                unlink($uploadDir . $aboutImage);
            }
            $aboutImage = $newAboutImage;
        }
    }

    if (empty($aboutTitle) || empty($aboutDesc) || empty($aboutMission) || empty($aboutVision)){
        echo "Lütfen gerekli alanları doldurunuz";
    } else {
        $result = Data::add_about($aboutTitle, $cleanAboutDesc, $aboutBannerImage, $aboutImage, $cleanAboutMission, $cleanAboutVision);
        if($result) {
            redirect('about.php');
        } else {
            echo "Kayıt sırasında bir hata oluştu";
        }
    }
}

view('pages/about');
?>