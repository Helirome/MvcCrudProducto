<?php

namespace Helirome\MvcCrudProducto\Controllers;

class ProductController {
    private $basePath;
    private $db;
    private $model;

    public function __construct() {
        $this->basePath = __DIR__ . '/../';
        
        // Inicializar la conexión a la base de datos
        require_once $this->basePath . 'config/Database.php';
        $database = new \Helirome\MvcCrudProducto\Config\Database();
        $this->db = $database->getConnection();
        
        // Inicializar el modelo
        require_once $this->basePath . 'Models/ProductModel.php';
        $this->model = new \ProductModel($this->db);
    }

    public function index() {
        // Obtener todos los productos
        $productos = $this->model->getAllProducts();
        
        // Cargar la vista
        $viewPath = $this->basePath . 'Views/product.php';
        if (file_exists($viewPath)) {
            require_once($viewPath);
        } else {
            echo "Error: Vista no encontrada en: {$viewPath}";
            die();
        }
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Manejar la subida de imágenes
            $imgProduct1 = '';
            if(isset($_FILES['imgProduct1']) && $_FILES['imgProduct1']['error'] === 0) {
                $uploadDir = $this->basePath . 'assets/images/products/';
                $fileName = time() . '_' . $_FILES['imgProduct1']['name'];
                $uploadFile = $uploadDir . $fileName;
                
                if(move_uploaded_file($_FILES['imgProduct1']['tmp_name'], $uploadFile)) {
                    $imgProduct1 = './src/assets/images/products/' . $fileName;
                }
            }

            $data = [
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'cantidad' => $_POST['cantidad'],
                'talla' => $_POST['talla'],
                'categoria' => $_POST['categoria'],
                'precio' => $_POST['precio'],
                'imgProduct1' => $imgProduct1
            ];

            if($this->model->createProduct($data)) {
                header('Location: ./?url=product');
                exit;
            }
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recuperar la imagen actual del producto
            $productoActual = $this->model->getProductById($_POST['id']);
            $imgProduct1 = $productoActual['imgProduct1'] ?? '';

            $data = [
                'id' => $_POST['id'],
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'cantidad' => $_POST['cantidad'],
                'talla' => $_POST['talla'],
                'categoria' => $_POST['categoria'],
                'precio' => $_POST['precio'],
                'imgProduct1' => $imgProduct1 // Por defecto, la imagen actual
            ];

            // Manejar la subida de nueva imagen si se proporciona
            if(isset($_FILES['imgProduct1']) && $_FILES['imgProduct1']['error'] === 0) {
                $uploadDir = $this->basePath . 'assets/images/products/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = time() . '_' . basename($_FILES['imgProduct1']['name']);
                $uploadFile = $uploadDir . $fileName;

                if(move_uploaded_file($_FILES['imgProduct1']['tmp_name'], $uploadFile)) {
                    $data['imgProduct1'] = './src/assets/images/products/' . $fileName;
                }
            }

            if($this->model->updateProduct($data)) {
                header('Location: ./?url=product');
                exit;
            }
        }
    }

    public function delete() {
        if(isset($_GET['id'])) {
            if($this->model->deleteProduct($_GET['id'])) {
                header('Location: ./?url=product');
                exit;
            }
        }
    }
}
?>