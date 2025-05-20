<?php

require_once __DIR__ . '/vendor/autoload.php';

use Helirome\MvcCrudProducto\Controllers\FrontController;
// Inicializar la aplicación
try {
    $app = new FrontController();
    $app->run();
} catch (Exception $e) {
    // Manejo básico de errores
    die("Error en la aplicación: " . $e->getMessage());
}