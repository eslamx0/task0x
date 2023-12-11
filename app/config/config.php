<?php

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

//paths info
define('APP_PATH', realpath(dirname(dirname(__FILE__))));
define('VIEWS_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'views');


//Connection info
define('DB_HOST', 'localhost');
define('USER', 'hisham');
define('PWD', 'lplhjs890098##*');
define('DB_NAME', 'mvcapp');
define('SITE_NAME', 'task');
