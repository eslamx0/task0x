<?php
// This helper trait belongs to the core file
namespace Task\Helpers\CoreHelpers;

trait ParseUrlTrait
{

    // This is for separation of the requested components of the url : the controller, action and params
    // from the url and setting them to the attributes of the core

    // Main method
    private function parseUrl()
    {
        $handledUrl = $this->handleUrl();
        $urlComponents = $this->explodeUrlToComponents($handledUrl);
        $this->setCoreAttr($urlComponents);
    }
    //


    //Sub methods

    // this method is used for handling the url by making it in the form 'controller/action/params'
    private function handleUrl()
    {
        $url = $_SERVER['REQUEST_URI'];
        // will remove the root dir from url
        $handledUrl = str_replace('task', '', $url);
        $handledUrl = $this->removeSlash($handledUrl);

        return $handledUrl;
    }

    //   explode url to components
    private function explodeUrlToComponents($handledUrl)
    {
        $urlComponents = explode('/', $handledUrl, 3);
        
        return $urlComponents;
    }

    // This is for setting the components of the requested url to the core attributes
    private function setCoreAttr($urlComponents)
    {
        $this->setCurrentController($urlComponents);
        $this->setCurrentAction($urlComponents);
        $this->setCurrentparams($urlComponents);
    }

    // remove '/' from the start and the end of url
    private function removeSlash($handledUrl)
    {
        $slashRemovedUrl = trim($handledUrl, '/');

        return $slashRemovedUrl;
    }


    private function setCurrentController($urlComponents)
    {
        if (isset($urlComponents[0])) {
            if (!empty($urlComponents[0])) {
                $this->currentController = $urlComponents[0];
                $this->currentController = strtolower($this->currentController);
            }
        }
    }


    private function setCurrentAction($urlComponents)
    {
        if (isset($urlComponents[1])) {
            if (!empty($urlComponents[1])) {
                $this->currentAction = $urlComponents[1];
                $this->currentAction = strtolower($this->currentAction);
            }
        }
    }


    private function setCurrentparams()
    {
        if (isset($urlComponents[2])) {
            if (!empty($urlComponents[2])) {
                $this->currentParams = explode('/', $urlComponents[2]) ;
            }
        }
    }
}
