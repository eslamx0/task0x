<?php
namespace Task\Lib;

// What I did here is using namespaces for generating the file path
class Autoload
{
    public static function autoload($className)
    {
        $fullPath = self::generateFullPath($className);
        
        if (file_exists($fullPath)) {
            require_once $fullPath;
        }
    }


    private static function generateFullPath($className)
    {
        $filePathToAppFolder = self::generateFilePathToAPPfolder($className);
        // concatination of App folder path and class name to generate full path
        $fullPath = APP_PATH . DS . $filePathToAppFolder;

        return $fullPath;
    }

    private static function generateFilePathToAPPfolder($className)
    {
        // remove main namespace
        $filePathToAppFolder = str_replace('Task', '', $className);
        // trim the '\' from the beginning of the class file path
        $filePathToAppFolder = trim($filePathToAppFolder, '\\');
        // turn '\' of the namespace to the directory separator of the system
        $filePathToAppFolder = str_replace('\\', DS, $filePathToAppFolder);
        // convert className to lowercase
        $filePathToAppFolder = strtolower($filePathToAppFolder);
        // file extension
        $extension = '.php';
        //concatination of extension of the file
        $filePathToAppFolder .= $extension;

        return $filePathToAppFolder;
    }
}

spl_autoload_register(__NAMESPACE__ . '\Autoload::autoload');
