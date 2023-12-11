<?php
namespace Task\Controllers;

use \Task\Lib\Core;
use Task\Helpers\AbstractControllerHelpers\GetViewPathTrait;

class AbstractController
{
    use GetViewPathTrait;

    protected $controllerName;
    protected $action;
    protected $params;
    protected $data = [];
    protected $repo;

    // setting attributes of the controller
    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
    }
    
    public function setAction($action)
    {
        $this->action = $action;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }


    // Rendering
    protected function renderView()
    {
        $foundViewFullPath = $this->getFoundViewPath();
        $notFoundViewPath = $this->getNotFoundViewPath();
        $notFoundActionName = Core::NOT_FOUND_ACTION;


        if ($this->action == $notFoundActionName) {
            require_once $notFoundViewPath;
        } else {
            extract($this->data);
            require_once $foundViewFullPath;
        }
    }

    // common controllers' actions
    public function notFoundAction()
    {
        $this->renderView();
    }
}
