<?php

class Controller
{
    public static function main()
    {
        require 'view/View.php';

        // controllers
        if (!empty($_POST['controller'])) {
            $controllerName = $_POST['controller'] . 'Controller';
        } else {
            $controllerName = 'IndexController';
        }

        // actions
        if (!empty($_POST['action'])) {
            $actionName = $_POST['action'];
        } else {
            $actionName = 'index';
        }

        // define path
        $controllerPath = 'controller/' . $controllerName . '.php';

        // load files
        if (is_file($controllerPath)) {
            require $controllerPath;
        } else {
            die('404 Not found');
        }

        // if not found the class and action
        if (is_callable($controllerName, $actionName) == false) {
            trigger_error($controllerName . ' -> ' . $actionName . ' not found', E_USER_NOTICE);
            return false;
        }

        // if all its ok
        $controller = new $controllerName();
        $controller->$actionName();
    }
}
