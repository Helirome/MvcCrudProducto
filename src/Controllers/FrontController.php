<?php

namespace Helirome\MvcCrudProducto\Controllers;

class FrontController {
    private $url;
    private $controller;
    private $method;
    private $params;
    private $basePath;

    public function __construct() {
        $this->url = $_REQUEST['url'] ?? 'product';
        $this->basePath = __DIR__ . '/../';
        $this->parseUrl();
    }

    private function parseUrl() {
        $url = explode('/', filter_var(rtrim($this->url, '/'), FILTER_SANITIZE_URL));
        $this->controller = isset($url[0]) ? ucfirst($url[0]) . 'Controller' : 'ProductController';
        $this->method = isset($url[1]) ? $url[1] : 'index';
        $this->params = array_slice($url, 2);
    }

    public function run() {
        $controllerFile = __DIR__ . '/' . $this->controller . '.php';
        
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerClass = "Helirome\\MvcCrudProducto\\Controllers\\" . $this->controller;
            
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();
                if (method_exists($controller, $this->method)) {
                    call_user_func_array([$controller, $this->method], $this->params);
                } else {
                    echo "Error: Método {$this->method} no encontrado en {$this->controller}";
                    die();
                }
            } else {
                echo "Error: Clase {$controllerClass} no encontrada. Archivo: {$controllerFile}";
                die();
            }
        } else {
            echo "Error: Archivo del controlador no encontrado: {$controllerFile}";
            die();
        }
    }
}
?>