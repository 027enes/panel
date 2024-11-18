<?php
session_start();
require_once dirname(dirname(dirname(__DIR__))) . '/config/app.php';
Data::ensure_user_is_authenticated();

if(isset($_SESSION['title'])){
    $view_bag['title'] = $_SESSION['title'];
} else {
    $view_bag['title'] = 'İletişim';
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $contactPhone = sanitize($_POST['contactPhone']);
    $contactEmail = sanitize($_POST['contactEmail']);
    $contactLocation = sanitize($_POST['contactLocation']); 
    $socialMedia = isset($_POST['socialMedia']) ? $_POST['socialMedia'] : [];
    
    // Mevcut contact bilgilerini al
    $currentContact = Data::get_contact();
    
    // Banner image işlemi
    $contactBannerImage = $currentContact['banner_image'] ?? '';
    
    if(isset($_FILES['contactBannerImage']) && $_FILES['contactBannerImage']['error'] == 0) {
        $uploadDir = "../uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $newBannerImage = uniqid() . '_' . basename($_FILES['contactBannerImage']['name']);
        if(move_uploaded_file($_FILES['contactBannerImage']['tmp_name'], $uploadDir . $newBannerImage)) {
            // Eski resmi sil (eğer varsa)
            if(!empty($currentContact['banner_image']) && file_exists($uploadDir . $currentContact['banner_image'])) {
                unlink($uploadDir . $currentContact['banner_image']);
            }
            $contactBannerImage = $newBannerImage;
        }
    }

    if(empty($contactPhone) || empty($contactEmail) || empty($contactLocation)){
        $_SESSION['error'] = 'Lütfen tüm alanları doldurunuz.';
        redirect('contact.php');
        exit;
    }

    // Sosyal medya verilerini temizle
    $cleanSocialMedia = [];
    foreach ($socialMedia as $social) {
        if (!empty($social['name']) && !empty($social['url'])) {
            $cleanSocialMedia[] = [
                'name' => sanitize($social['name']),
                'url' => sanitize($social['url'])
            ];
        }
    }

    $result = Data::add_contact($contactPhone, $contactEmail, $contactLocation, $contactBannerImage, $cleanSocialMedia);
    
    if($result){
        $_SESSION['success'] = 'İletişim bilgileri başarıyla güncellendi.';
    } else {
        $_SESSION['error'] = 'Kayıt sırasında bir hata oluştu.';
    }
    redirect('contact.php');
    exit;


}
view('pages/contact', $view_bag);
?>