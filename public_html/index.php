<?php
use Task\Lib\Core;
use Task\Controllers\Product;
 
// Defining the directory separator that depends in the OS
define('DS', DIRECTORY_SEPARATOR);
// requiring config file
require_once '..' . DS . 'app' . DS . 'config' . DS . 'config.php';
// requiring the autoloader
require_once APP_PATH . DS . 'lib' . DS . 'autoload.php';


$core = new Core;
