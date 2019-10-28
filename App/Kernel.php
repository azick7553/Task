<?php
namespace App;
use App;

class Kernel
{
    public $defaultControllerName = 'Home';
    public $defaultActionName = 'Index';

    public function launch()
    {
        list($controllerName, $actionName, $param) = App::$router->resolve();
        echo $this->launchAction($controllerName, $actionName, $param);
    }

    public function launchAction($controllerName, $actionName, $param)
    {
        $controllerName = empty($controllerName)?$this->defaultControllerName:ucfirst($controllerName);
        if(!file_exists(ROOTPATH.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php')){
            throw new \App\Exceptions\InvalidRouteException();
        }
        require_once ROOTPATH.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php';
        if(!class_exists("\\Controllers\\".ucfirst($controllerName))){
            throw new \App\Exceptions\InvalidRoutedException();
        }
        $controllerName = "\\Controllers\\".ucfirst($controllerName);
        $controller = new $controllerName;
        $actionName = empty($actionName) ? $this->defaultActionName:$actionName;
        if(!method_exists($controller,$actionName)){
            throw new \App\Exceptions\InvalidRouteException();
        }
        return $controller->$actionName($param);
    }
}