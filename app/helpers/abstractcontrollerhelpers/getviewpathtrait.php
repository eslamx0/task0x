<?php
namespace Task\Helpers\AbstractControllerHelpers;

use \Task\Lib\Core;

// This helper trait belongs to the abstract controller file
trait GetViewPathTrait
{
    private function getNotFoundViewPath()
    {
        $foundViewPath = $this->getFoundViewPath();
        $notFoundControllerName =  Core::NOT_FOUND_ACTION;
        $notFoundViewPath =  str_replace($this->controllerName, $notFoundControllerName, $foundViewPath);

        return $notFoundViewPath;
    }

    private function getFoundViewPath()
    {
        $viewFolderName = strtolower( $this->controllerName );
        $viewFileName = strtolower( $this->action );
        $viewFileExtension = '.view.php';

        $fullPath = VIEWS_PATH . DS . $viewFolderName . DS . $viewFileName . $viewFileExtension ;

        return $fullPath;
    }
}
