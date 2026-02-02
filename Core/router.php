<?php
namespace workshop_platform\Core;

class Router {

    public function routes(){
        $controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Home';
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        $controllerClass = '\\workshop_platform\\Controllers\\' . $controllerName . 'Controller';

        if (!class_exists($controllerClass)) {
            http_response_code(404);
            echo "Contrôleur introuvable";
            return;
        }

        $controller = new $controllerClass();

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            http_response_code(404);
            echo "Action introuvable";
        }
    }
}
