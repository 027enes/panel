<?php
class Data{
    static private $db;

    static public function initialize($db){
        self::$db = new $db();
    }
    
    static public function authenticate($email, $password){
        return self::$db->authenticate($email, $password);
    }
    static public function is_authenticated(){
        return self::$db->is_authenticated();
    }
    static public function ensure_user_is_authenticated(){
        return self::$db->ensure_user_is_authenticated();
    }

    static public function add_user($register_username, $register_password){
        return self::$db->add_user($register_username, $register_password);
    }
    static public function get_users(){
        return self::$db->get_users();
    }
    static public function update_user($id, $email, $password_hash){
        return self::$db->update_user($id, $email, $password_hash);
    }
    static public function get_contact(){
        return self::$db->get_contact();
    }
    static public function get_contact_update($contactPhone, $contactEmail, $contactLocation, $contactBannerImage, $socialMedia = []){
        return self::$db->get_contact_update($contactPhone, $contactEmail, $contactLocation, $contactBannerImage, $socialMedia);
    }
    static public function add_contact($contactPhone, $contactEmail, $contactLocation, $contactBannerImage, $socialMedia = []){
        return self::$db->add_contact($contactPhone, $contactEmail, $contactLocation, $contactBannerImage, $socialMedia);
    }
    static public function get_social_media(){
        return self::$db->get_social_media();
    }

    static public function get_products(){
        return self::$db->get_products();
    }
      
    static public function update_product($productName, $productSlug, $productDesc, $status, $category, $productCoverImage, $productImages = []){
        return self::$db->update_product($productName, $productSlug, $productDesc, $status, $category, $productCoverImage, $productImages);
    }
    static public function get_product_by_slug($slug){
        return self::$db->get_product_by_slug($slug);
    }

    static public function add_creative($productName, $productSlug, $productCreativeDesc, $creativeCoverImage, $creativeImage, $category, $status, $productImages = []){
        return self::$db->add_creative($productName, $productSlug, $productCreativeDesc, $creativeCoverImage, $creativeImage, $category, $status, $productImages);
    } 

    static public function delete_project($slug){
        return self::$db->delete_project($slug);
    }

    static public function delete_category($slug){
        return self::$db->delete_category($slug);
    }
    static public function get_categories(){
        return self::$db->get_categories();
    }
    static public function add_category($categoryName, $categorySlug, $categoryCreativeDesc, $creativeCoverImage, $status){
        return self::$db->add_category($categoryName, $categorySlug, $categoryCreativeDesc, $creativeCoverImage, $status);
    }
    static public function get_products_by_search($search){
        return self::$db->get_products_by_search($search);
    }
    static public function get_creative(){
        return self::$db->get_creative();
    }
    static public function get_about(){
        return self::$db->get_about();
    }
    static public function add_about($aboutTitle, $cleanAboutDesc, $aboutBannerImage, $aboutImage, $cleanAboutMission, $cleanAboutVision){
        return self::$db->add_about($aboutTitle, $cleanAboutDesc, $aboutBannerImage, $aboutImage, $cleanAboutMission, $cleanAboutVision);
    }
    static public function delete_user($id){
        return self::$db->delete_user($id);
    }
        /*

           


    
   


    */

}