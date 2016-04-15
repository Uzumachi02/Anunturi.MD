<?php

class Router {

    private $routes;

    public function __construct()
    {
        $routesPath = ENGINE_DIR . '/config/Routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Obtinem URL
     */
    private function getURI()
    {
        //echo trim($_SERVER['REQUEST_URI'], '/');
        if (!empty($_SERVER['REQUEST_URI'])) {
            //return trim($_SERVER['REQUEST_URI'], '/');
            return $_SERVER['REQUEST_URI'];
        }
    }

    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~$uriPattern~", $uri)) {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;

                $controllerObject = new $controllerName;

                if (!method_exists($controllerObject, $actionName)) {
                    //echo $actionName;
                    $actionName = 'actionError';
                }

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != null) {
                    break;
                }
            }
        }
    }

}
