<?php

class ProductModel {
    private $conn;
    private $table_name = "productos";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los productos
    public function getAllProducts() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un producto por ID
    public function getProductById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nuevo producto
    public function createProduct($data) {
        $query = "INSERT INTO " . $this->table_name . "
                (nombre, descripcion, cantidad, talla, categoria, precio, imgProduct1)
                VALUES
                (:nombre, :descripcion, :cantidad, :talla, :categoria, :precio, :imgProduct1)";

        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $nombre = htmlspecialchars(strip_tags($data['nombre']));
        $descripcion = htmlspecialchars(strip_tags($data['descripcion']));
        $cantidad = htmlspecialchars(strip_tags($data['cantidad']));
        $talla = htmlspecialchars(strip_tags($data['talla']));
        $categoria = htmlspecialchars(strip_tags($data['categoria']));
        $precio = htmlspecialchars(strip_tags($data['precio']));
        $imgProduct1 = htmlspecialchars(strip_tags($data['imgProduct1']));

        // Vincular valores
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":cantidad", $cantidad);
        $stmt->bindParam(":talla", $talla);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":imgProduct1", $imgProduct1);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar producto
    public function updateProduct($data) {
        $query = "UPDATE " . $this->table_name . "
                SET
                    nombre = :nombre,
                    descripcion = :descripcion,
                    cantidad = :cantidad,
                    talla = :talla,
                    categoria = :categoria,
                    precio = :precio,
                    imgProduct1 = :imgProduct1
                WHERE
                    id = :id";

        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $id = htmlspecialchars(strip_tags($data['id']));
        $nombre = htmlspecialchars(strip_tags($data['nombre']));
        $descripcion = htmlspecialchars(strip_tags($data['descripcion']));
        $cantidad = htmlspecialchars(strip_tags($data['cantidad']));
        $talla = htmlspecialchars(strip_tags($data['talla']));
        $categoria = htmlspecialchars(strip_tags($data['categoria']));
        $precio = htmlspecialchars(strip_tags($data['precio']));
        $imgProduct1 = htmlspecialchars(strip_tags($data['imgProduct1']));

        // Vincular valores
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":cantidad", $cantidad);
        $stmt->bindParam(":talla", $talla);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":imgProduct1", $imgProduct1);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar producto
    public function deleteProduct($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(1, $id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
