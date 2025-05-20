-- Create the database
CREATE DATABASE IF NOT EXISTS BruzProducto;
USE BruzProducto;

-- Create the products table
CREATE TABLE IF NOT EXISTS productos (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(250) NOT NULL,
  `cantidad` INT,
  `talla` VARCHAR(250) NOT NULL,
  `categoria` VARCHAR(250) NOT NULL,
  `precio` DECIMAL NOT NULL,
  `imgProduct1` VARCHAR(250) NOT NULL,
  `imgProduct2` VARCHAR(250),
  `imgProduct3` VARCHAR(250),
  `imgProduct4` VARCHAR(250),
  `fecha_registro` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;