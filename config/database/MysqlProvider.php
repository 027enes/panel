<?php

class MysqlDataProvider{
    private function connect(){
        try{
            return new PDO(CONFIG['database'],CONFIG['database_username'], CONFIG['database_password']);
        }
        catch(Exception $e){
            echo "Bağlantı hatası: " . $e->getMessage();
            return null;
        }
    }

  public function authenticate($email, $password){
        $db = $this->connect();
        if($db == null){
            return false; 
        }
        $sql = "SELECT password FROM users WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt =null;
        $db = null;
        if($user && password_verify($password, $user['password'])){
            return true;
        }
        return false;
    }
    public function is_authenticated(){
        if(!isset($_SESSION['email']) || !isset($_SESSION['login_time'])){
            return false;
        }
        $current_time = time();
        $login_time = $_SESSION['login_time'];
        $three_hours = 3 * 60 * 60 ;
        if($current_time - $login_time > $three_hours){
            session_unset();
            $_SESSION['session_expired'] = true;
            session_destroy();
            return false;
        }
        return true;
    }
    public function ensure_user_is_authenticated(){
        if(!$this->is_authenticated()){
            redirect('login.php');
            exit();
        }
    }


    public function add_user($register_username, $register_password){
        $db = $this->connect();
        if($db == null){
            return "Veritabanı bağlantısı kurulamadı";
        }
        
        $checksql = "SELECT * FROM users WHERE email = :email";
        $checkstmt = $db->prepare($checksql);
        $checkstmt->execute([
            ':email' => $register_username
        ]);
        $userExists = $checkstmt->fetchColumn();
        if($userExists > 0){
            echo "Aynı kullanıcı adı zaten var";
            return false;
        }
        
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $db->prepare($sql);
        $hashed_password = password_hash($register_password, PASSWORD_DEFAULT);
        $stmt->execute([
            ':email' => $register_username,
            ':password' => $hashed_password
        ]);
        $stmt = null;
        $db = null;
        return true;
    }
    public function get_users(){
        $db = $this->connect();
        if($db == null){
            return false;
        }
        $sql = "SELECT * FROM users";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        $db = null;
        return $users;
    }

    public function update_user($id, $email, $password_hash){
        $db = $this->connect();
        if($db == null){
            return false;
        }
        try{
            // Eğer yeni şifre varsa hem email hem şifreyi güncelle
            if($password_hash !== null) {
                $sql = "UPDATE users SET email = :email, password = :password_hash WHERE id = :id";
                $params = [
                    ':id' => $id,
                    ':email' => $email,
                    ':password_hash' => $password_hash
                ];
            } 
            // Yeni şifre yoksa sadece email'i güncelle
            else {
                $sql = "UPDATE users SET email = :email WHERE id = :id";
                $params = [
                    ':id' => $id,
                    ':email' => $email
                ];
            }
            
            $stmt = $db->prepare($sql);
            $result = $stmt->execute($params);
            
            $stmt = null;
            $db = null;
            return $result;
        } catch (Exception $e) {
            error_log("Update User Error: " . $e->getMessage());
            return false;
        }
    }


    public function add_contact($contactPhone, $contactEmail, $contactLocation, $contactBannerImage, $socialMedia = []) {
        $db = $this->connect();
        if($db == null) {
            return false;
        }
        
        try {
            $db->beginTransaction();
            
            // Önce mevcut contact kaydı var mı kontrol et
            $checkSql = "SELECT COUNT(*) FROM contact";
            $count = $db->query($checkSql)->fetchColumn();
            
            if($count > 0) {
                // Güncelleme yap
                $sql = "UPDATE contact SET 
                        phone_number = :phone,
                        email = :email,
                        location = :location,
                        banner_image = :contactBannerImage";
            } else {
                // Yeni kayıt ekle
                $sql = "INSERT INTO contact (phone_number, email, location, banner_image) 
                        VALUES (:phone, :email, :location, :contactBannerImage)";
            }
            
            $stmt = $db->prepare($sql);
            $result = $stmt->execute([
                ':phone' => $contactPhone,
                ':email' => $contactEmail,
                ':location' => $contactLocation,
                ':contactBannerImage' => $contactBannerImage
            ]);

            if (!$result) {
                throw new Exception("Contact update failed");
            }

            // Sosyal medya kayıtlarını temizle ve yeniden ekle
            $db->exec("DELETE FROM social_media");
            
            if (!empty($socialMedia)) {
                $socialSql = "INSERT INTO social_media (name, url) VALUES (:name, :url)";
                $socialStmt = $db->prepare($socialSql);
                
                foreach ($socialMedia as $social) {
                    if (!empty($social['name']) && !empty($social['url'])) {
                        $result = $socialStmt->execute([
                            ':name' => $social['name'],
                            ':url' => $social['url']
                        ]);
                        
                        if (!$result) {
                            throw new Exception("Social media insert failed");
                        }
                    }
                }
            }
            
            $db->commit();
            return true;
            
        } catch (Exception $e) {
            $db->rollBack();
            error_log("Contact Update Error: " . $e->getMessage());
            return false;
        }
    }

