<?php

namespace Helirome\MvcCrudProducto\Controllers;

class ProductController {
    private $basePath;

    public function __construct() {
        $this->basePath = __DIR__ . '/../';
    }

    public function index() {
        $modelPath = $this->basePath . 'Models/ProductModel.php';
        $viewPath = $this->basePath . 'Views/product.php';

        if (file_exists($modelPath)) {
            require_once($modelPath);
        } else {
            echo "Error: Modelo no encontrado en: {$modelPath}";
            die();
        }

        if (file_exists($viewPath)) {
            require_once($viewPath);
        } else {
            echo "Error: Vista no encontrada en: {$viewPath}";
            die();
        }
    }
}
?>