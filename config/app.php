<?php
define('APP_PATH', dirname(__FILE__) . '/');



require APP_PATH . '/helpers/function.php';
require APP_PATH . '/database/DataProvider.php';
require APP_PATH . 'database/MysqlProvider.php';
require APP_PATH . '/database.php';


Data::initialize(new MysqlDataProvider(CONFIG['database']));

?>