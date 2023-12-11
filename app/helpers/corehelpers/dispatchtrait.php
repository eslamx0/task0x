<?php
namespace Task\Helpers\CoreHelpers;

// This helper trait belongs to the core file
trait DispatchTrait
{
    // HERE I arrange the methods from main methods-> level1 up to sub methods-> level2 then sub(sub)-> level3 ... .. .

    // LEVEL 1 METHODS (main method)
    private function dispatch()
    {
        $controllerObj = $this->instantiateController();
        $actionMethodName = $this->getAppropiateActionMethod($controllerObj);

        // setting controllers attributes : name, action and params
        $this->setControllerAttributes($controllerObj);
        // calling the action


        $controllerObj->$actionMethodName();
    }
    //_______________


    // LEVEL 2 METHODS

    // This method is for instantiaiting a controller from the appropiate controller class
    private function instantiateController()
    {
        $controllerClassName = $this->getAppropiateControllerClassName();

        $controllerObj = new $controllerClassName;

        return $controllerObj;
    }


    private function getAppropiateActionMethod($controllerObj)
    {
        $requestedActionMethodName = $this->evaluateActionMethod();

        $appropiateActionMethodName = $this->getExistingAction($controllerObj, $requestedActionMethodName);

        return $appropiateActionMethodName;
    }


    private function setControllerAttributes($controllerObj)
    {
        $controllerObj->setControllerName($this->currentController);
        $controllerObj->setAction($this->currentAction);
        $controllerObj->setParams($this->currentParams);
    }
    //_______________


    // LEVEL 3 METHODS

    // This method is for getting the appropiate controller class based on the request
    private function getAppropiateControllerClassName()
    {
        $controllerClassName = $this->evaluateControllerClassName();
        $appropiateControllerClassName = $this-> getExistingClass($controllerClassName);

        return $appropiateControllerClassName;
    }

    private function evaluateActionMethod()
    {
        $actionMethod = $this->currentAction . 'Action';
        return $actionMethod;
    }

    private function getExistingAction($controllerObj, $actionMethodName)
    {
        if (!method_exists($controllerObj, $actionMethodName)) {
            $this->setNotFoundAction();
            $actionMethodName = $this->evaluateActionMethod();
        }

        return $actionMethodName;
    }
    //_______________


    // LEVEL 4 METHODS

    // This is what evaluate the user requested controller class  name by doing some stuff to the current controller
    private function evaluateControllerClassName()
    {
        $controllersClassNamespace = 'Task\Controllers';
        $controllerClassName = ucfirst($this->currentController);
        // Adding the namespace to the class name
        $controllerClassName = $controllersClassNamespace . '\\' . $controllerClassName;

        return $controllerClassName;
    }


    // Here I get a controller class that exists and if the requested class doesn't exist the then we return the not found controller class that I created
    private function getExistingClass($controllerClassName)
    {
        if (!class_exists($controllerClassName)) {
            $this->setNotFoundController();
            $controllerClassName = $this->evaluateControllerClassName();
        }

        return $controllerClassName;
    }

    // And this is ofcourse for setting the notfound controller to the current controller
    private function setNotFoundAction()
    {
        $this->currentAction = self::NOT_FOUND_CONTROLLER;
    }

    //_______________


    // LEVEL 5 METHODS

    // And this is ofcourse for setting the notfound controller to the current controller
    private function setNotFoundController()
    {
        $this->currentController = self::NOT_FOUND_CONTROLLER;
    }


    //_______________
}