    public function get_contact() {
        $db = $this->connect();
        if($db == null) {
            return false;
        }
        try {
            // Ana contact bilgilerini al
            $sql = "SELECT * FROM contact LIMIT 1";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $contact = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Eğer contact bilgisi yoksa boş bir array dön
            if (!$contact) {
                return [
                    'phone_number' => '',
                    'email' => '',
                    'location' => '',
                    'banner_image' => ''
                ];
            }
            
            return $contact;
        } catch (Exception $e) {
            error_log("Get Contact Error: " . $e->getMessage());
            return false;
        }
    }

    public function get_social_media() {
        $db = $this->connect();
        if($db == null) {
            return false;
        }
        try {
            $sql = "SELECT * FROM social_media";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Get Social Media Error: " . $e->getMessage());
            return false;
        }
    }


    public function get_products(){
        $db = $this->connect();
        if($db == null){
            return false;
        }
        $sql = "SELECT * FROM products";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        $db = null;
        return $projects;
    }
    public function get_product_by_slug($slug){
        $db = $this->connect();
        if($db == null){
            return false;
        }
        try {
            // Bu SQL sorgusu, ürünleri ve ilişkili resimleri birleştirerek getirir:
            // - products tablosundan tüm sütunları seçer (p.*)
            // - product_images tablosundaki resim yollarını virgülle ayrılmış tek bir string olarak birleştirir (GROUP_CONCAT)
            // - products ve product_images tablolarını product_id üzerinden LEFT JOIN ile birleştirir
            // - Belirli bir slug değerine sahip ürünü filtreler
            // - Sonuçları ürün ID'sine göre gruplar
            $sql = "SELECT p.*, GROUP_CONCAT(pi.image_path) as additional_images 
                    FROM products p 
                    LEFT JOIN product_images pi ON p.id = pi.product_id 
                    WHERE p.slug = :slug 
                    GROUP BY p.id";
            
            $stmt = $db->prepare($sql);
            $stmt->execute([':slug' => $slug]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($product) {
                // Ek resimleri diziye dönüştür
                $product['images'] = $product['additional_images'] ? 
                                    explode(',', $product['additional_images']) : 
                                    [];
                unset($product['additional_images']);
            }
            
            return $product;
        } catch (Exception $e) {
            error_log("Get Product Error: " . $e->getMessage());
            return false;
        } finally {
            $stmt = null;
            $db = null;
        }
    }
    public function update_product($productName, $productSlug, $productDesc, $status, $category, $productCoverImage, $productImages = []) {
        $db = $this->connect();
        if($db == null){
            error_log("Database connection failed");
            return false;
        }

        try {
            $db->beginTransaction();

            error_log("Update Parameters:");
            error_log("Images: " . print_r($productImages, true));

            // Ana ürün bilgilerini güncelle
            $sql = "UPDATE products SET 
                    title = :productName, 
                    slug = :newSlug, 
                    description = :productDesc, 
                    cover_image = :productCoverImage,
                    category_id = :category,
                    status = :status 
                    WHERE slug = :currentSlug";

            $stmt = $db->prepare($sql);
            $result = $stmt->execute([
                ':productName' => $productName,
                ':newSlug' => $productSlug,
                ':productDesc' => $productDesc,
                ':productCoverImage' => $productCoverImage,
                ':category' => $category,
                ':status' => $status,
                ':currentSlug' => $_GET['slug']
            ]);

            if (!$result) {
                throw new Exception("Ürün güncellenemedi");
            }

            // Ürün ID'sini al
            $stmt = $db->prepare("SELECT id FROM products WHERE slug = ?");
            $stmt->execute([$productSlug]);
            $productId = $stmt->fetchColumn();

            // Resimleri güncelle
            $stmt = $db->prepare("DELETE FROM product_images WHERE product_id = ?");
            $stmt->execute([$productId]);

            if (!empty($productImages)) {
                $stmt = $db->prepare("INSERT INTO product_images (product_id, image_path) VALUES (?, ?)");
                foreach ($productImages as $image) {
                    $stmt->execute([$productId, $image]);
                }
            }

            $db->commit();
            return true;

        } catch (Exception $e) {
            $db->rollBack();
            error_log("Update Error: " . $e->getMessage());
            return false;
        }
    }

  
    
    public function delete_project($slug){
        $db = $this->connect();
        if($db == null){
            return false;
        }
        try {
            $sql = "DELETE FROM products WHERE slug = :slug";
            $stmt = $db->prepare($sql);
            $stmt->execute([':slug' => $slug]);
            return true;
        } catch (Exception $e) {
            error_log("Delete Project Error: " . $e->getMessage());
            return false;
        }
    }
    public function get_products_by_search($search){
        $db = $this->connect();
        if($db == null){
            return false;
        }
        try{
            $sql = "SELECT * FROM products WHERE LOWER(title) LIKE LOWER(:search)";
            $stmt = $db->prepare($sql);
            $stmt->execute([':search' => '%'.$search.'%']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Get Products by Search Error: " . $e->getMessage());
            return false;
        }
    }
    public function delete_category($slug){
        $db = $this->connect();
        if($db == null){
            return false;
        }
        try {
            $sql = "DELETE FROM category_products WHERE slug = :slug";
            $stmt = $db->prepare($sql);
            $stmt->execute([':slug' => $slug]);
            return true;
        } catch (Exception $e) {
            error_log("Delete Category Error: " . $e->getMessage());
            return false;
        }
    }
    public function delete_user($id){
        $db = $this->connect();
        if($db == null){
            return false;
        }
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            error_log("Delete User Error: " . $e->getMessage());
            return false;
        }
    }

    public function get_categories() {
        $db = $this->connect();
        if($db == null) {
            return false;
        }
        try {
            $sql = "SELECT c.*, 
                    (SELECT COUNT(*) FROM products p WHERE p.category_id = c.id) as product_count 
                    FROM category_products c";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $stmt = null;
            $db = null;
            return $categories;
        } catch(Exception $e) {
            error_log("Get Categories Error: " . $e->getMessage());
            return false;
        }
    }

    public function add_category($categoryName, $categorySlug, $categoryCreativeDesc, $creativeCoverImage, $status) {
        $db = $this->connect();
        if($db == null) {
            return false;
        }
        try {
            $sql = "INSERT INTO category_products (title, slug, description, cover_image, status) 
                    VALUES (:title, :slug, :description, :cover_image, :status)";
            $stmt = $db->prepare($sql);
            $result = $stmt->execute([
                ':title' => $categoryName,
                ':slug' => $categorySlug,
                ':description' => $categoryCreativeDesc,
                ':cover_image' => $creativeCoverImage,
                ':status' => $status
            ]);
            
            $stmt = null;
            $db = null;
            return $result;
        } catch(Exception $e) {
            error_log("Add Category Error: " . $e->getMessage());
            return false;
        }
    }
    public function get_creative(){
        $db = $this->connect();
        if($db == null){
            return false;
        }
        
        try {
            // Ürünleri ve her ürün için resim sayısını getir
            $sql = "SELECT p.*, 
                    (SELECT COUNT(*) FROM product_images pi WHERE pi.product_id = p.id) as image_count 
                    FROM products p";
                    
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Her ürün için resim yollarını da al
            foreach($products as &$product) {
                $imageSql = "SELECT image_path FROM product_images WHERE product_id = :product_id";
                $imageStmt = $db->prepare($imageSql);
                $imageStmt->execute([':product_id' => $product['id']]);
                $product['images'] = $imageStmt->fetchAll(PDO::FETCH_COLUMN);
            }
            
            $stmt = null;
            $db = null;
            return $products;
            
        } catch (Exception $e) {
            error_log("Get Creative Error: " . $e->getMessage());
            return false;
        }
    }

    public function add_creative($productName, $productSlug, $productCreativeDesc, $creativeCoverImage, $creativeImage, $category, $status, $productImages = []){
        $db = $this->connect();
        if($db == null){
            error_log("Veritabanı bağlantısı kurulamadı");
            return false;
        }
        
        try {
            $db->beginTransaction();
            
            $sql = "INSERT INTO products (
                title, slug, description, cover_image, 
                image, category_id, status
            ) VALUES (
                :productName, :productSlug, :productCreativeDesc, :creativeCoverImage, 
                :creativeImage, :category, :status
            )";
            
            $stmt = $db->prepare($sql);
            $params = [
                ':productName' => $productName,
                ':productSlug' => $productSlug,
                ':productCreativeDesc' => $productCreativeDesc,
                ':creativeCoverImage' => $creativeCoverImage,
                ':creativeImage' => $creativeImage,
                ':category' => $category,
                ':status' => $status
            ];
            
            error_log("SQL Query: " . $sql);
            error_log("Parameters: " . print_r($params, true));
            
            $result = $stmt->execute($params);

            if (!$result) {
                error_log("SQL Error: " . print_r($stmt->errorInfo(), true));
                throw new Exception("Ürün kaydı başarısız oldu: " . implode(", ", $stmt->errorInfo()));
            }

            $productId = $db->lastInsertId();

            if (!empty($productImages)) {
                $imageSql = "INSERT INTO product_images (product_id, image_path) VALUES (:product_id, :image_path)";
                $imageStmt = $db->prepare($imageSql);
                
                foreach ($productImages as $image) {
                    $result = $imageStmt->execute([
                        ':product_id' => $productId,
                        ':image_path' => $image
                    ]);
                    if (!$result) {
                        error_log("Image Insert Error: " . print_r($imageStmt->errorInfo(), true));
                        throw new Exception("Ürün resimleri eklenirken hata oluştu");
                    }
                }
            }
            
            $db->commit();
            return true;
            
        } catch (Exception $e) {
            $db->rollBack();
            error_log("Hata: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            return false;
        }
    }
    



    public function get_about(){
        $db = $this->connect();
        if($db == null){
            return false;
        }
        $sql = "SELECT * FROM about";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $about = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
        $db = null;
        return $about;
    }
    
    public function add_about($aboutTitle, $cleanAboutDesc, $aboutBannerImage, $aboutImage, $cleanAboutMission, $cleanAboutVision) {
        $db = $this->connect();
        if($db == null){
            return false;
        }
        try {
            // İçeriği temizle
            $cleanAboutDesc = preg_replace('/data-pm-slice="[^"]*"/', '', $cleanAboutDesc); // data-pm-slice özelliğini kaldır
            $cleanAboutDesc = preg_replace('/<p[^>]*>/', '', $cleanAboutDesc); // p etiketlerinin özelliklerini kaldır
            $cleanAboutDesc = str_replace(['<p>', '</p>'], '', $cleanAboutDesc); // p etiketlerini kaldır
            $cleanAboutDesc = trim($cleanAboutDesc); // Başındaki ve sonundaki boşlukları temizle

            // Aynı temizleme işlemini mission ve vision için de yap
            $cleanAboutMission = preg_replace('/data-pm-slice="[^"]*"/', '', $cleanAboutMission);
            $cleanAboutMission = preg_replace('/<p[^>]*>/', '', $cleanAboutMission);
            $cleanAboutMission = str_replace(['<p>', '</p>'], '', $cleanAboutMission);
            $cleanAboutMission = trim($cleanAboutMission);

            $cleanAboutVision = preg_replace('/data-pm-slice="[^"]*"/', '', $cleanAboutVision);
            $cleanAboutVision = preg_replace('/<p[^>]*>/', '', $cleanAboutVision);
            $cleanAboutVision = str_replace(['<p>', '</p>'], '', $cleanAboutVision);
            $cleanAboutVision = trim($cleanAboutVision);

            // Veritabanı işlemleri...
            $checkSql = "SELECT COUNT(*) FROM about";
            $count = $db->query($checkSql)->fetchColumn();

            if ($count > 0) {
                $sql = "UPDATE about SET 
                        title = :aboutTitle, 
                        description = :cleanAboutDesc, 
                        mission_description = :cleanAboutMission, 
                        vission_description = :cleanAboutVision, 
                        banner_image = :aboutBannerImage, 
                        image = :aboutImage";
            } else {
                $sql = "INSERT INTO about (
                        title, description, mission_description, 
                        vission_description, banner_image, image
                    ) VALUES (
                        :aboutTitle, :cleanAboutDesc, :cleanAboutMission, 
                        :cleanAboutVision, :aboutBannerImage, :aboutImage
                    )";
            }

            $stmt = $db->prepare($sql);
            $result = $stmt->execute([
                ':aboutTitle' => $aboutTitle,
                ':cleanAboutDesc' => $cleanAboutDesc,
                ':cleanAboutMission' => $cleanAboutMission,
                ':cleanAboutVision' => $cleanAboutVision,
                ':aboutBannerImage' => $aboutBannerImage,
                ':aboutImage' => $aboutImage
            ]);

            return $result;
        } catch (Exception $e) {
            error_log("Add About Error: " . $e->getMessage());
            return false;
        }
    }
   
}
?> 