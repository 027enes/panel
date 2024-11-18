<?php 

    $envFile = __DIR__ . '/../../.env';
    if (file_exists($envFile)) {
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
                list($key, $value) = explode('=', $line, 2);
                $_ENV[trim($key)] = trim($value);
            }
        }
    }
    function redirect($url){
        header("Location: $url");
        exit;
    }
    define('ASSETS_PATH', dirname(__FILE__) . '/../../public/');
    function panel_assets($path){
        return "/hoylu/public/panel/assets/" . $path;
    }
    define('ASSETS_PATH_SITE', dirname(__FILE__) . '/../../public/');
    function site_assets($path){
        return "/hoylu/public/site/assets/" . $path;
    }
    define('UPLOADS_PATH', dirname(__FILE__) . '/../../public/uploads/');
    function uploads_path($path){
        return "/hoylu/public/uploads/" . $path;
    }
    function view($name, $data = ''){
        global $view_bag;
        if(!is_array($data)){
            $data = [];
        }
        extract($data);
        require(APP_PATH . "../src/Panel/Views/layout/header.php");
        require(APP_PATH . "../src/Panel/Views/" . $name . ".view.php");
        require(APP_PATH . "../src/Panel/Views/layout/footer.php");
    }

    function site_view($name, $data = ''){
        global $view_bag;
        if(!is_array($data)){
            $data = [];
        }
        extract($data);
        require(APP_PATH . "../src/Site/Views/layout/header.php");
        require(APP_PATH . "../src/Site/Views/" . $name . ".view.php");
        require(APP_PATH . "../src/Site/Views/layout/footer.php");
    }
    // define('APP_PANEL_PATH', $_ENV['APP_PANEL_PATH'] ?? 'src/Panel');
    // function panel_view_path($path){
    //     return APP_PANEL_PATH . "/Models/" . $path;
    // }
    // define('APP_CONTROLLERS_PATH', $_ENV['APP_CONTROLLERS_PATH'] ?? 'src/Panel/Controllers');
    // function panel_controller_path($path){
    //     return APP_CONTROLLERS_PATH . "/" . $path;
    // }
    function is_post(){
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    function sanitize($value){
        // Girdinin başındaki ve sonundaki boşlukları temizle
        $value = trim($value);
        
        // HTML özel karakterlerini dönüştür
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        
        // Boş string kontrolü
        if($value === false){
            return '';
        }
        
        return $value;
    }
    function htaccess_redirect($url){
        header("Location: $url");
        exit;
    }
?>